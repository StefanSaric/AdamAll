<?php

namespace App\Http\Controllers\Admin;

use App\Materials;
use App\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;


class PostController extends Controller
{

    public function index()
    {
        $posts = Post::with('type','category','materials')->where('show', '=', 1)->orderBy('date','desc')->get();

        return view('admin.posts.allposts', ['active' => 'allPosts', 'posts' => $posts]);
    }

    /*--- Returns empty form for inputing new Post ---*/
    public function create ()
    {
        $types = Type::all();

        return view('admin.posts.create', ['active' => 'addPost','types' => $types]);
    }

    public function store(Request $request)
    {
        //dd($request->all();
        if($request->get('category_id') == 1) {
            if ($request->get('type_id') == 4) {
                $validator = Validator::make($request->all(), [
                    'video' => 'required',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput($request->input());
                }
            } else {
                $validator = Validator::make($request->all(), [
                    'photos' => 'required',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput($request->input());
                }
            }
        }
        $validator = Validator::make($request->all(), [
            'text' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->input());
        }

        $now = time();
        $post = Post::create($request->except('photos','videos'));

        $photo_id = 0;
        $path = 'images/posts/'.$post->id;
        if($request->file('photos') != null){
            foreach ($request->file('photos') as $photo){
                $photo_id ++;
                $image_path = public_path($path).'/slika_'.$photo_id.$now.'.'.$photo->getClientOriginalExtension();
                if (!is_dir(dirname($image_path))) {
                    mkdir(dirname($image_path), 0777, true);
                }
                Image::make($photo->getRealPath())->save(public_path($path).'/slika_'.$photo_id.$now.'.'.$photo->getClientOriginalExtension());
                $url = $path.'/slika_'.$photo_id.$now.'.'.$photo->getClientOriginalExtension();
                $image = Materials::create(['post_id' => $post->id, 'url' => $url]);
            }
        }

        if($request->file('video') != null){
            $temp_video_name = 'video_' . $now . '.' . $request->file('video')->getClientOriginalExtension();
            $pathVideoFolder = 'videos/posts/'.$post->id;
            $path = public_path($pathVideoFolder) . '/'.$temp_video_name;
            if (!is_dir(dirname($path))) {
                mkdir(dirname($path), 0777, true);
            }
            $is_written = move_uploaded_file($request->file('video'), $path);
            if ($is_written) {
                $video_name = $temp_video_name;
                $video = Materials::create(['post_id' => $post->id, 'url' => $pathVideoFolder .'/'. $temp_video_name]);
            }
        }


        Session::flash('message', 'success_Vest je dodata!');

        return redirect('admin/posts');
    }

    public function edit($id)
    {
        $post = Post::find($id);
        $types = Type::all();

        return view('admin.posts.edit', ['active' => 'addPost','types' => $types,'post' => $post]);
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $removeArray = $request->get('removematerials');
        $removes = json_decode( $removeArray );

        if($post->category_id == 1) {
            if ($post->type_id <> 4) {
                if (sizeof($removes) == $post->materials->count() && $request->file('video') == null) {
                    $validator = Validator::make($request->all(), [
                        'photos' => 'required'
                    ]);
                    if ($validator->fails()) {
                        return redirect()->back()
                            ->withErrors($validator)
                            ->withInput($request->input());
                    }
                } elseif ($post->type_id == 4) {
                    if (sizeof($removes) == $post->materials->count() && $request->file('photos') == null) {
                        $validator = Validator::make($request->all(), [
                            'video' => 'required'
                        ]);
                        if ($validator->fails()) {
                            return redirect()->back()
                                ->withErrors($validator)
                                ->withInput($request->input());
                        }
                    }
                }
            }
        }
        $validator = Validator::make($request->all(), [
            'text' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->input());
        }

        $post->update($request->except('photos', 'date'));
        $post->save();

        $now = time();
        $photo_id = 0;
        $path = 'images/posts/' . $post->id;

        if ($request->file('photos') != null) {
            foreach ($request->file('photos') as $photo) {
                $photo_id++;
                $image_path = public_path($path) . '/slika_' . $photo_id . $now . '.' . $photo->getClientOriginalExtension();
                if (!is_dir(dirname($image_path))) {
                    mkdir(dirname($image_path), 0777, true);
                }
                Image::make($photo->getRealPath())->save(public_path($path) . '/slika_' . $photo_id . $now . '.' . $photo->getClientOriginalExtension());
                $url = $path . '/slika_' . $photo_id . $now . '.' . $photo->getClientOriginalExtension();
                $image = Materials::create(['post_id' => $post->id, 'url' => $url]);
            }
        }

        if ($request->file('video') != null) {
            $temp_video_name = 'video_' . $now . '.' . $request->file('video')->getClientOriginalExtension();
            $path = public_path('videos/posts/' . $post->id) . '/' . $temp_video_name;
            if (!is_dir(dirname($path))) {
                mkdir(dirname($path), 0777, true);
            }
            $is_written = move_uploaded_file($request->file('video'), $path);
            if ($is_written) {
                $video_name = $temp_video_name;
                $video = Materials::create(['post_id' => $post->id, 'url' => $path]);
            }
        }

        if($post->category_id == 1) {
            if (sizeof($removes) > 0) {
                foreach ($removes as $remove) {
                    $material = Materials::where('id', $remove)->first();
                    if ($material != null) {
                        //$remove je id tog materijala
                        Materials::where('id', $remove)->delete();
                    }
                }
            }
        }

        $sortImages = $request->get('sortImages');
        if($sortImages != null) {
            $sortImagesJson = json_decode( $sortImages );
            if(sizeof($sortImagesJson) > 0) {
                foreach($sortImagesJson as $num=>$img) {
                    $num++;
                    $material = Materials::where('id', $img)->first();
                    if($material != null) {
                        //$remove je id tog materijala
                        $material->update([
                           'ordernumber' => $num
                        ]);
                    }
                }
            }
        }

        Session::flash('message', 'success_Vest je uređena!');

        return redirect('admin/posts');

    }

    /*--- Deletes Posts (id in param) ---*/
    public function delete($id)
    {

        $post = Post::find($id);
        $post->show = 0;
        $post->save();

        Session::flash('message', 'info_Vest je obrisana!');

        return redirect('admin/posts');
    }

}
