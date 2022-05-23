<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Division;
use App\Models\District;

class DistrictController extends Controller
{
         
//==================================== Show District Page =============================================//       
   public function index() {
        $districts = District::latest()->get();
        $divisions = Division::orderBy('division_name_en', 'ASC')->get();
        return view('admin.shipping-area.district.index', compact('districts', 'divisions'));
    }

    
//==================================== Create New District =============================================//    
    public function createDistrict(Request $request) {
        $request->validate([
            'district_name_en' => 'required',
            'district_name_bn' => 'required',
            'division_id' => 'required',
                ], [
            'district_name_en.required' => 'Input English District Name',
            'district_name_bn.required' => 'Input Bangla District Name',
            'division_id.required' => 'Chose a Division',
        ]);

        District::insert([
            'district_name_en' => $request->district_name_en,
            'district_name_bn' => $request->district_name_bn,
            'division_id' => $request->division_id,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'District Created Successfully !!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    
//==================================== District Edit =============================================//
    public function editDistrict($id) {
        $district = District::findOrFail($id);
        $divisions = Division::orderBy('division_name_en', 'ASC')->get();
        return view('admin.shipping-area.district.edit', compact('district', 'divisions'));
    }

//==================================== District Update =============================================//
    public function updateDistrict(Request $request) {
        $request->validate([
            'district_name_en' => 'required',
            'district_name_bn' => 'required',
            'division_id' => 'required',
                ], [
            'district_name_en.required' => 'Input English District Name',
            'district_name_bn.required' => 'Input Bangla District Name',
            'division_id.required' => 'Chose a Division',
        ]);

        $district_id = $request->district_id;
        
        District::findOrFail($district_id)->update([
            'district_name_en' => $request->district_name_en,
            'district_name_bn' => $request->district_name_bn,
            'division_id' => $request->division_id,
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'District Updated Successfully !!',
            'alert-type' => 'success'
        );
        return Redirect()->route('district')->with($notification);
    }

    
//==================================== District Delete =============================================//
    public function deleteDistrict($id) {
        District::findOrFail($id)->delete();

        $notification = array(
            'message' => 'District Deleted Successfully !!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    
    
}
