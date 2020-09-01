<?php

namespace App\Http\Controllers\Admin;

use App\Ads;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;

class AdsController extends Controller
{
    public function index()
    {
        try {
            $ads = Ads::all()->where('show', '=', 1);

            return view('admin.ads.allads', ['active' => 'allAds', 'ads' => $ads]);
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
        try{
        return view('admin.ads.create', ['active' => 'addAds']);
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
                'photos' => 'required | dimensions:width=900,height=600'
            ]);
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

            Session::flash('message', 'success_Oglas je dodat!');
            return redirect('admin/ads');

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
            $ad = Ads::find($id);;
            return view('admin.ads.edit', ['active' => 'addAds', 'ad' => $ad]);
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
            if ($request->get('removeimage') != null) {
                $removeimage = $request->get('removeimage');
                if ($removeimage == "true") {
                    $validator = Validator::make($request->all(), [
                        'photos' => 'required | dimensions:width=900,height=600',
                    ]);
                    if ($validator->fails()) {
                        return redirect()->back()
                            ->withErrors($validator)
                            ->withInput($request->input());
                    }
                }
            }

            $ad = Ads::find($id);
            $ad->update($request->except('photos'));
            $ad->save();

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
            $ad = Ads::find($id);
            $ad->show = 0;
            $ad->save();

            Session::flash('message', 'info_Vest je obrisana!');
            return redirect('admin/ads');
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
