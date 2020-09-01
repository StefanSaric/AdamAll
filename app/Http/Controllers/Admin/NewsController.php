<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\News;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;

class NewsController extends Controller
{
    public function index()
    {
        try {
            $news = News::all()->where('show', '=', 1)->sortBy('created_at', false);
            return view('admin.news.allnews', ['active' => 'allNews', 'news' => $news]);
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

    public function create()
    {
        try {
            $posts = Post::with('type', 'category')->where('show', '=', 1)->orderBy('date', 'desc')->get();
            return view('admin.news.create', ['active' => 'addNews', 'posts' => $posts]);
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
                'photos' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput($request->input());
            }

            $news = News::create(['title' => $request->title,
                'text' => $request->text, 'post_link' => $request->post_link]);

            $photo_id = 0;
            $path = 'images/news/' . $news->id;
            if ($request->file('photos') != null) {
                $photo = $request->file('photos');
                $photo_id++;
                $image_path = public_path($path) . '/slika_' . $photo_id . '.' . $photo->getClientOriginalExtension();
                if (!is_dir(dirname($image_path))) {
                    mkdir(dirname($image_path), 0777, true);
                }
                Image::make($photo->getRealPath())->save(public_path($path) . '/slika_' . $photo_id . '.' . $photo->getClientOriginalExtension());
                $image = $path . '/slika_' . $photo_id . '.' . $photo->getClientOriginalExtension();
                $news->image = $image;
                $news->save();
            }

            Session::flash('message', 'success_Vest je dodata!');
            return redirect('admin/news');

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
            $news = News::find($id);;
            $posts = Post::with('type', 'category')->where('show', '=', 1)->orderBy('date', 'desc')->get();

            return view('admin.news.edit', ['active' => 'addNews', 'news' => $news, 'posts' => $posts]);

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
            $news = News::find($id);
            $news->update($request->except('photos'));
            $news->save();

            $photo_id = 0;
            $path = 'images/ads/' . $news->id;
            if ($request->file('photos') != null) {
                $photo = $request->file('photos');
                $photo_id++;
                $image_path = public_path($path) . '/slika_' . $photo_id . '.' . $photo->getClientOriginalExtension();
                if (!is_dir(dirname($image_path))) {
                    mkdir(dirname($image_path), 0777, true);
                }
                Image::make($photo->getRealPath())->save(public_path($path) . '/slika_' . $photo_id . '.' . $photo->getClientOriginalExtension());
                $image = $path . '/slika_' . $photo_id . '.' . $photo->getClientOriginalExtension();
                $news->image = $image;
                $news->save();
            }

            Session::flash('message', 'success_Vest je uređena!');
            return redirect('admin/news');

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
            $news = News::find($id);
            $news->show = 0;
            $news->save();

            Session::flash('message', 'info_Vest je obrisana!');
            return redirect('admin/news');
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
