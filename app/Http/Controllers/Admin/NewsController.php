<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\News;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManagerStatic as Image;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::all()->where('show', '=', 1)->sortBy('created_at',false);

        return view('admin.news.allnews', ['active' => 'allNews', 'news' => $news]);
    }

    public function create()
    {
        $posts = Post::with('type','category')->where('show', '=', 1)->orderBy('date','desc')->get();

        return view('admin.news.create', ['active' => 'addNews', 'posts' => $posts]);
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $news = News::create(['title' => $request->title,
            'text' => $request->text, 'post_link' => $request->post_link]);

        $photo_id = 0;
        $path = 'images/news/' . $news->id;
        if ($request->file('photos') != null) {
            foreach ($request->file('photos') as $photo) {
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
        }
    }

    public function edit($id)
    {
        $news = News::find($id);;
        $posts = Post::with('type','category')->where('show', '=', 1)->orderBy('date','desc')->get();

        return view('admin.news.edit', ['active' => 'addNews', 'news' => $news,'posts' => $posts]);
    }

    public function update(Request $request, $id)
    {
        $news = News::find($id);
        $news->update($request->except('photos'));
        $news->save();

        $photo_id = 0;
        $path = 'images/ads/' . $news->id;
        if ($request->file('photos') != null) {
            foreach ($request->file('photos') as $photo) {
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

        }
    }

    public function delete($id)
    {
        $news = News::find($id);
        $news->show = 0;
        $news->save();

        Session::flash('message', 'info_Vest je obrisana!');

        return redirect('admin/news');
    }

}
