<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Division;

class DivisionController extends Controller
{
         
//==================================== Show Division Page =============================================//       
   public function index() {
        $divisions = Division::latest()->get();
        return view('admin.shipping-area.division.index', compact('divisions'));
    }

       
//==================================== Create New Division =============================================//    
    public function createDivision(Request $request) {
        $request->validate([
            'division_name_en' => 'required',
            'division_name_bn' => 'required',
                ], [
            'division_name_en.required' => 'Input English Division Name',
            'division_name_bn.required' => 'Input Bangla Division Name',
        ]);

        Division::insert([
            'division_name_en' => $request->division_name_en,
            'division_name_bn' => $request->division_name_bn,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Division Created Successfully !!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
  
    
//==================================== Division Edit =============================================//
    public function editDivision($id) {
        $division = Division::findOrFail($id);
        return view('admin.shipping-area.division.edit', compact('division'));
    }

  
//==================================== Division Update =============================================//
    public function updateDivision(Request $request) {
        $request->validate([
            'division_name_en' => 'required',
            'division_name_bn' => 'required',
                ], [
            'division_name_en.required' => 'Input English Division Name',
            'division_name_bn.required' => 'Input Bangla Division Name',
        ]);

        $divisionId = $request->division_id;

            Division::findOrFail($divisionId)->update([
                'division_name_en' => $request->division_name_en,
                'division_name_bn' => $request->division_name_bn,
                'updated_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Division Updated Successfully !!',
                'alert-type' => 'success'
            );
            return Redirect()->route('division')->with($notification);
       
    }

    
//==================================== Division Delete =============================================//
    public function deleteDivision($id) {
        Division::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Division Deleted Successfully !!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    
    
}
