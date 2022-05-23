<?php


namespace App\Traits;

Trait AdminPermission{
    
    public function CheckRequestPermission() {
        if(
            //Brand Routes
            empty( auth()->user()->role->permission['permission']['brand']['view']) && \Route::is('brands') ||
            empty( auth()->user()->role->permission['permission']['brand']['add']) && \Route::is('brand.create') ||   
            empty( auth()->user()->role->permission['permission']['brand']['edit']) && \Route::is('brand.edit') ||   
            empty( auth()->user()->role->permission['permission']['brand']['edit']) && \Route::is('brand.update') ||   
            empty( auth()->user()->role->permission['permission']['brand']['delete']) && \Route::is('brand.delete') ||   
            //Category Routes
            empty( auth()->user()->role->permission['permission']['cat']['view']) && \Route::is('category') ||
            empty( auth()->user()->role->permission['permission']['cat']['add']) && \Route::is('category.create') ||   
            empty( auth()->user()->role->permission['permission']['cat']['edit']) && \Route::is('category.edit') ||   
            empty( auth()->user()->role->permission['permission']['cat']['edit']) && \Route::is('category.update') ||   
            empty( auth()->user()->role->permission['permission']['cat']['delete']) && \Route::is('category.delete') ||   
            //Sub-Category Routes
            empty( auth()->user()->role->permission['permission']['subcat']['view']) && \Route::is('subcategory') ||
            empty( auth()->user()->role->permission['permission']['subcat']['add']) && \Route::is('subcategory.create') ||   
            empty( auth()->user()->role->permission['permission']['subcat']['edit']) && \Route::is('subcategory.edit') ||   
            empty( auth()->user()->role->permission['permission']['subcat']['edit']) && \Route::is('subcategory.update') ||   
            empty( auth()->user()->role->permission['permission']['subcat']['delete']) && \Route::is('subcategory.delete') ||   
            //Sub-Sub-Category Routes
            empty( auth()->user()->role->permission['permission']['subsubcat']['view']) && \Route::is('sub-subcategory') ||
            empty( auth()->user()->role->permission['permission']['subsubcat']['add']) && \Route::is('sub-subcategory.create') ||   
            empty( auth()->user()->role->permission['permission']['subsubcat']['edit']) && \Route::is('sub-subcategory.edit') ||   
            empty( auth()->user()->role->permission['permission']['subsubcat']['edit']) && \Route::is('sub-subcategory.update') ||   
            empty( auth()->user()->role->permission['permission']['subsubcat']['delete']) && \Route::is('sub-subcategory.delete') ||   
            //Product Routes
            empty( auth()->user()->role->permission['permission']['product']['view']) && \Route::is('product.manage') ||
            empty( auth()->user()->role->permission['permission']['product']['view']) && \Route::is('product.view') ||
            empty( auth()->user()->role->permission['permission']['product']['add']) && \Route::is('product.add') ||   
            empty( auth()->user()->role->permission['permission']['product']['add']) && \Route::is('product.store') ||   
            empty( auth()->user()->role->permission['permission']['product']['add']) && \Route::is('product.clone') ||   
            empty( auth()->user()->role->permission['permission']['product']['edit']) && \Route::is('product.edit') ||   
            empty( auth()->user()->role->permission['permission']['product']['edit']) && \Route::is('product.update') ||   
            empty( auth()->user()->role->permission['permission']['product']['edit']) && \Route::is('product.thumb-update') ||   
            empty( auth()->user()->role->permission['permission']['product']['edit']) && \Route::is('product.multipleimg-update') ||   
            empty( auth()->user()->role->permission['permission']['product']['delete']) && \Route::is('product.delete') ||  
            empty( auth()->user()->role->permission['permission']['product']['delete']) && \Route::is('product.deleteImage') ||  
            empty( auth()->user()->role->permission['permission']['product']['delete']) && \Route::is('product.inactive') ||  
            empty( auth()->user()->role->permission['permission']['product']['delete']) && \Route::is('product.active') ||  
            //Slider Routes
            empty( auth()->user()->role->permission['permission']['slider']['view']) && \Route::is('sliders') ||
            empty( auth()->user()->role->permission['permission']['slider']['add']) && \Route::is('slider.create') ||   
            empty( auth()->user()->role->permission['permission']['slider']['edit']) && \Route::is('slider.edit') ||   
            empty( auth()->user()->role->permission['permission']['slider']['edit']) && \Route::is('slider.update') ||   
            empty( auth()->user()->role->permission['permission']['slider']['delete']) && \Route::is('slider.delete') || 
            empty( auth()->user()->role->permission['permission']['slider']['delete']) && \Route::is('slider.inactive') ||  
            empty( auth()->user()->role->permission['permission']['slider']['delete']) && \Route::is('slider.active') || 
            //Coupon Routes
            empty( auth()->user()->role->permission['permission']['coupon']['view']) && \Route::is('coupons') ||
            empty( auth()->user()->role->permission['permission']['coupon']['add']) && \Route::is('coupon.create') ||   
            empty( auth()->user()->role->permission['permission']['coupon']['edit']) && \Route::is('coupon.edit') ||   
            empty( auth()->user()->role->permission['permission']['coupon']['edit']) && \Route::is('coupon.update') ||   
            empty( auth()->user()->role->permission['permission']['coupon']['delete']) && \Route::is('coupon.delete') || 
            //Division Routes
            empty( auth()->user()->role->permission['permission']['shipping']['view']) && \Route::is('division') ||
            empty( auth()->user()->role->permission['permission']['shipping']['add']) && \Route::is('division.create') ||   
            empty( auth()->user()->role->permission['permission']['shipping']['edit']) && \Route::is('division.edit') ||   
            empty( auth()->user()->role->permission['permission']['shipping']['edit']) && \Route::is('division.update') ||   
            empty( auth()->user()->role->permission['permission']['shipping']['delete']) && \Route::is('division.delete') || 
            //District Routes
            empty( auth()->user()->role->permission['permission']['shipping']['view']) && \Route::is('district') ||
            empty( auth()->user()->role->permission['permission']['shipping']['add']) && \Route::is('district.create') ||   
            empty( auth()->user()->role->permission['permission']['shipping']['edit']) && \Route::is('district.edit') ||   
            empty( auth()->user()->role->permission['permission']['shipping']['edit']) && \Route::is('district.update') ||   
            empty( auth()->user()->role->permission['permission']['shipping']['delete']) && \Route::is('district.delete') || 
            //State Routes
            empty( auth()->user()->role->permission['permission']['shipping']['view']) && \Route::is('state') ||
            empty( auth()->user()->role->permission['permission']['shipping']['add']) && \Route::is('state.create') ||   
            empty( auth()->user()->role->permission['permission']['shipping']['edit']) && \Route::is('state.edit') ||   
            empty( auth()->user()->role->permission['permission']['shipping']['edit']) && \Route::is('state.update') ||   
            empty( auth()->user()->role->permission['permission']['shipping']['delete']) && \Route::is('state.delete') || 
            //Orders Routes
            empty( auth()->user()->role->permission['permission']['order']['view']) && \Route::is('pending-orders') ||
            empty( auth()->user()->role->permission['permission']['order']['view']) && \Route::is('confirmed-orders') ||
            empty( auth()->user()->role->permission['permission']['order']['view']) && \Route::is('processing-orders') ||
            empty( auth()->user()->role->permission['permission']['order']['view']) && \Route::is('picked-orders') ||
            empty( auth()->user()->role->permission['permission']['order']['view']) && \Route::is('shipped-orders') ||
            empty( auth()->user()->role->permission['permission']['order']['view']) && \Route::is('delivered-orders') ||
            empty( auth()->user()->role->permission['permission']['order']['view']) && \Route::is('cancel-orders') ||
            empty( auth()->user()->role->permission['permission']['order']['view']) && \Route::is('view-order') ||
            empty( auth()->user()->role->permission['permission']['order']['view']) && \Route::is('invoice-download') ||
            empty( auth()->user()->role->permission['permission']['order']['delete']) && \Route::is('delete-order') ||
            //Order Status Change Routes
            empty( auth()->user()->role->permission['permission']['order']['add']) && \Route::is('confirmOrder') ||
            empty( auth()->user()->role->permission['permission']['order']['add']) && \Route::is('processingOrder') ||
            empty( auth()->user()->role->permission['permission']['order']['add']) && \Route::is('pickedOrder') ||
            empty( auth()->user()->role->permission['permission']['order']['add']) && \Route::is('shippedOrder') ||
            empty( auth()->user()->role->permission['permission']['order']['add']) && \Route::is('deliveredOrder') ||
            empty( auth()->user()->role->permission['permission']['order']['add']) && \Route::is('cancelOrder') ||
            //Report Routes
            empty( auth()->user()->role->permission['permission']['report']['view']) && \Route::is('reports') ||
            empty( auth()->user()->role->permission['permission']['report']['view']) && \Route::is('search-by-date') ||
            empty( auth()->user()->role->permission['permission']['report']['view']) && \Route::is('search-by-month') ||
            empty( auth()->user()->role->permission['permission']['report']['view']) && \Route::is('search-by-year') ||
            //Product Review Routes
            empty( auth()->user()->role->permission['permission']['review']['view']) && \Route::is('pending-reviews') ||
            empty( auth()->user()->role->permission['permission']['review']['view']) && \Route::is('approved-reviews') ||
            empty( auth()->user()->role->permission['permission']['review']['add']) && \Route::is('approve-review') ||
            empty( auth()->user()->role->permission['permission']['review']['delete']) && \Route::is('delete-review') ||
            //Stock Management Routes
            empty( auth()->user()->role->permission['permission']['stock']['view']) && \Route::is('product-stock') ||
            empty( auth()->user()->role->permission['permission']['stock']['edit']) && \Route::is('stock-edit') ||
            empty( auth()->user()->role->permission['permission']['stock']['edit']) && \Route::is('stock-update') ||
            //Role Routes
            empty( auth()->user()->role->permission['permission']['role']['view']) && \Route::is('role.index') ||
            empty( auth()->user()->role->permission['permission']['role']['add']) && \Route::is('role.create') ||
            empty( auth()->user()->role->permission['permission']['role']['add']) && \Route::is('role.store') ||
            empty( auth()->user()->role->permission['permission']['role']['edit']) && \Route::is('role.edit') ||
            empty( auth()->user()->role->permission['permission']['role']['edit']) && \Route::is('role.update') ||
            empty( auth()->user()->role->permission['permission']['role']['delete']) && \Route::is('role.destroy') ||
            //Permission Routes
            empty( auth()->user()->role->permission['permission']['permission']['view']) && \Route::is('permission.index') ||
            empty( auth()->user()->role->permission['permission']['permission']['add']) && \Route::is('permission.create') ||
            empty( auth()->user()->role->permission['permission']['permission']['add']) && \Route::is('permission.store') ||
            empty( auth()->user()->role->permission['permission']['permission']['edit']) && \Route::is('permission.edit') ||
            empty( auth()->user()->role->permission['permission']['permission']['edit']) && \Route::is('permission.update') ||
            empty( auth()->user()->role->permission['permission']['permission']['delete']) && \Route::is('permission.destroy') ||
            //Sub-Admin Routes
            empty( auth()->user()->role->permission['permission']['subadmin']['view']) && \Route::is('subadmin.index') ||
            empty( auth()->user()->role->permission['permission']['subadmin']['add']) && \Route::is('subadmin.create') ||
            empty( auth()->user()->role->permission['permission']['subadmin']['add']) && \Route::is('subadmin.store') ||
            empty( auth()->user()->role->permission['permission']['subadmin']['edit']) && \Route::is('subadmin.edit') ||
            empty( auth()->user()->role->permission['permission']['subadmin']['edit']) && \Route::is('subadmin.update') ||
            empty( auth()->user()->role->permission['permission']['subadmin']['delete']) && \Route::is('subadmin.destroy') ||
            //Chat Routes
            empty( auth()->user()->role->permission['permission']['chat']['view']) && \Route::is('admin-chat') ||
            empty( auth()->user()->role->permission['permission']['chat']['view']) && \Route::is('admin.chat.users') ||
            empty( auth()->user()->role->permission['permission']['chat']['view']) && \Route::is('admin.user.msg') ||
            empty( auth()->user()->role->permission['permission']['chat']['add']) && \Route::is('admin.send.msg') ||
            //Settings Routes
            empty( auth()->user()->role->permission['permission']['settings']['view']) && \Route::is('settings') ||
            empty( auth()->user()->role->permission['permission']['settings']['view']) && \Route::is('settings.create') ||
            //All User Routes
            empty( auth()->user()->role->permission['permission']['alluser']['list']) && \Route::is('all-users') ||
            empty( auth()->user()->role->permission['permission']['alluser']['delete']) && \Route::is('userBanned') ||
            empty( auth()->user()->role->permission['permission']['alluser']['delete']) && \Route::is('userUnbanned') 
                   
        ){
            $notification = array(
            'message' => 'You Have No Permission!!',
            'alert-type' => 'error'
            );
            return Redirect()->route('admin.dashboard')->with($notification);
            
        }
          
        
        
    }
    
    
}
