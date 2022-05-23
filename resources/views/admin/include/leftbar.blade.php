<div class="sl-sideleft">
    
    <div class="sl-sideleft-menu">

        <div class="sl-menu-item">
            <span class="menu-item-label text-success">Welcome to Dashboard</span>
        </div>

        <a href="{{ url('/admin/dashboard') }}" class="sl-menu-link @yield('dashboard')">
            <div class="sl-menu-item">
                <i class="menu-item-icon fa fa-tachometer tx-22"></i>
                <span class="menu-item-label">Dashboard</span>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->

    @if(auth()->user()->role->id != 1)
    @isset(auth()->user()->role->permission['permission']['brand']['view'] )
        <a href="{{route('brands')}}" class="sl-menu-link @yield('brands')">
            <div class="sl-menu-item">
                <i class="menu-item-icon fa fa-diamond tx-20"></i>
                <span class="menu-item-label">Brands</span>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
    @endisset  
    @else
        <a href="{{route('brands')}}" class="sl-menu-link @yield('brands')">
            <div class="sl-menu-item">
                <i class="menu-item-icon fa fa-diamond tx-20"></i>
                <span class="menu-item-label">Brands</span>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
    @endif
    
    @isset(auth()->user()->role->permission['permission']['cat']['view'] )
        <a href="#" class="sl-menu-link @yield('category')">
            <div class="sl-menu-item">
                <i class="menu-item-icon fa fa-server tx-20"></i>
                <span class="menu-item-label">Category</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{route('category')}}" class="nav-link @yield('category-page')">Category Page</a></li>
            @isset(auth()->user()->role->permission['permission']['subcat']['view'] )
            <li class="nav-item"><a href="{{route('subcategory')}}" class="nav-link @yield('subcategory')">Subcategory</a></li>
            @endisset
            @isset(auth()->user()->role->permission['permission']['subsubcat']['view'] )
            <li class="nav-item"><a href="{{route('sub-subcategory')}}" class="nav-link @yield('sub-subcategory')">Sub-subCategory</a></li>
            @endisset
        </ul>
    @endisset    
        
    @isset(auth()->user()->role->permission['permission']['product']['view'] )    
        <a href="#" class="sl-menu-link @yield('product')">
            <div class="sl-menu-item">
                <i class="menu-item-icon fa fa-laptop tx-20"></i>
                <span class="menu-item-label">Product</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
            @isset(auth()->user()->role->permission['permission']['product']['list'] ) 
            <li class="nav-item"><a href="{{route('product.manage')}}" class="nav-link @yield('manage-product')">Manage Product</a></li>
            @endisset
            @isset(auth()->user()->role->permission['permission']['product']['add'] ) 
            <li class="nav-item"><a href="{{route('product.add')}}" class="nav-link @yield('add-product')">Add Product</a></li> 
            @endisset
        </ul>
    @endisset    
    
    @isset(auth()->user()->role->permission['permission']['slider']['view'] ) 
        <a href="{{route('sliders')}}" class="sl-menu-link @yield('sliders')">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i>
                <span class="menu-item-label">Sliders</span>
            </div>
        </a>
    @endisset 
    
    @isset(auth()->user()->role->permission['permission']['coupon']['view'] )
        <a href="{{route('coupons')}}" class="sl-menu-link @yield('coupons')">
            <div class="sl-menu-item">
                <i class="menu-item-icon fa fa-ticket tx-20"></i>
                <span class="menu-item-label">Coupons</span>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
    @endisset
 
    @isset(auth()->user()->role->permission['permission']['shipping']['view'] )
        <a href="#" class="sl-menu-link @yield('shipping')">
            <div class="sl-menu-item">
                <i class="menu-item-icon fa fa-globe tx-20"></i>
                <span class="menu-item-label">Shipping Area</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{route('division')}}" class="nav-link @yield('division')">Division</a></li>
            <li class="nav-item"><a href="{{route('district')}}" class="nav-link @yield('district')">District</a></li>
            <li class="nav-item"><a href="{{route('state')}}" class="nav-link @yield('state')">state</a></li>
        </ul>
    @endisset
    
    @isset(auth()->user()->role->permission['permission']['order']['view'] )
        <a href="#" class="sl-menu-link @yield('orders')">
            <div class="sl-menu-item">
                <i class="menu-item-icon fa fa-shopping-cart tx-20"></i>
                <span class="menu-item-label">Orders</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{route('pending-orders')}}" class="nav-link @yield('pending-orders')">Pending</a></li>
            <li class="nav-item"><a href="{{route('confirmed-orders')}}" class="nav-link @yield('confirmed-orders')">Confirmed</a></li>
            <li class="nav-item"><a href="{{route('processing-orders')}}" class="nav-link @yield('processing-orders')">Processing</a></li>
            <li class="nav-item"><a href="{{route('picked-orders')}}" class="nav-link @yield('picked-orders')">Picked</a></li>
            <li class="nav-item"><a href="{{route('shipped-orders')}}" class="nav-link @yield('shipped-orders')">Shipped</a></li>
            <li class="nav-item"><a href="{{route('delivered-orders')}}" class="nav-link @yield('delivered-orders')">Delivered</a></li>
            <li class="nav-item"><a href="{{route('cancel-orders')}}" class="nav-link @yield('cancel-orders')">Cancel</a></li>
        </ul>
    @endisset   
    
    @isset(auth()->user()->role->permission['permission']['report']['view'] )
        <a href="{{route('reports')}}" class="sl-menu-link @yield('reports')">
            <div class="sl-menu-item">
                <i class="menu-item-icon fa fa-address-book-o tx-20"></i>
                <span class="menu-item-label">Reports</span>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
    @endisset    
    
    @isset(auth()->user()->role->permission['permission']['review']['view'] )
        <a href="#" class="sl-menu-link @yield('reviews')">
            <div class="sl-menu-item">
                <i class="menu-item-icon fa fa-comment-o tx-20"></i>
                <span class="menu-item-label">Reviews</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{route('pending-reviews')}}" class="nav-link @yield('pending-reviews')">Pending</a></li>
            <li class="nav-item"><a href="{{route('approved-reviews')}}" class="nav-link @yield('approved-reviews')">Approved</a></li>
        </ul>
    @endisset    
        
    @isset(auth()->user()->role->permission['permission']['stock']['view'] )
        <a href="{{route('product-stock')}}" class="sl-menu-link @yield('stock')">
            <div class="sl-menu-item">
                <i class="menu-item-icon fa fa-database tx-20"></i>
                <span class="menu-item-label">Stock Manage</span>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
    @endisset    

    @isset(auth()->user()->role->permission['permission']['chat']['view'] )
    <a href="{{route('admin-chat')}}" class="sl-menu-link @yield('chats')">
        <div class="sl-menu-item">
            <i class="menu-item-icon fa fa-commenting-o tx-20"></i>
            <span class="menu-item-label">Chats</span>
        </div><!-- menu-item -->
    </a><!-- sl-menu-link -->
    @endisset  

    @if(auth()->user()->role->id != 1)
    @isset(auth()->user()->role->permission['permission']['role']['view'] )
        <a href="#" class="sl-menu-link @yield('roles')">
            <div class="sl-menu-item">
                <i class="menu-item-icon fa fa-globe tx-20"></i>
                <span class="menu-item-label">Role Management</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
                <li class="nav-item"><a href="{{route('role.index')}}" class="nav-link @yield('role.index')">Manage Role</a></li>
            @isset(auth()->user()->role->permission['permission']['role']['add'] )
                <li class="nav-item"><a href="{{route('role.create')}}" class="nav-link @yield('role.create')">Add Role</a></li>
            @endisset
        </ul>
    @endisset
    @else
        <a href="#" class="sl-menu-link @yield('roles')">
            <div class="sl-menu-item">
                <i class="menu-item-icon fa fa-globe tx-20"></i>
                <span class="menu-item-label">Role Management</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{route('role.index')}}" class="nav-link @yield('role.index')">Manage Role</a></li>
            <li class="nav-item"><a href="{{route('role.create')}}" class="nav-link @yield('role.create')">Add Role</a></li>
        </ul>
    @endif
 
    @if(auth()->user()->role->id != 1)
    @isset(auth()->user()->role->permission['permission']['permission']['view'] )     
        <a href="#" class="sl-menu-link @yield('permissions')">
            <div class="sl-menu-item">
                <i class="menu-item-icon fa fa-globe tx-20"></i>
                <span class="menu-item-label">Permissions</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
                <li class="nav-item"><a href="{{route('permission.index')}}" class="nav-link @yield('permission.index')">Manage Permission</a></li>
            @isset(auth()->user()->role->permission['permission']['permission']['add'] ) 
                <li class="nav-item"><a href="{{route('permission.create')}}" class="nav-link @yield('permission.create')">Add Permission</a></li>
            @endisset
        </ul>
    @endisset
    @else
        <a href="#" class="sl-menu-link @yield('permissions')">
            <div class="sl-menu-item">
                <i class="menu-item-icon fa fa-globe tx-20"></i>
                <span class="menu-item-label">Permissions</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
                <li class="nav-item"><a href="{{route('permission.index')}}" class="nav-link @yield('permission.index')">Manage Permission</a></li>
                <li class="nav-item"><a href="{{route('permission.create')}}" class="nav-link @yield('permission.create')">Add Permission</a></li>
        </ul>
    @endif
     
    @isset(auth()->user()->role->permission['permission']['subadmin']['view'] )
        <a href="#" class="sl-menu-link @yield('subadmins')">
            <div class="sl-menu-item">
                <i class="menu-item-icon fa fa-globe tx-20"></i>
                <span class="menu-item-label">Sub-admins</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
                <li class="nav-item"><a href="{{route('subadmin.index')}}" class="nav-link @yield('subadmin.index')">Manage Subadmin</a></li>
            @isset(auth()->user()->role->permission['permission']['subadmin']['add'] )
                <li class="nav-item"><a href="{{route('subadmin.create')}}" class="nav-link @yield('subadmin.create')">Add Subadmin</a></li>
            @endisset
        </ul>
    @endisset
    

    @isset(auth()->user()->role->permission['permission']['settings']['view'] )
        <a href="{{route('settings')}}" class="sl-menu-link @yield('settings')">
            <div class="sl-menu-item">
                <i class="menu-item-icon fa fa-cogs tx-20"></i>
                <span class="menu-item-label">Settings</span>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
    @endisset  
        
 
    </div><!-- sl-sideleft-menu -->
    <br>
</div><!-- sl-sideleft -->


