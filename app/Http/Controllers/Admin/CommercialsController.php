<?php

namespace App\Http\Controllers\Admin;

use App\Commercials;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Log;;

class CommercialsController extends Controller
{

    public function index()
    {
        try {
            $commercials = Commercials::all()->where('show', '=', 1);

            return view('admin.commercials.allcommercials', ['active' => 'allCommercials', 'commercials' => $commercials]);

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

    public function create()
    {
        try {
            return view('admin.commercials.create', ['active' => 'addCommercials']);

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

            $commercials = Commercials::create(['image_tag' => $request->image_tag, 'title' => $request->title,
                'link' => $request->link, 'text' => $request->text]);

            $photo_id = 0;
            $path = 'images/commercials/' . $commercials->id;
            if ($request->file('photos') != null) {
                $photo = $request->file('photos');
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


    public function edit($id)
    {
        try {
            $commercials = Commercials::find($id);;

            return view('admin.commercials.edit', ['active' => 'addCommercials', 'commercials' => $commercials]);

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

    public function update(Request $request, $id)
    {
        try {
            if ($request->get('removeimage') != null) {
                $removeimage = $request->get('removeimage');
                if ($removeimage == "true") {
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

            $commercials = Commercials::find($id);
            $commercials->update($request->except('photos'));
            $commercials->save();

            $photo_id = 0;
            $path = 'images/commercials/' . $commercials->id;
            if ($request->file('photos') != null) {
                $photo = $request->file('photos');
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

    public function delete($id)
    {
        try {
            $commercials = Commercials::find($id);
            $commercials->show = 0;
            $commercials->save();

            Session::flash('message', 'info_Reklama je obrisana!');

            return redirect('admin/commercials');

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
