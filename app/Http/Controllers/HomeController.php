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
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::with('type','category', 'materials')->where('show', '=', 1)->orderBy('date','desc')->get();

        $ads = Ads::all()->where('show', '=', 1)->sortBy('created_at',false);

        $news = News::all()->where('show', '=', 1)->sortBy('created_at',false);

        $commercials = Commercials::first();

        $registrations = Registration::first();

        return view('site.index', ['posts' => $posts, 'ads' => $ads, 'news' => $news, 'commercials' => $commercials, 'registrations' => $registrations]);
    }

    public static function textline($text)
    {
        $lines = explode("\r\n",$text);
        return $lines;
    }

}
