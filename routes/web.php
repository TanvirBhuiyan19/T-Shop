<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\SubSubcategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DivisionController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\StockController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SubadminController;

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\ChatController;

use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\LanguageController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\TrackingController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Frontend\ShopController;

use App\Http\Controllers\SslCommerzPaymentController;
use Illuminate\Support\Facades\Artisan;

Route::get('/', [IndexController::Class, 'index']);

Auth::routes();

    //FOR DATABASE SEEDER
    Route::group([ 'middleware' => ['auth'] ], function () {  
        Route::get('db-seed', function(){
            if(auth()->user()->id == 1 && auth()->user()->role_id == 2){
                Artisan::call('db:seed --force');
                return "Role and Permission Created Successfully! Also make you as Super Admin!";
            }else{
                abort(404);
            }
        });
    });


//============================= Admin Routes ====================================================//
Route::group(['prefix' => 'admin', 'middleware' => ['admin', 'auth', 'adminpermission'] ], function () {
    //Admin Profile
    Route::get('dashboard', [AdminController::Class, 'index'])->name('admin.dashboard');
    Route::get('profile', [AdminController::Class, 'profile'])->name('admin.profile');
    Route::post('info/change', [AdminController::Class, 'adminInfoChange'])->name('adminInfo.change');
    Route::post('password/change', [AdminController::Class, 'adminPassChange'])->name('adminPass.change');
    Route::post('image/change', [AdminController::Class, 'imageChange'])->name('adminImage.change');
    
    //Show All Users
    Route::get('all-users', [AdminController::Class, 'allUsers'])->name('all-users');
    
    //User Banned and Unbanned
    Route::get('/user-banned/{user_id}', [AdminController::Class, 'userBanned'])->name('userBanned');
    Route::get('/user-unbanned/{user_id}', [AdminController::Class, 'userUnbanned'])->name('userUnbanned');
    
    //Brand Route
    Route::get('brands', [BrandController::Class, 'index'])->name('brands');
    Route::post('brand/create', [BrandController::Class, 'createBrand'])->name('brand.create');
    Route::get('/brand/edit/{id}', [BrandController::Class, 'editBrand'])->name('brand.edit');
    Route::post('/brand/update', [BrandController::Class, 'updateBrand'])->name('brand.update');
    Route::get('/brand/delete/{id}', [BrandController::Class, 'deleteBrand'])->name('brand.delete');
    
    //Category Route
    Route::get('category', [CategoryController::Class, 'index'])->name('category');
    Route::post('category/create', [CategoryController::Class, 'createCategory'])->name('category.create');
    Route::get('/category/edit/{id}', [CategoryController::Class, 'editCategory'])->name('category.edit');
    Route::post('/category/update', [CategoryController::Class, 'updateCategory'])->name('category.update');
    Route::get('/category/delete/{id}', [CategoryController::Class, 'deleteCategory'])->name('category.delete'); 
    
    //Subcategory Route   
    Route::get('subcategory', [SubcategoryController::Class, 'index'])->name('subcategory');
    Route::post('subcategory/create', [SubcategoryController::Class, 'createSubcategory'])->name('subcategory.create');
    Route::get('/subcategory/edit/{id}', [SubcategoryController::Class, 'editSubcategory'])->name('subcategory.edit');
    Route::post('/subcategory/update', [SubcategoryController::Class, 'updateSubcategory'])->name('subcategory.update');
    Route::get('/subcategory/delete/{id}', [SubcategoryController::Class, 'deleteSubcategory'])->name('subcategory.delete');
    
    //Sub-subCategory Route   
    Route::get('sub-subcategory', [SubSubcategoryController::Class, 'index'])->name('sub-subcategory');
    Route::post('sub-subcategory/create', [SubSubcategoryController::Class, 'createSubSubcategory'])->name('sub-subcategory.create');
    Route::get('/sub-subcategory/edit/{id}', [SubSubcategoryController::Class, 'editSubSubcategory'])->name('sub-subcategory.edit');
    Route::post('/sub-subcategory/update', [SubSubcategoryController::Class, 'updateSubSubcategory'])->name('sub-subcategory.update');
    Route::get('/sub-subcategory/delete/{id}', [SubSubcategoryController::Class, 'deleteSubSubcategory'])->name('sub-subcategory.delete');
    Route::get('/subcategory/ajax/{category_id}', [SubSubcategoryController::Class, 'getSubcategory']);
    
    //Product Route   
    Route::get('product/manage', [ProductController::Class, 'manageProduct'])->name('product.manage');
    Route::get('/sub-subcategory/ajax/{subcategory_id}', [ProductController::Class, 'getSubSubcategory']);
    Route::get('product/add', [ProductController::Class, 'addProduct'])->name('product.add');
    Route::post('product/store', [ProductController::Class, 'createProduct'])->name('product.store');
    Route::get('/product/edit/{id}', [ProductController::Class, 'editProduct'])->name('product.edit');
    Route::post('/product/update', [ProductController::Class, 'updateProduct'])->name('product.update');
    Route::post('/product/thumb-update', [ProductController::Class, 'thumbUpdateProduct'])->name('product.thumb-update');
    Route::post('/product/multipleimg-update', [ProductController::Class, 'updateProductImage'])->name('product.multipleimg-update');
    Route::get('/product/view/{id}', [ProductController::Class, 'viewProduct'])->name('product.view');
    Route::get('/product/clone/{id}', [ProductController::Class, 'cloneProduct'])->name('product.clone');
    Route::get('/product/delete/{id}', [ProductController::Class, 'deleteProduct'])->name('product.delete');
    Route::get('/product/multipleimg-delete/{id}', [ProductController::Class, 'deleteProductImage'])->name('product.deleteImage');
    Route::get('/product/active/{id}', [ProductController::Class, 'activeProduct'])->name('product.active');
    Route::get('/product/inactive/{id}', [ProductController::Class, 'inactiveProduct'])->name('product.inactive');
    
    //Slider Route
    Route::get('sliders', [SliderController::Class, 'index'])->name('sliders');
    Route::post('slider/create', [SliderController::Class, 'createSlider'])->name('slider.create');
    Route::get('/slider/edit/{id}', [SliderController::Class, 'editSlider'])->name('slider.edit');
    Route::post('/slider/update', [SliderController::Class, 'updateSlider'])->name('slider.update');
    Route::get('/slider/delete/{id}', [SliderController::Class, 'deleteSlider'])->name('slider.delete');
    Route::get('/slider/active/{id}', [SliderController::Class, 'activeSlider'])->name('slider.active');
    Route::get('/slider/inactive/{id}', [SliderController::Class, 'inactiveSlider'])->name('slider.inactive');
    
    //Coupon Route
    Route::get('coupons', [CouponController::Class, 'index'])->name('coupons');
    Route::post('coupon/create', [CouponController::Class, 'createCoupon'])->name('coupon.create');
    Route::get('/coupon/edit/{id}', [CouponController::Class, 'editCoupon'])->name('coupon.edit');
    Route::post('/coupon/update', [CouponController::Class, 'updateCoupon'])->name('coupon.update');
    Route::get('/coupon/delete/{id}', [CouponController::Class, 'deleteCoupon'])->name('coupon.delete');
    
    //Division Route
    Route::get('division', [DivisionController::Class, 'index'])->name('division');
    Route::post('division/create', [DivisionController::Class, 'createDivision'])->name('division.create');
    Route::get('/division/edit/{id}', [DivisionController::Class, 'editDivision'])->name('division.edit');
    Route::post('/division/update', [DivisionController::Class, 'updateDivision'])->name('division.update');
    Route::get('/division/delete/{id}', [DivisionController::Class, 'deleteDivision'])->name('division.delete');
    
    //District Route
    Route::get('district', [DistrictController::Class, 'index'])->name('district');
    Route::post('district/create', [DistrictController::Class, 'createDistrict'])->name('district.create');
    Route::get('/district/edit/{id}', [DistrictController::Class, 'editDistrict'])->name('district.edit');
    Route::post('/district/update', [DistrictController::Class, 'updateDistrict'])->name('district.update');
    Route::get('/district/delete/{id}', [DistrictController::Class, 'deleteDistrict'])->name('district.delete');
    
    //State Route
    Route::get('state', [StateController::Class, 'index'])->name('state');
    Route::post('state/create', [StateController::Class, 'createState'])->name('state.create');
    Route::get('/state/edit/{id}', [StateController::Class, 'editState'])->name('state.edit');
    Route::post('/state/update', [StateController::Class, 'updateState'])->name('state.update');
    Route::get('/state/delete/{id}', [StateController::Class, 'deleteState'])->name('state.delete');
    Route::get('/district/ajax/{division_id}', [StateController::Class, 'getDistrict']);
    
    //Orders
    Route::get('pending-orders', [OrderController::Class, 'pendingOrders'])->name('pending-orders');
    Route::get('confirmed-orders', [OrderController::Class, 'confirmedOrders'])->name('confirmed-orders');
    Route::get('/processing-orders', [OrderController::Class, 'processingOrders'])->name('processing-orders');
    Route::get('/picked-orders', [OrderController::Class, 'pickedOrders'])->name('picked-orders');
    Route::get('/shipped-orders', [OrderController::Class, 'shippedOrders'])->name('shipped-orders');
    Route::get('/delivered-orders', [OrderController::Class, 'deliveredOrders'])->name('delivered-orders');
    Route::get('/cancel-orders', [OrderController::Class, 'cancelOrders'])->name('cancel-orders');
    Route::get('/order/view/{id}', [OrderController::Class, 'viewOrder'])->name('view-order');
    Route::get('/order/delete/{id}', [OrderController::Class, 'deleteOrder'])->name('delete-order');
    
    //Order Status Change
    Route::get('/confirm-order/{id}', [OrderController::Class, 'confirmOrder'])->name('confirmOrder');
    Route::get('/processing-order/{id}', [OrderController::Class, 'processingOrder'])->name('processingOrder');
    Route::get('/picked-order/{id}', [OrderController::Class, 'pickedOrder'])->name('pickedOrder');
    Route::get('/shipped-order/{id}', [OrderController::Class, 'shippedOrder'])->name('shippedOrder');
    Route::get('/delivered-order/{id}', [OrderController::Class, 'deliveredOrder'])->name('deliveredOrder');
    Route::get('/cancel-order/{id}', [OrderController::Class, 'cancelOrder'])->name('cancelOrder');
    
    //Order Invoice Download
    Route::get('invoice-download/{id}', [OrderController::Class, 'invoiceDownload'])->name('invoice-download');
    
    //Reports
    Route::get('reports', [ReportController::Class, 'index'])->name('reports');
    Route::post('search-by-date', [ReportController::Class, 'reportByDate'])->name('search-by-date');
    Route::post('search-by-month', [ReportController::Class, 'reportByMonth'])->name('search-by-month');
    Route::post('search-by-year', [ReportController::Class, 'reportByYear'])->name('search-by-year');
    
    //Product Review
    Route::get('pending-reviews', [ReviewController::Class, 'pendingReviews'])->name('pending-reviews');
    Route::get('approved-reviews', [ReviewController::Class, 'approvedReviews'])->name('approved-reviews');
    Route::get('/review/approve/{review_id}', [ReviewController::Class, 'approveReview'])->name('approve-review');
    Route::get('/review/delete/{review_id}', [ReviewController::Class, 'deleteReview'])->name('delete-review');
    
    //Stock Management
    Route::get('product-stock', [StockController::Class, 'index'])->name('product-stock');
    Route::get('product-stock/edit/{product_id}', [StockController::Class, 'editStock'])->name('stock-edit');
    Route::post('product-stock/update/{product_id}', [StockController::Class, 'updateStock'])->name('stock-update');
    
    //Role & Permission
    Route::resource('role', RoleController::Class);
    Route::resource('permission', PermissionController::Class);
    Route::resource('subadmin', SubadminController::Class);

    //Chat with Users
    Route::get('chats', [ChatController::Class, 'adminChatPage'])->name('admin-chat');
    Route::get('user-all',[ChatController::class,'getAllUsers'])->name('admin.chat.users');
    Route::get('/user-messages/{id}',[ChatController::class,'useMsgById'])->name('admin.user.msg');
    Route::post('send-message',[ChatController::class,'adminSendMsg'])->name('admin.send.msg');

    //Settings
    Route::get('settings', [SettingsController::Class, 'index'])->name('settings');
    Route::post('settings/add', [SettingsController::Class, 'create'])->name('settings.create');
    
});



//============================= User Routes ====================================================//
Route::group(['prefix' => 'user', 'middleware' => ['user', 'auth'] ], function () {
    
    //User Profile
    Route::get('dashboard', [UserController::Class, 'index'])->name('user.dashboard');
    Route::post('info/change', [UserController::Class, 'userInfoChange'])->name('userInfo.change');
    Route::post('password/change', [UserController::Class, 'passwordChange'])->name('password.change');
    Route::post('image/change', [UserController::Class, 'imageChange'])->name('image.change');
    
    //Order
    Route::get('order-view/{id}', [UserController::Class, 'orderView']);
    Route::get('invoice-download/{id}', [UserController::Class, 'invoiceDownload']);
    Route::post('return-order', [UserController::Class, 'returnOrder'])->name('user-return-order');
    Route::get('/review-create/{product_id}/{order_id}', [UserController::Class, 'createReview']);
    Route::post('/review-store', [UserController::Class, 'storeReview'])->name('store.review');
    
   //Wishlist 
    Route::get('wishlists', [WishlistController::Class, 'showWishlistPage'])->name('wishlistPage');
    Route::get('/wishlists/view/ajax', [WishlistController::Class, 'wishlistsViewAjax']);
    Route::get('/wishlist/product/remove/{id}', [WishlistController::Class, 'destroy']);
    
    //Checkout
    Route::get('/checkout', [CheckoutController::Class, 'index'])->name('checkout');
    Route::get('/district/ajax/{division_id}', [CheckoutController::Class, 'getDistrict']);
    Route::get('/state/ajax/{district_id}', [CheckoutController::Class, 'getState']);
    Route::post('/payment', [CheckoutController::Class, 'storeCheckout'])->name('checkout.store');
    Route::post('/stripe/payment', [CheckoutController::Class, 'stripePayment'])->name('stripe.payment');

    //Chat with Support
    Route::post('/message-send',[ChatController::class,'sendMessage']);
    Route::get('/user-messages',[ChatController::class,'userMessages']);
    
});



//============================= SslCommerz Payment Gateway ============================================//
Route::group([ 'middleware' => ['user', 'auth'] ], function () {    
// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);
Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);
Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END
});
 


//============================= LARAVEL SOCIALITE Login ==============================================//
//Login with Google
Route::get('login/google', [LoginController::Class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [LoginController::Class, 'handleGoogleCallback']);

//Login with Facebook
Route::get('login/facebook', [LoginController::Class, 'redirectToFacebook'])->name('login.facebook');
Route::get('login/facebook/callback', [LoginController::Class, 'handleFacebookCallback']);



//============================= Frontend Routes =======================================================//
//For Language
Route::get('language/bangla', [LanguageController::Class, 'bangla'])->name('bangla.language');
Route::get('language/english', [LanguageController::Class, 'english'])->name('english.language');

//Product Details
Route::get('products/{slug}', [IndexController::Class, 'singleProductShow']);

//Tag Wise Product
Route::get('products/tag/{tag}', [IndexController::Class, 'tagWiseProduct']);

//Category Wise Product
Route::get('products/category/{slug}', [IndexController::Class, 'catWiseProduct']);

//SUbCategory Wise Product
Route::get('products/subcategory/{slug}', [IndexController::Class, 'subCatWiseProduct']);

//SUb-SubCategory Wise Product
Route::get('products/sub-subcategory/{slug}', [IndexController::Class, 'subSubcatWiseProduct']);

//Brand Wise Product
Route::get('products/brand/{slug}', [IndexController::Class, 'brandWiseProduct']);

//Color Wise Product
Route::get('products/color/{color}', [IndexController::Class, 'colorWiseProduct']);

//Product View With Ajax
Route::get('product/view/modal/{id}', [IndexController::Class, 'productViewAjax']);

//Wishlist 
Route::post('/wishlist/data/store/{id}', [WishlistController::Class, 'addToWishlist']);

//Shopping Cart
Route::post('/cart/data/store/{id}', [CartController::Class, 'addToCart']);
Route::get('/product/mini/cart', [CartController::Class, 'miniCart']);
Route::get('carts', [CartController::Class, 'showCartPage'])->name('cartPage');
Route::get('/carts/view/ajax', [CartController::Class, 'cartsViewAjax']);
Route::get('cart/product/remove/{rowId}', [CartController::Class, 'destroy']);
Route::get('/cart/product/increment/{rowId}', [CartController::Class, 'cartQtyIncrement']);
Route::get('/cart/product/decrement/{rowId}', [CartController::Class, 'cartQtyDecrement']);

//Coupon
Route::post('/coupon-apply', [CartController::Class, 'couponApply']);
Route::get('/coupon-Data-Show', [CartController::Class, 'couponDataShow']);
Route::get('/coupon-remove', [CartController::Class, 'couponRemove']);

//Order Tracking
Route::post('order-track', [TrackingController::Class, 'orderTrack'])->name('order.track');

//search product
Route::get('/search-products',[SearchController::class,'searchProduct'])->name('search.product');
Route::post('/search-products-ajax',[SearchController::class,'searchProductsAjax']);

//Shop Page
Route::get('/shop',[ShopController::class,'shopPage'])->name('shop');
Route::post('/shop-by',[ShopController::class,'shopByFilter'])->name('shop.filter');

//Privacy Policy
Route::get('/privacy-policy',[IndexController::class,'privacyPolicy']);
Route::get('/terms-of-use',[IndexController::class,'termsOfUse']);