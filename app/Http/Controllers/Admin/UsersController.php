<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use App\User;
use App\Role;
use Auth;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller{


    public function index()
    {
        $users = User::with('roles')->get();//list of objects (params: id, name, email, password, remember_token, created_at, updated_at) with relation (roles:id, name)
//        dd($users);

        return view('admin.users.allusers', ['active' => 'allUsers', 'users' => $users]);
    }

    /*--- Returns empty form for inputing new User ---*/
    public function create ()
    {
        $roles = Role::all(); //list of objects (params: id, name)

        return view('admin.users.create', ['active' => 'addUser', 'roles' => $roles]);
    }

    /*--- Stores new User based on input data ($request) and redirects to User index ---*/
    public function store(Request $request) //request inputs: user_id, name, licence, email, password, role_id(list)
    {
        $validator = Validator::make($request->all(),[
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
        $user = User::create($request->all());//single object (params: id, name, licence, email, password, remember_token, created_at, updated_at)
        $roles = $request->get('role_id');
        //adding to pivot table for roles
        if($roles !== null){
            foreach($roles as $role){
                $user->roles()->attach($role);
            }
        }
        $user->save();

        Session::flash('message', 'success_'.__('Official is added!'));

        return redirect('admin/users');
    }

    public function edit($id)
    {
        $user = User::find($id); //single object (params: id, name, licence, email, password, remember_token, created_at, updated_at)
        $roles = Role::all(); //list of objects (params: id, name)
        $userRoles = $user->roles; //list of assigned objects through relation

        return view ('admin.users.edit', ['active' => 'addUser', 'user' => $user, 'roles' => $roles, 'userroles' => $userRoles]);
    }

    public function update(Request $request) //request inputs: user_id, name, email, password, role_id(list)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => ['required', 'unique:users,email,'.$request->user_id],
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
        if(isset($request->password) && $request->password != ''){
            $user->password = bcrypt($request->input('password'));
            $user->save();
        }
        //adding new role
        if(isset($request->role_id)){
            $user->roles()->sync($request->role_id);
        }

        Session::flash('message', 'success_'.__('Official is edited!'));

        return redirect('admin/users');

    }

    /*--- Deletes User (id in param) ---*/
    public function delete($id)
    {
        $user = User::find($id); //single object (params: id, name, email, password, remember_token, created_at, updated_at)
        $user->delete();

        Session::flash('message', 'info_'.__('User is deleted!'));


        return redirect('admin/users');
    }
}
