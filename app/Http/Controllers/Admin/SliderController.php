<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;

class SliderController extends Controller {

//==================================== Show Slider Page =============================================//    
    public function index() {
        $sliders = Slider::latest()->get();
        return view('admin.slider.index', compact('sliders'));
    }

//==================================== Create New Slider =============================================//    
    public function createSlider(Request $request) {
        $request->validate([
            'slider_image' => 'required',
            'url' => 'required',
                ], [
            'slider_image.required' => 'Chose a Slider Image',
            'url.required' => 'URL in English Required',
        ]);

        //Image Upload with resize using Intervention Package
        $title = str_replace(' ', '-', $request->slider_title_en);
        $image = $request->file('slider_image');
        $imageName = $request->$title . '-' . hexdec(uniqid()) . '-' . hexdec(rand()) . '.' . $image->getClientOriginalExtension();
        $directory = 'uploads/slider/';
        Image::make($image->path())->resize(870, 370)->save($directory . $imageName);
        //End: Image Upload with resize using Intervention Package

        Slider::insert([
            'slider_title_en' => $request->slider_title_en,
            'slider_title_bn' => $request->slider_title_bn,
            'slider_description_en' => $request->slider_description_en,
            'slider_description_bn' => $request->slider_description_bn,
            'url' => strtolower(str_replace(' ', '-', $request->url)),
            'slider_image' => $imageName,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Slider Created Successfully !!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

//==================================== Slider Edit =============================================//
    public function editSlider($id) {
        $slider = Slider::findOrFail($id);
        return view('admin.slider.edit', compact('slider'));
    }

//==================================== Slider Update =============================================//
    public function updateSlider(Request $request) {
        $request->validate([
            'url' => 'required',
                ], [
            'url.required' => 'URL in English Required',
        ]);
        
        $sliderId = $request->slider_id;
        $oldImage = $request->old_slider_image;

        if ($request->file('slider_image') != '') {
            $directory = 'uploads/slider/';
            unlink($directory . $oldImage);

            //Image Upload with resize using Intervention Package
            $title = str_replace(' ', '-', $request->slider_title_en);
            $image = $request->file('slider_image');
            $imageName = $request->$title . '-' . hexdec(uniqid()) . '-' . hexdec(rand()) . '.' . $image->getClientOriginalExtension();
            $directory = 'uploads/slider/';
            Image::make($image->path())->resize(870, 370)->save($directory . $imageName);
            //End: Image Upload with resize using Intervention Package

            Slider::findOrFail($sliderId)->update([
                'slider_title_en' => $request->slider_title_en,
                'slider_title_bn' => $request->slider_title_bn,
                'slider_description_en' => $request->slider_description_en,
                'slider_description_bn' => $request->slider_description_bn,
                'url' => strtolower(str_replace(' ', '-', $request->url)),
                'slider_image' => $imageName,
                'updated_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Slider Updated Successfully !!',
                'alert-type' => 'success'
            );
            return Redirect()->route('sliders')->with($notification);
        } else {
            Slider::findOrFail($sliderId)->update([
                'slider_title_en' => $request->slider_title_en,
                'slider_title_bn' => $request->slider_title_bn,
                'slider_description_en' => $request->slider_description_en,
                'slider_description_bn' => $request->slider_description_bn,
                'url' => strtolower(str_replace(' ', '-', $request->url)),
                'updated_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Slider Updated Successfully !!',
                'alert-type' => 'success'
            );
            return Redirect()->route('sliders')->with($notification);
        }
    }

//==================================== Slider Delete =============================================//
    public function deleteSlider($id) {
        $directory = 'uploads/slider/';
        $image_name = Slider::findOrFail($id)->slider_image;
        unlink($directory . $image_name);
        Slider::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Slider Deleted Successfully !!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

//==================================== Active Slider =============================================//       
    public function activeSlider($id) {
        Slider::findOrFail($id)->update([
            'status' => 1,
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Status Activated Successfully !!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

//==================================== In-Active Slider =============================================//       
    public function inactiveSlider($id) {
        Slider::findOrFail($id)->update([
            'status' => 0,
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Status In-Activated Successfully !!',
            'alert-type' => 'warning'
        );
        return Redirect()->back()->with($notification);
    }

}
