<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductReview;
use Carbon\Carbon;

class ReviewController extends Controller
{
    public function pendingReviews() {
        $pendingReviews = ProductReview::where('status', 'Pending')->latest()->get();
        return view('admin.review.pending', compact('pendingReviews'));
    }
    
    
    public function approvedReviews() {
        $approvedReviews = ProductReview::where('status', 'Approve')->latest()->get();
        return view('admin.review.approved', compact('approvedReviews'));
    }
    
    
    public function approveReview($review_id) {
        ProductReview::findOrFail($review_id)->update([
            'status' => 'Approve',
            'updated_at' => Carbon::now()
        ]);
        $notification = array(
            'message' => 'Review Approved Successfully !!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
    
    
    public function deleteReview($review_id) {
        ProductReview::findOrFail($review_id)->delete();
        $notification = array(
            'message' => 'Review Deleted Successfully !!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
    
    
    
}
