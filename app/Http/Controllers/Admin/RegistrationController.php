<?php

namespace App\Http\Controllers\Admin;

use App\Registration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class RegistrationController extends Controller
{

    public function index()
    {
        try {
            $registrations = Registration::all()->where('show', '=', 1);
            return view('admin.registrations.allregistrations', ['active' => 'allRegistrations', 'registrations' => $registrations]);
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

    public static function create()
    {
        try {
            return view('admin.registrations.create', ['active' => 'addRegistrations']);
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
            $registration = Registration::create($request->all());
            $registration->save();

            Session::flash('message', 'success_' . __('Registration is added!'));
            return redirect('admin/registrations');

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

    public function storesite(Request $request)
    {
        try {
            $registration = Registration::create(['email' => $request->email,]);
            $registration->email = $request->email;
            $registration->ip = $request->ip();
            $registration->save();

            Session::flash('message', 'success_' . __('Registration is added!'));
            return redirect('/');

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
            $registration = Registration::find($id);
            return view('admin.registrations.edit', ['active' => 'addRegistrations', 'registration' => $registration]);

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

    public function update(Request $request, $id)
    {
        try {
            $registration = Registration::find($id);
            $registration->update($request->all());
            $registration->save();

            Session::flash('message', 'success_Prijava je uređena!');
            return redirect('admin/registrations');

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
            $registration = Registration::find($id);
            $registration->show = 0;
            $registration->save();

            Session::flash('message', 'info_Prijava je obrisana!');
            return redirect('admin/registrations');

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
