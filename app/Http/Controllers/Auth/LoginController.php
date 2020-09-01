<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;


    protected $redirectTo = '/admin';


    public function __construct()
    {
        $this->middleware('guest')->except('logout', 'postLogin');
    }

    public function postLogin(Request $request)
    {
        try {
            $this->validate($request, [
                'email' => 'email|required',
                'password' => 'required|min:4'
            ]);
            if (Auth::user() == null) {
                if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
                    return redirect("/admin");
                }
            } else {
                return redirect("/admin");
            }
            return redirect()->back();

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
