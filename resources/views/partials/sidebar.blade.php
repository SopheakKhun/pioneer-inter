@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">
            @can('user_management_access')
            <li>
                <select class="searchable-field form-control"></select>
            </li>
            @endcan
            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/') }}">
                    <i class="fa fa-wrench"></i>
                    <span class="title">@lang('global.app_dashboard')</span>
                </a>
            </li>
            @can('user_management_access')
            <li>
                <a href="{{url('admin/calendar')}}">
                  <i class="fa fa-calendar"></i>
                  <span class="title">
                    Calendar
                  </span>
                </a>
            </li>
            @endcan
            @can('internal_notification_access')
            <li>
                <a href="{{ route('admin.internal_notifications.index') }}">
                    <i class="fa fa-briefcase"></i>
                    <span>@lang('global.internal-notifications.title')</span>
                </a>
            </li>@endcan
            
            @can('profile_access')
            <li>
                <a href="{{ route('admin.profiles.index') }}">
                    <i class="fa fa-user"></i>
                    <span>@lang('global.profile.title')</span>
                </a>
            </li>@endcan
            
            @can('product_access')
            <li>
                <a href="{{ route('admin.products.index') }}">
                    <i class="fa fa-product-hunt"></i>
                    <span>@lang('global.product.title')</span>
                </a>
            </li>@endcan
            
            @can('warranty_access')
            <li>
                <a href="{{ route('admin.warranties.index') }}">
                    <i class="fa fa-book"></i>
                    <span>@lang('global.warranty.title')</span>
                </a>
            </li>@endcan
            
            @can('requesting_access')
            <li>
                <a href="{{ route('admin.requestings.index') }}">
                    <i class="fa fa-paperclip"></i>
                    <span>@lang('global.requesting.title')</span>
                </a>
            </li>@endcan
            
            @can('booking_access')
            <li>
                <a href="{{ route('admin.bookings.index') }}">
                    <i class="fa fa-calendar-plus-o"></i>
                    <span>@lang('global.booking.title')</span>
                </a>
            </li>@endcan
            
            @can('jobsheet_access')
            <li>
                <a href="{{ route('admin.jobsheets.index') }}">
                    <i class="fa fa-file-text"></i>
                    <span>@lang('global.jobsheet.title')</span>
                </a>
            </li>@endcan

            @can('user_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>@lang('global.user-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('permission_access')
                    <li>
                        <a href="{{ route('admin.permissions.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span>@lang('global.permissions.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('role_access')
                    <li>
                        <a href="{{ route('admin.roles.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span>@lang('global.roles.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('user_access')
                    <li>
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-user"></i>
                            <span>@lang('global.users.title')</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>@endcan
            

            

            



            <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('auth.change_password') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">@lang('global.app_change_password')</span>
                </a>
            </li>

            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">@lang('global.app_logout')</span>
                </a>
            </li>
        </ul>
    </section>
</aside>

