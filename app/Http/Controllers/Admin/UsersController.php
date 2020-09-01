<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\User;
use App\Role;
use Auth;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller{


    public function index()
    {
        try {
            $users = User::with('roles')->get();
            return view('admin.users.allusers', ['active' => 'allUsers', 'users' => $users]);

        } catch (\Exception $e) {
            $message = $e->getMessage();
            Log::error($message);
            $text = file_get_contents(public_path('assets/logs/AllLogs.txt')) . "\n" . date('Y-m-d H:i:s') . '  |  ' . $message;
            $file = fopen(public_path('assets/logs/AllLogs.txt'), "w");
            fwrite($file, $text);
            fclose($file);
            return back()->withError($e->getMessage())->withInput();
        }
    }


    public function create ()
    {
        try {
            $roles = Role::all(); //list of objects (params: id, name)
            return view('admin.users.create', ['active' => 'addUser', 'roles' => $roles]);

        } catch (\Exception $e) {
            $message = $e->getMessage();
            Log::error($message);
            $text = file_get_contents(public_path('assets/logs/AllLogs.txt')) . "\n" . date('Y-m-d H:i:s') . '  |  ' . $message;
            $file = fopen(public_path('assets/logs/AllLogs.txt'), "w");
            fwrite($file, $text);
            fclose($file);
            return back()->withError($e->getMessage())->withInput();
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => ['required', 'unique:users'],
                'password' => 'required'
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput($request->input());
            }
            //setting encription for password
            $request->merge(array('password' => bcrypt($request->input('password'))));
            $user = User::create($request->all());
            $roles = $request->get('role_id');
            //adding to pivot table for roles
            if ($roles !== null) {
                foreach ($roles as $role) {
                    $user->roles()->attach($role);
                }
            }
            $user->save();

            Session::flash('message', 'success_' . __('Official is added!'));
            return redirect('admin/users');
        } catch (\Exception $e) {
            $message = $e->getMessage();
            Log::error($message);
            $text = file_get_contents(public_path('assets/logs/AllLogs.txt')) . "\n" . date('Y-m-d H:i:s') . '  |  ' . $message;
            $file = fopen(public_path('assets/logs/AllLogs.txt'), "w");
            fwrite($file, $text);
            fclose($file);
            return back()->withError($e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        try {
            $user = User::find($id);
            $roles = Role::all();
            $userRoles = $user->roles;

            return view('admin.users.edit', ['active' => 'addUser', 'user' => $user, 'roles' => $roles, 'userroles' => $userRoles]);
        } catch (\Exception $e) {
            $message = $e->getMessage();
            Log::error($message);
            $text = file_get_contents(public_path('assets/logs/AllLogs.txt')) . "\n" . date('Y-m-d H:i:s') . '  |  ' . $message;
            $file = fopen(public_path('assets/logs/AllLogs.txt'), "w");
            fwrite($file, $text);
            fclose($file);
            return back()->withError($e->getMessage())->withInput();
        }
    }

    public function update(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => ['required', 'unique:users,email,' . $request->user_id],
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput($request->input());
            }
            $id = $request->user_id;
            $user = User::find($id);
            $user->update($request->except(['password']));
            //changing password
            if (isset($request->password) && $request->password != '') {
                $user->password = bcrypt($request->input('password'));
                $user->save();
            }
            //adding new role
            if (isset($request->role_id)) {
                $user->roles()->sync($request->role_id);
            }

            Session::flash('message', 'success_' . __('Official is edited!'));
            return redirect('admin/users');

        } catch (\Exception $e) {
            $message = $e->getMessage();
            Log::error($message);
            $text = file_get_contents(public_path('assets/logs/AllLogs.txt')) . "\n" . date('Y-m-d H:i:s') . '  |  ' . $message;
            $file = fopen(public_path('assets/logs/AllLogs.txt'), "w");
            fwrite($file, $text);
            fclose($file);
            return back()->withError($e->getMessage())->withInput();
        }
    }


    public function delete($id)
    {
        try {
            $user = User::find($id);
            $user->delete();

            Session::flash('message', 'info_' . __('User is deleted!'));
            return redirect('admin/users');

        } catch (\Exception $e) {
            $message = $e->getMessage();
            Log::error($message);
            $text = file_get_contents(public_path('assets/logs/AllLogs.txt')) . "\n" . date('Y-m-d H:i:s') . '  |  ' . $message;
            $file = fopen(public_path('assets/logs/AllLogs.txt'), "w");
            fwrite($file, $text);
            fclose($file);
            return back()->withError($e->getMessage())->withInput();
        }
    }
}
