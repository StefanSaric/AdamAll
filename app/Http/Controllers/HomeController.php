<?php

namespace App\Http\Controllers;

use App\Ads;
use App\Commercials;
use App\Http\Controllers\Admin\RegistrationController;
use App\Post;
use App\News;
use App\Materials;
use App\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{

    public function __construct()
    {
//        $this->middleware('auth');
    }

    public function index()
    {
        try {
            $posts = Post::with('type', 'category', 'materials')->where('show', '=', 1)->orderBy('date', 'desc')->get();
            $ads = Ads::all()->where('show', '=', 1)->sortBy('created_at', false);
            $news = News::all()->where('show', '=', 1)->sortBy('created_at', false);
            $commercials = Commercials::first();
            $registrations = Registration::first();

            return view('site.index', ['posts' => $posts, 'ads' => $ads, 'news' => $news, 'commercials' => $commercials, 'registrations' => $registrations]);

        } catch (\Exception $e) {
            $message = $e->getMessage();
            Log::error($message);
            //date_default_timezone_set('Europe/Belgrade');
            $text = file_get_contents(public_path('assets/logs/AllLogs.txt')) . "\n" . date('Y-m-d H:i:s') . '  |  ' . $message;
            $file = fopen(public_path('assets/logs/AllLogs.txt'), "w");
            fwrite($file, $text);
            fclose($file);
            return back()->withError($e->getMessage())->withInput();
        }
    }

    public static function textline($text)
    {
        $lines = explode("\r\n",$text);
        return $lines;
    }

}
