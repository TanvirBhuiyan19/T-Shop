<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\State;
use App\Models\District;
use App\Models\Division;

class StateController extends Controller
{
         
//==================================== Show State Page =============================================//       
   public function index() {
        $states = State::latest()->get();
        $districts = District::orderBy('district_name_en', 'ASC')->get();
        $divisions = Division::orderBy('division_name_en', 'ASC')->get();
        return view('admin.shipping-area.state.index', compact('states', 'districts', 'divisions'));
    }
    

//==================================== Create New State =============================================//    
    public function createState(Request $request) {
        $request->validate([
            'state_name_en' => 'required',
            'state_name_bn' => 'required',
            'division_id' => 'required',
            'district_id' => 'required',
                ], [
            'state_name_en.required' => 'Input English Sub-subCategory Name',
            'state_name_bn.required' => 'Input Bangla Sub-subCategory Name',
            'division_id.required' => 'Chose a Division',
            'district_id.required' => 'Chose a District',
        ]);

        State::insert([
            'state_name_en' => $request->state_name_en,
            'state_name_bn' => $request->state_name_bn,
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'State Created Successfully !!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

       
         
//==================================== Edit State Page =============================================//       
   public function editState($id) {
        $state = State::findOrFail($id);
        $districts = District::orderBy('district_name_en', 'ASC')->get();
        $divisions = Division::orderBy('division_name_en', 'ASC')->get();
        return view('admin.shipping-area.state.edit', compact('state', 'districts', 'divisions'));
    }
    
       
    
    
//==================================== State Update =============================================//
    public function updateState(Request $request) {
        $request->validate([
            'state_name_en' => 'required',
            'state_name_bn' => 'required',
            'division_id' => 'required',
            'district_id' => 'required',
                ], [
            'state_name_en.required' => 'Input English State Name',
            'state_name_bn.required' => 'Input Bangla State Name',
            'division_id.required' => 'Chose a Category',
            'district_id.required' => 'Chose a SubCategory',
        ]);

        $state_id = $request->state_id;
        
        State::findOrFail($state_id)->update([
            'state_name_en' => $request->state_name_en,
            'state_name_bn' => $request->state_name_bn,
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'State Updated Successfully !!',
            'alert-type' => 'success'
        );
        return Redirect()->route('state')->with($notification);
    }

      
    
//==================================== Get District By Ajax =============================================//       
    public function getDistrict($division_id) {
        $district = District::where('division_id', $division_id)->orderBy('district_name_en', 'ASC')->get();
        return json_encode($district);
    }
    

//==================================== State Delete =============================================//
    public function deleteState($id) {
        State::findOrFail($id)->delete();

        $notification = array(
            'message' => 'State Deleted Successfully !!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    
    
    
}
