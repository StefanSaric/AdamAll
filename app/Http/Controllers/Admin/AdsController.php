<?php

namespace App\Http\Controllers\Admin;

use App\Ads;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;

class AdsController extends Controller
{
    public function index()
    {
        $ads = Ads::all()->where('show', '=', 1);

        return view('admin.ads.allads', ['active' => 'allAds', 'ads' => $ads]);
    }

    public function create()
    {
        return view('admin.ads.create', ['active' => 'addAds']);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required | dimensions:min_width=500,max_width=500,min_height=500,max_height=500'
        ]);
        if ($validator->fails()) {
            $validator->errors()->add('field', 'Slika nije odgovarajuceg formata!');
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput($request->input());
            }
            $ad = Ads::create(['image_title' => $request->image_title, 'image_link' => $request->image_link,
                'text' => $request->text, 'link' => $request->link, 'link_type' => $request->link_type,
                'link_title' => $request->link_title, 'link_text' => $request->link_text]);
            $photo_id = 0;
            $path = 'images/ads/' . $ad->id;
            if ($request->file('photos') != null) {
                foreach ($request->file('photos') as $photo) {
                    $photo_id++;
                    $image_path = public_path($path) . '/slika_' . $photo_id . '.' . $photo->getClientOriginalExtension();
                    if (!is_dir(dirname($image_path))) {
                        mkdir(dirname($image_path), 0777, true);
                    }

                    Image::make($photo->getRealPath())->save(public_path($path) . '/slika_' . $photo_id . '.' . $photo->getClientOriginalExtension());
                    $image = $path . '/slika_' . $photo_id . '.' . $photo->getClientOriginalExtension();
                    $ad->image = $image;
                    $ad->save();
                }

                Session::flash('message', 'success_Oglas je dodat!');

                return redirect('admin/ads');
            }
        }
    }

    public function edit($id)
    {
        $ad = Ads::find($id);;

        return view('admin.ads.edit', ['active' => 'addAds', 'ad' => $ad]);
    }

    public function update(Request $request, $id)
    {
        if ($request->get('removeimage') != null) {
            $validator = Validator::make($request->all(), [
                'photos' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator);
            }
        }

        $ad = Ads::find($id);
        $ad->update($request->except('photos'));
        $ad->save();

        if ($request->get('removeimage') != null) {
            $removeimage = $request->get('removeimage');
            if ($removeimage == "true") {
                $ad->update([
                    'image' => null
                ]);
            }
        }

        $photo_id = 0;
        $path = 'images/ads/' . $ad->id;
        if ($request->file('photos') != null) {
            $photo = $request->file('photos');
            $photo_id++;
            $image_path = public_path($path) . '/slika_' . $photo_id . '.' . $photo->getClientOriginalExtension();
            if (!is_dir(dirname($image_path))) {
                mkdir(dirname($image_path), 0777, true);
            }
            Image::make($photo->getRealPath())->save(public_path($path) . '/slika_' . $photo_id . '.' . $photo->getClientOriginalExtension());
            $image = $path . '/slika_' . $photo_id . '.' . $photo->getClientOriginalExtension();
            $ad->image = $image;
            $ad->save();
        }


        Session::flash('message', 'success_Oglas je uređen!');

        return redirect('admin/ads');

    }

    public function delete($id)
    {
        $ad = Ads::find($id);
        $ad->show = 0;
        $ad->save();

        Session::flash('message', 'info_Vest je obrisana!');

        return redirect('admin/ads');
    }
}
