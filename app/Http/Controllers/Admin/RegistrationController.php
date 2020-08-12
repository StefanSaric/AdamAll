<?php

namespace App\Http\Controllers\Admin;

use App\Registration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class RegistrationController extends Controller
{

    public function index()
    {
        $registrations = Registration::all()->where('show', '=', 1);

        return view('admin.registrations.allregistrations', ['active' => 'allRegistrations', 'registrations' => $registrations]);
    }

    public static function create()
    {
        return view('admin.registrations.create', ['active' => 'addRegistrations']);
    }

    public function store(Request $request)
    {
        $registration = Registration::create($request->all());

        $registration->save();

        Session::flash('message', 'success_' . __('Registration is added!'));
        return redirect('admin/registrations');
    }

    public function storesite(Request $request)
    {

        $registration = Registration::create(['email' => $request->email,]);
        $registration->email = $request->email;
        $registration->ip = $request->ip();
        $registration->save();

        Session::flash('message', 'success_' . __('Registration is added!'));
        return redirect('/');
    }

    public function edit($id)
    {
        $registration = Registration::find($id);

        return view('admin.registrations.edit', ['active' => 'addRegistrations', 'registration' => $registration]);
    }

    public function update(Request $request, $id)
    {
        $registration = Registration::find($id);
        $registration->update($request->all());
        $registration->save();

        Session::flash('message', 'success_Prijava je uređena!');

        return redirect('admin/registrations');
    }
    public function delete($id)
    {
        $registration = Registration::find($id);
        $registration->show = 0;
        $registration->save();

        Session::flash('message', 'info_Prijava je obrisana!');
        return redirect('admin/registrations');

    }
}
