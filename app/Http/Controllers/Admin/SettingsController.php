<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SettingsController extends Controller
{
    public function index(){
        $settings = Setting::where('id', 1)->first();
        return view('admin.settings.index', compact('settings'));
    }

    
    public function create(Request $request){

        $settings = Setting::where('id', 1)->first();

        if($settings){

                $request->validate([
                    'site_name' => 'required',
                    'site_title' => 'required',
                    'address' => 'required',
                    'email' => 'required',
                    'mobile' => 'required',
                ]);

                if ($request->file('site_logo') != '') {
                    $directory = 'uploads/settings/';
                    $oldLogo = $settings->site_logo;
                    unlink($directory . $oldLogo);

                    //Logo Upload with resize using Intervention Package
                    $logo = $request->file('site_logo');
                    $logoName = 'logo' . '.' . $logo->getClientOriginalExtension();
                    $directory = 'uploads/settings/';
                    Image::make($logo->path())->resize(null, 30, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($directory . $logoName);
                    //End: Logo Upload with resize using Intervention Package
                }else{
                    $logoName = $settings->site_logo;
                }
                 

                if ($request->file('favicon_icon') != '') {
                    $directory = 'uploads/settings/';
                    $oldFavicon = $settings->favicon_icon;
                    unlink($directory . $oldFavicon);

                    //Favicon Upload with resize using Intervention Package
                    $favicon = $request->file('favicon_icon');
                    $faviconName = 'favicon_icon' . '.' . $favicon->getClientOriginalExtension();
                    $directory = 'uploads/settings/';
                    Image::make($favicon->path())->resize(16, 16, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($directory . $faviconName);
                    //End: Favicon Upload with resize using Intervention Package
                }else{
                    $faviconName = $settings->favicon_icon;
                }
 
                 Setting::findOrFail(1)->update([
                     'site_name' => $request->site_name,
                     'site_title' => $request->site_title,
                     'site_logo' => $logoName,
                     'favicon_icon' => $faviconName,
                     'address' => $request->address,
                     'email' => $request->email,
                     'mobile' => $request->mobile,
                     'facebook' => $request->facebook,
                     'instagram' => $request->instagram,
                     'twitter' => $request->twitter,
                     'pinterest' => $request->pinterest,
                     'linkedin' => $request->linkedin,
                     'youtube' => $request->youtube,
                     'updated_at' => Carbon::now(),
                 ]);
                

        }else{

                $request->validate([
                    'site_name' => 'required',
                    'site_title' => 'required',
                    'site_logo' => 'required',
                    'favicon_icon' => 'required',
                    'address' => 'required',
                    'email' => 'required',
                    'mobile' => 'required',
                ]);
            
                //Logo Upload with resize using Intervention Package
                $logo = $request->file('site_logo');
                $logoName = 'logo' . '.' . $logo->getClientOriginalExtension();
                $directory = 'uploads/settings/';
                Image::make($logo->path())->resize(null, 30, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($directory . $logoName);
                //End: Logo Upload with resize using Intervention Package
                
                //Favicon Upload with resize using Intervention Package
                $favicon = $request->file('favicon_icon');
                $faviconName = 'favicon_icon' . '.' . $favicon->getClientOriginalExtension();
                $directory = 'uploads/settings/';
                Image::make($favicon->path())->resize(16, 16, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($directory . $faviconName);
                //End: Favicon Upload with resize using Intervention Package

                Setting::insert([
                    'site_name' => $request->site_name,
                    'site_title' => $request->site_title,
                    'site_logo' => $logoName,
                    'favicon_icon' => $faviconName,
                    'address' => $request->address,
                    'email' => $request->email,
                    'mobile' => $request->mobile,
                    'facebook' => $request->facebook,
                    'instagram' => $request->instagram,
                    'twitter' => $request->twitter,
                    'pinterest' => $request->pinterest,
                    'linkedin' => $request->linkedin,
                    'youtube' => $request->youtube,
                    'created_at' => Carbon::now(),
                ]);
            
        }


        $notification = array(
            'message' => 'Settings Configured Successfully !!',
            'alert-type' => 'success'
        );
        return Redirect()->route('admin.dashboard')->with($notification);
    }



}
