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
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-user" aria-expanded="false" aria-controls="ui-user">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Users Management</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-user">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{url('admin/users')}}">Users</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('admin/subscriber')}}">Subscribers</a></li>
                </ul>
            </div>
        </li>
        @endif
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
                <i class="icon-columns menu-icon"></i>
                <span class="menu-title">Form elements</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="pages/forms/basic_elements.html">Basic Elements</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
                <i class="icon-bar-graph menu-icon"></i>
                <span class="menu-title">Charts</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="charts">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/charts/chartjs.html">ChartJs</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
                <i class="icon-grid-2 menu-icon"></i>
                <span class="menu-title">Tables</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="tables">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/tables/basic-table.html">Basic table</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
                <i class="icon-contract menu-icon"></i>
                <span class="menu-title">Icons</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="icons">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/icons/mdi.html">Mdi icons</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">User Pages</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#error" aria-expanded="false" aria-controls="error">
                <i class="icon-ban menu-icon"></i>
                <span class="menu-title">Error pages</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="error">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> 404 </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> 500 </a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pages/documentation/documentation.html">
                <i class="icon-paper menu-icon"></i>
                <span class="menu-title">Documentation</span>
            </a>
        </li>
    </ul>
</nav>
<!-- partial -->
