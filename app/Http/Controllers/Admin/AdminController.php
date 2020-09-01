<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
//use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{

    public function index()
    {
        try {
            $lines = file(public_path('assets/logs/AllLogs.txt'));

            return view('admin.dash', ['active' => 'dash', 'lines' => $lines]);
        } catch (\Exception $e) {
            $message = $e->getMessage();
            Log::error($message);
            $text = file_get_contents(public_path('assets/logs/AllLogs.txt'))."\n" .date('Y-m-d H:i:s').'  |  '.$message;
            $file = fopen(public_path('assets/logs/AllLogs.txt'), "w");
            fwrite($file, $text);
            fclose($file);
            return back()->withError($e->getMessage())->withInput();
        }
    }
}
