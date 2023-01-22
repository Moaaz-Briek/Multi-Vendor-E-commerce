<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a @if(Session::get('page') === 'dashboard') style="background: #4b49ac !important;color: #fff!important;" @endif
                class="nav-link" href="{{url('admin/dashboard')}}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        @if(auth()->guard('admin')->user()->type == 'vendor')
        <!-- Vendor Tabs -->
        <li class="nav-item">
            <a @if(in_array(Session::get('page'), array('personal','business', 'bank')))
                   style="background: #4b49ac !important;color: #fff!important;"
               @endif
                class="nav-link" data-toggle="collapse" href="#ui-vendors" aria-expanded="false" aria-controls="ui-vendors">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Vendor Details</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-vendors">
                <ul class="nav flex-column sub-menu" style="background: #fff !important;color: #4b49ac!important;">
                    <li class="nav-item"> <a @if(Session::get('page') === 'personal')
                                                 style="background: #4b49ac !important;color: #fff!important;"
                                             @else
                                                 style="background: #fff !important;color: #4b49ac!important;"
                                             @endif
                            class="nav-link" href="{{url('admin/update-vendor-details/personal')}}">Personal Details</a></li>
                    <li class="nav-item"> <a @if(Session::get('page') === 'business')
                                                 style="background: #4b49ac !important;color: #fff!important;"
                                             @else
                                                 style="background: #fff !important;color: #4b49ac!important;"
                                             @endif
                             class="nav-link" href="{{url('admin/update-vendor-details/business')}}">Business Details</a></li>
                    <li class="nav-item"> <a @if(Session::get('page') === 'bank')
                                                 style="background: #4b49ac !important;color: #fff!important;"
                                             @else
                                                 style="background: #fff !important;color: #4b49ac!important;"
                                             @endif
                            class="nav-link" href="{{url('admin/update-vendor-details/bank')}}">Bank Details</a></li>
                </ul>
            </div>
        </li>
        @else
        <!-- Admin settings Tabs -->
        <li class="nav-item">
            <a @if(in_array(Session::get('page'), array('updateAdminDetails','updateAdminPassword')))  style="background: #4b49ac !important;color: #fff!important;" @endif
                class="nav-link" data-toggle="collapse" href="#ui_admins" aria-expanded="false" aria-controls="ui_admins">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Settings</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui_admins">
                <ul class="nav flex-column sub-menu" style="background: #fff !important;color: #4b49ac !important;">
                    <li class="nav-item"> <a @if(Session::get('page') === 'updateAdminPassword')
                                                 style="background: #4b49ac !important;color: #fff!important;"
                                             @else
                                                 style="background: #fff !important;color: #4b49ac!important;"
                                             @endif
                            class="nav-link" href="{{url('admin/update-admin-password')}}">Update Password</a></li>

                    <li class="nav-item"> <a @if(Session::get('page') === 'updateAdminDetails')
                                                 style="background: #4b49ac !important;color: #fff!important;"
                                             @else
                                                 style="background: #fff !important;color: #4b49ac!important;"
                                             @endif
                            class="nav-link" href="{{url('admin/update-admin-details')}}">Update Details</a></li>
                </ul>
            </div>
        </li>
        <!-- Admin Management Tabs -->
        <li class="nav-item">
            <a @if(in_array(Session::get('page'), array('view_admins','view_sub-admins', 'view_vendors' , 'view_all')))
                   style="background: #4b49ac !important;color: #fff!important;"
               @endif
                class="nav-link" data-toggle="collapse" href="#ui-admins" aria-expanded="false" aria-controls="ui-admins">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Admin Management</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-admins">
                <ul class="nav flex-column sub-menu" style="background: #fff !important;color: #4b49ac !important;">
                    <li class="nav-item"> <a @if(Session::get('page') === 'view_admins')
                                                 style="background: #4b49ac !important;color: #fff!important;"
                                             @else
                                                 style="background: #fff !important;color: #4b49ac!important;"
                                             @endif
                            class="nav-link" href="{{url('admin/admins/Admin')}}">Admins</a></li>
                    <li class="nav-item"> <a @if(Session::get('page') === 'view_subadmins')
                                                 style="background: #4b49ac !important;color: #fff!important;"
                                             @else
                                                 style="background: #fff !important;color: #4b49ac!important;"
                                             @endif
                            class="nav-link" href="{{url('admin/admins/subadmin')}}">Sub-Admins</a></li>

                    <li class="nav-item"> <a @if(Session::get('page') === 'view_vendors')
                                                 style="background: #4b49ac !important;color: #fff!important;"
                                             @else
                                                 style="background: #fff !important;color: #4b49ac!important;"
                                             @endif
                            class="nav-link" href="{{url('admin/admins/vendor')}}">Vendors</a></li>
                    <li class="nav-item"> <a @if(Session::get('page') === 'view_all')
                                                 style="background: #4b49ac !important;color: #fff!important;"
                                             @else
                                                 style="background: #fff !important;color: #4b49ac!important;"
                                             @endif
                            class="nav-link" href="{{url('admin/admins/')}}">All</a></li>
                </ul>
            </div>
        </li>
        <!-- Users Tabs -->
        <li class="nav-item">
            <a @if(in_array(Session::get('page'), array('users','subscriber')))
                   style="background: #4b49ac !important;color: #fff!important;"
               @endif
                class="nav-link" data-toggle="collapse" href="#ui-user" aria-expanded="false" aria-controls="ui-user">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Users Management</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-user">
                <ul class="nav flex-column sub-menu" style="background: #fff !important;color: #4b49ac !important;">
                    <li class="nav-item"> <a @if(Session::get('page') === 'users')
                                                 style="background: #4b49ac !important;color: #fff!important;"
                                             @else
                                                 style="background: #fff !important;color: #4b49ac!important;"
                                             @endif
                            class="nav-link" href="{{url('admin/users')}}">Users</a></li>
                    <li class="nav-item"> <a @if(Session::get('page') === 'subscriber')
                                                 style="background: #4b49ac !important;color: #fff!important;"
                                             @else
                                                 style="background: #fff !important;color: #4b49ac!important;"
                                             @endif
                            class="nav-link" href="{{url('admin/subscriber')}}">Subscribers</a></li>
                </ul>
            </div>
        </li>
        <!-- Catalogue Tabs -->
        <li class="nav-item">
                <a @if(in_array(Session::get('page'), array('sections','products', 'brands', 'categories')))
                       style="background: #4b49ac !important;color: #fff!important;"
                   @endif
                    class="nav-link" data-toggle="collapse" href="#ui-catalogue" aria-expanded="false" aria-controls="ui-catalogue">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">Catalogue Management</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-catalogue">
                    <ul class="nav flex-column sub-menu" style="background: #fff !important;color: #4b49ac !important;">
                        <li class="nav-item"> <a @if(Session::get('page') === 'sections')
                                                     style="background: #4b49ac !important;color: #fff!important;"
                                                 @else
                                                     style="background: #fff !important;color: #4b49ac!important;"
                                                 @endif
                                class="nav-link" href="{{url('admin/sections')}}">Sections</a></li>
                        <li class="nav-item"> <a @if(Session::get('page') === 'categories')
                                                     style="background: #4b49ac !important;color: #fff!important;"
                                                 @else
                                                     style="background: #fff !important;color: #4b49ac!important;"
                                                 @endif
                                class="nav-link" href="{{url('admin/categories')}}">Categories</a></li>
                        <li class="nav-item"> <a @if(Session::get('page') === 'brands')
                                                     style="background: #4b49ac !important;color: #fff!important;"
                                                 @else
                                                     style="background: #fff !important;color: #4b49ac!important;"
                                                 @endif
                                                 class="nav-link" href="{{url('admin/brands')}}">Brands</a></li>
                        <li class="nav-item"> <a @if(Session::get('page') === 'products')
                                                     style="background: #4b49ac !important;color: #fff!important;"
                                                 @else
                                                     style="background: #fff !important;color: #4b49ac!important;"
                                                 @endif
                                class="nav-link" href="{{url('admin/products')}}">Products</a></li>
                    </ul>
                </div>
            </li>
        @endif
    </ul>
</nav>
<!-- partial -->
