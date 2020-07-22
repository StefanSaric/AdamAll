<?php

namespace App\Http\Controllers\Admin;

use App\Commercials;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManagerStatic as Image;

class CommercialsController extends Controller
{
    public function index()
    {
        $commercials = Commercials::all()->where('show', '=', 1);

        return view('admin.commercials.allcommercials', ['active' => 'allCommercials', 'commercials' => $commercials]);
    }

    public function create()
    {
        return view('admin.commercials.create', ['active' => 'addCommercials']);
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $commercials = Commercials::create(['image_tag' => $request->image_tag, 'title' => $request->title,
            'link' => $request->link, 'text' => $request->text]);

        $photo_id = 0;
        $path = 'images/commercials/' . $commercials->id;
        if ($request->file('photos') != null) {
            foreach ($request->file('photos') as $photo) {
                $photo_id++;
                $image_path = public_path($path) . '/slika_' . $photo_id . '.' . $photo->getClientOriginalExtension();
                if (!is_dir(dirname($image_path))) {
                    mkdir(dirname($image_path), 0777, true);
                }

                Image::make($photo->getRealPath())->save(public_path($path) . '/slika_' . $photo_id . '.' . $photo->getClientOriginalExtension());
                $image = $path . '/slika_' . $photo_id . '.' . $photo->getClientOriginalExtension();
                $commercials->image = $image;
                $commercials->save();
            }
            Session::flash('message', 'success_Vest je dodata!');

            return redirect('admin/commercials');
        }
    }

    public function edit($id)
    {
        $commercials = Commercials::find($id);;

        return view('admin.commercials.edit', ['active' => 'addCommercials', 'commercials' => $commercials]);
    }

    public function update(Request $request, $id)
    {
        $commercials = Commercials::find($id);;
        $commercials->update($request->except('photos'));
        $commercials->save();

        $photo_id = 0;
        $path = 'images/commercials/' . $commercials->id;
        if ($request->file('photos') != null) {
            foreach ($request->file('photos') as $photo) {
                $photo_id++;
                $image_path = public_path($path) . '/slika_' . $photo_id . '.' . $photo->getClientOriginalExtension();
                if (!is_dir(dirname($image_path))) {
                    mkdir(dirname($image_path), 0777, true);
                }
                Image::make($photo->getRealPath())->save(public_path($path) . '/slika_' . $photo_id . '.' . $photo->getClientOriginalExtension());
                $image = $path . '/slika_' . $photo_id . '.' . $photo->getClientOriginalExtension();
                $commercials->image = $image;
                $commercials->save();
            }


            Session::flash('message', 'success_Reklama je uređen!');

            return redirect('admin/commercials');
        }
    }

    public function delete($id)
    {
        $commercials = Commercials::find($id);
        $commercials->show = 0;
        $commercials->save();

        Session::flash('message', 'info_Reklama je obrisana!');

        return redirect('admin/commercials');
    }
}
