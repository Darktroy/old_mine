<?php

namespace App\Http\Controllers\Common;

use App\Models\SiteConfig;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\UploadedFile;
use Session;

class SiteConfigController extends Controller
{
    //
    public function index()
    {
        $page_title = 'SiteConfig';
        $search = false;
        $sub_title = 'Manage Site Config';
        return view('panel.siteConfig.index', compact('page_title', 'search', 'sub_title'));
    }

    public function storeConfig(Request $request)
    {
//        dd($request->all());
        $inputs = Input::except('_token');
        foreach ($inputs as $key => $value) {

            $data = SiteConfig::findOrCreate($key);
            $data->key = $key;
            if ($value instanceof UploadedFile) {
                $file = Input::file($key);
                $destinationPath = 'public/media/config/';
                $filename = $file->getClientOriginalName();
                $file->move($destinationPath, $filename);
                $data->value = $destinationPath . $filename;
            } else {
                $data->value = $value;
            }
            $data->save();
        }
        Session::flash('message', 'Site Configs updated Successfully');
        return redirect()->back();
    }
}
