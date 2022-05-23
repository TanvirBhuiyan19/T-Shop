<div class="sl-header">
            <div class="sl-header-left">
                <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a></div>
                <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>
            </div><!-- sl-header-left -->
            
            @php
            $users = App\Models\User::where('role_id','!=', 1)->latest('id')->get();
            $online_users = 0; 
            @endphp
            @foreach($users as $user)
                @php
                    if($user->userIsOnline()){
                    $online_users = $online_users+1;
                    }
                @endphp
            @endforeach
            
            @isset(auth()->user()->role->permission['permission']['alluser']['view'] )
            <a href="{{route('all-users')}}" class="text-white logged-name btn btn-outline-info btn-sm"><i class="icon ion-person"></i> All User - {{count($users)}}
            <strong class="badge badge-pill badge-success" style="padding: 5px; position: absolute; margin-top: 5px;">{{$online_users}}</strong>
            </a>
            @endisset
            
            <div class="sl-header-right">
                <nav class="nav">
                    <div class="dropdown">
                        <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
                            <span class="logged-name">{{ Auth::user()->name }}</span></span>
                        <img src="{{ asset('admin/img/admins/') }}/{{Auth::user()->image}}" alt="Admin Photo" class="wd-35 rounded-circle" style="height: 35px;" >
                        </a>
                        <div class="dropdown-menu dropdown-menu-header wd-200">
                            <ul class="list-unstyled user-profile-nav">
                                <li><a href="{{route('admin.profile')}}"><i class="icon ion-ios-person-outline"></i> My Profile</a></li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();">
                                        <i class="icon ion-power"></i>{{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div><!-- dropdown-menu -->
                    </div><!-- dropdown -->
                </nav>
                
            </div><!-- sl-header-right -->
        </div><!-- sl-header -->
        <!-- ########## END: HEAD PANEL ########## -->