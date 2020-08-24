<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{

    public function index()
    {
        $roles = Role::all();
        //dd($roles);
        return view('admin.roles.allroles', ['active' => 'allRoles', 'roles' => $roles]);
    }


    public function create()
    {
        $roles = Role::all(); //list of objects (params: id, name)

        return view('admin.roles.create', ['active' => 'addRole', 'roles' => $roles]);

    }

    public function store(Request $request) //request inputs: name
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->input());
        }
        $role = Role::create($request->all());
        $role->save();
        Session::flash('message', 'success_' . __('Role is added!'));
        return redirect('admin/roles');
    }


    public function edit($id)
    {
        $role = Role::find($id);

        return view('admin.roles.edit', ['active' => 'addRole', 'role' => $role]);
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());
        $role = Role::find($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->input());
        }

        $role->update($request->all());
        $role->save();

        return redirect('admin/roles');
    }

    public function delete($id)
    {
        $role = Role::find($id);
        $role->delete();

        Session::flash('message', 'info_'.__('User is deleted!'));

        return redirect('admin/roles');
    }


}
