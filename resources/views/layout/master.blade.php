@php 
$settings = \App\Models\Setting::first(); 

@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('custom/logos/7395804.png') }}" type="image/ico" />

    <title>Isbah Polti Firm | Admin Dashboard</title>

    <!-- Bootstrap -->
    <link href="{{ asset('asset/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('asset/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('asset/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ asset('asset/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">

    {{-- Fort Awesome CDN Link Here --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <!-- bootstrap-progressbar -->
    <link href="{{ asset('asset/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}"
        rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{ asset('asset/vendors/jqvmap/dist/jqvmap.min.css') }}" rel="stylesheet" />
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('asset/vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">

    {{-- <link href="{{ asset('asset/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet"> --}}

    <!-- Custom Theme Style -->
    <link href="{{ asset('asset/build/css/custom.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('custom/css/style.css') }}">
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="{{ route('dashboard') }}" class="site_title"> 
                            <img style="width: 30px; height:30px; border-radius:50%;"
                                src="{{ asset("custom/logos/")."/".$settings->project_logo }}" alt="">
                            <span> {{ $settings->project_name }} </span></a>
                    </div>
                    

                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <img src="{{ asset('custom/logos/Untitled.png') }}" alt="..."
                                class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2>{{ auth()->user()->name }}</h2>
                        </div>
                    </div>
                    <!-- /menu profile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <h3>General</h3>
                            <ul class="nav side-menu">
                                <li><a><i class="fa fa-home"></i> হোম <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ route('dashboard') }}">ড্যাশবোর্ড</a></li>
                                        <li><a href="{{ route('branch.create') }}">ব্রাঞ্চ</a></li>
                                        <li><a href="{{ route('branch.list') }}">ব্রাঞ্চ তালিকা</a></li>
                                        <li><a href="{{ route('role.create') }}">রোল</a></li>
                                        <li><a href="{{ route('role.list') }}">রোল তালিকা</a></li>
                                    </ul>
                                </li>

                                {{-- Shed List --}}
                                <li><a><i class="fa-solid fa-warehouse"></i> শেড বিবরণী <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ route('shed.list') }}">শেড তালিকা</a></li>
                                        <li><a href="{{ route('shed.list') }}">শেড রিপোর্ট</a></li>
                                    </ul>
                                </li>
                                {{-- Shed List --}}

                                
                                {{-- Category Menu List --}}
                                <li>
                                    <a>
                                        <i style="margin-right:8px; font-size: 1.2rem;" class="fa-solid fa-list"></i>
                                        পোল্টির ধরন
                                        <span class="fa fa-chevron-down"></span>
                                    </a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ route('category.create') }}">পোল্টির ধরন যুক্ত</a></li>
                                        <li><a href="{{ route('category.list') }}">পোল্টির ধরন তালিকা</a></li>
                                    </ul>
                                </li>
                                {{-- Category Menu List --}}


                                {{-- Polti List --}}
                                <li>
                                    <a>
                                        <i style="margin-right:8px; font-size: 1.2rem;"
                                            class="fa-brands fa-sellcast"></i> পোল্টি ক্রয়/বিক্রয়
                                        <span class="fa fa-chevron-down"></span>
                                    </a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ route('polti.create') }}">বাচ্চা ক্রয়</a></li>
                                        <li><a href="{{ route('polti.list') }}">বাচ্চার তালিকা</a></li>
                                        <li><a href="{{ route('polti.sell') }}">পোল্টি বিক্রয়</a></li>
                                        <li><a href="{{ route('polti_sell.list') }}">পোল্টি বিক্রয় তালিকা</a></li>
                                        <li><a href="{{ route('polti_sell.collect') }}">বাকী বিক্রয়</a></li>
                                    </ul>
                                </li>                            
                                {{-- Polti List --}}

                                {{-- Buyer Menu List --}}
                                <li>
                                    <a>
                                        <i style="margin-right:8px; font-size: 1.2rem;"
                                            class="fa-solid fa-money-check"></i> ক্রেতা
                                        <span class="fa fa-chevron-down"></span>
                                    </a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ route('buyer.us') }}">ক্রেতা যুক্ত</a></li>
                                        <li><a href="{{ route('buyer.list') }}">ক্রেতা তালিকা</a></li>
                                        <li><a href="{{ route('buyer.due') }}">ক্রেতা বাকি</a></li>
                                    </ul>
                                </li>
                                {{-- Buyer Menu List --}}

                                {{-- HR Menu List --}}
                                <li><a><i style="font-size: 1.2rem; margin-right:8px;" class="fa-solid fa-user"></i>
                                    এডমিন ও স্টাফ <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{ route('user.create') }}">ব্যাবহারকারী যুক্ত</a></li>
                                    <li><a href="{{ route('user.list') }}">ব্যাবহারকারী তালিকা</a></li>
                                    <li><a href="{{ route('staff.us') }}">স্টাফ যুক্ত</a></li>
                                    <li><a href="{{ route('staff.list') }}">স্টাফ তালিকা</a></li>
                                    <li><a href="{{ route('staff.salary') }}">স্টাফ বেতন</a></li>
                                    <li><a href="{{ route('salary.list') }}">বেতন তালিকা </a></li>
                                </ul>
                                </li>
                                {{-- HR Menu List --}}

                                {{-- Firm Expance --}}
                                <li>
                                    <a><i style="margin-right:8px; font-size: 1.2rem;"
                                            class="fa-solid fa-circle-dollar-to-slot"></i>ফার্মের খরচ
                                        <span class="fa fa-chevron-down"></span>
                                    </a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ route('expense.type') }}"> খরচের ধরণ </a></li>
                                        <li><a href="{{ route('cost.list') }}">খরচের তালিকা</a></li>
                                    </ul>
                                </li>
                                {{-- Firm Expance --}}
                                

                                {{-- Monitoring --}}
                                <li>
                                    <a>
                                        <i style="margin-right:8px; font-size: 1.2rem;"
                                            class="fa-brands fa-watchman-monitoring"></i>
                                        মনিটরিং
                                        <span class="fa fa-chevron-down"></span>
                                    </a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ route('routine.monitoring') }}">রুটিন মনিটরিং</a></li>
                                        <li><a href="{{ route('vaccine.monitoring') }}">ভ্যাকসিন মনিটরিং</a></li>
                                    </ul>
                                </li>
                                {{-- Monitoring --}}

                                {{-- Invoice Menu List --}}
                                {{-- <li>
                                    <a>
                                        <i style="margin-right:8px;" class="fa-solid fa-file-invoice"></i>
                                        ইনভয়েস
                                        <span class="fa fa-chevron-down"></span>
                                    </a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ route('invoice.create') }}">নতুন ইনভয়েস</a></li>
                                        <li><a href="{{ route('beef.sell') }}"> ইনভয়েস তালিকা </a></li>
                                    </ul>
                                </li> --}}
                                {{-- Invoice Menu List --}}
                            </ul>
                        </div>

                        <div class="menu_section">
                            <h3>Live ON</h3>
                            <ul class="nav side-menu">

                                <li>
                                    <a href="{{ route('supplier.list') }}">
                                        <i style="margin-right:8px; font-size: 1.2rem;"
                                            class="fa-solid fa-people-group"></i>
                                        Supplier
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('polti.list') }}">
                                        <i style="margin-right:8px; font-size: 1.2rem;" class="fa-solid fa-list"></i>
                                        পোল্টির তালিকা
                                    </a>
                                </li>

                                {{-- Catalog Menu List --}}
                                <li>
                                    <a>
                                        <i style="margin-right:8px; font-size: 1.2rem;" class="fa-solid fa-table"></i>
                                        ক্যাটালগ
                                        <span class="fa fa-chevron-down"></span>
                                    </a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ route('food.list') }}">Food Item</a></li>
                                        <li><a href="{{ route('unit.list') }}">Food Unit</a></li>
                                        <li><a href="{{ route('vaccine.list') }}">Vaccine</a></li>
                                        <li><a href="{{ route('designation.list') }}">Designantion</a></li>
                                    </ul>
                                </li>
                                {{-- Catalog Menu List --}}

                                {{-- Report Menu List --}}
                                <li>
                                    <a>
                                        <i style="margin-right:8px; font-size: 1.2rem;" class="fa-solid fa-flag"></i>
                                        রিপোর্ট
                                        <span class="fa fa-chevron-down"></span>
                                    </a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ route('farm.expense_report') }}">Farm Expense Report</a></li>
                                        <li><a href="{{ route('employee.salary_report') }}">Employee Salary Report</a>
                                        </li>
                                    </ul>
                                </li>
                                {{-- Report Menu List --}}
                            </ul>
                        </div>

                    </div>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
                        <a data-toggle="tooltip" data-placement="top" title="Settings">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Lock">
                            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ url('logout') }}">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                    <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>
                    <nav class="nav navbar-nav">
                        <ul class=" navbar-right">
                            <li class="nav-item dropdown open" style="padding-left: 15px;">
                                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true"
                                    id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ asset('custom/logos/Untitled.png') }}"
                                        alt="">{{ auth()->user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-usermenu pull-right"
                                    aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('user.profile') }}">Profile</a>
                                    <a class="dropdown-item" href="{{ route('setting.create') }}">
                                        <span class="badge bg-red pull-right">50%</span>
                                        <span>Settings</span>
                                    </a>
                                    <a class="dropdown-item" href="{{ route('branch') }}">Switch Branch</a>
                                    <a class="dropdown-item" href="{{ url('logout') }}"><i
                                            class="fa fa-sign-out pull-right"></i> Log Out</a>
                                </div>
                            </li>

                            <li role="presentation" class="nav-item dropdown open">
                                <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1"
                                    data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-envelope-o"></i>
                                    <span class="badge bg-green">6</span>
                                </a>
                                <ul class="dropdown-menu list-unstyled msg_list" role="menu"
                                    aria-labelledby="navbarDropdown1">
                                    <li class="nav-item">
                                        <a class="dropdown-item">
                                            <span class="image"><img src="{{ asset('asset/images/img.jpg') }}"
                                                    alt="Profile Image" /></span>
                                            <span>
                                                <span>John Smith</span>
                                                <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                                Film festivals used to be do-or-die moments for movie makers. They were
                                                where...
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="dropdown-item">
                                            <span class="image"><img src="{{ asset('asset/images/img.jpg') }}"
                                                    alt="Profile Image" /></span>
                                            <span>
                                                <span>John Smith</span>
                                                <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                                Film festivals used to be do-or-die moments for movie makers. They were
                                                where...
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="dropdown-item">
                                            <span class="image"><img src="{{ asset('asset/images/img.jpg') }}"
                                                    alt="Profile Image" /></span>
                                            <span>
                                                <span>John Smith</span>
                                                <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                                Film festivals used to be do-or-die moments for movie makers. They were
                                                where...
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="dropdown-item">
                                            <span class="image"><img src="{{ asset('asset/images/img.jpg') }}"
                                                    alt="Profile Image" /></span>
                                            <span>
                                                <span>John Smith</span>
                                                <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                                Film festivals used to be do-or-die moments for movie makers. They were
                                                where...
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <div class="text-center">
                                            <a class="dropdown-item">
                                                <strong>See All Alerts</strong>
                                                <i class="fa fa-angle-right"></i>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">

                @yield('content')

            </div>
            <!-- /page content -->


            <!-- footer content -->
            <footer>
                <div class="pull-right">
                    Isbah Polti Firm- Admin Panel by <a href="#">Isbah IT</a>
                </div>
                
            </footer>
            <!-- /footer content -->
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('asset/vendors/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('asset/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('asset/vendors/fastclick/lib/fastclick.js') }}"></script>
    <!-- NProgress -->
    <script src="{{ asset('asset/vendors/nprogress/nprogress.js') }}"></script>
    <!-- Chart.js -->
    <script src="{{ asset('asset/vendors/Chart.js/dist/Chart.min.js') }}"></script>
    <!-- gauge.js -->
    <script src="{{ asset('asset/vendors/gauge.js/dist/gauge.min.js') }}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{ asset('asset/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ asset('asset/vendors/iCheck/icheck.min.js') }}"></script>
    <!-- Skycons -->
    <script src="{{ asset('asset/vendors/skycons/skycons.js') }}"></script>
    <!-- Flot -->
    <script src="{{ asset('asset/vendors/Flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('asset/vendors/Flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('asset/vendors/Flot/jquery.flot.time.js') }}"></script>
    <script src="{{ asset('asset/vendors/Flot/jquery.flot.stack.js') }}"></script>
    <script src="{{ asset('asset/vendors/Flot/jquery.flot.resize.js') }}"></script>

    <!-- Flot plugins -->
    <script src="{{ asset('asset/vendors/flot.orderbars/js/jquery.flot.orderBars.js') }}"></script>
    <script src="{{ asset('asset/vendors/flot-spline/js/jquery.flot.spline.min.js') }}"></script>
    <script src="{{ asset('asset/vendors/flot.curvedlines/curvedLines.js') }}"></script>
    <!-- DateJS -->
    <script src="{{ asset('asset/vendors/DateJS/build/date.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('asset/vendors/jqvmap/dist/jquery.vmap.js') }}"></script>
    <script src="{{ asset('asset/vendors/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('asset/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') }}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{ asset('asset/vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('asset/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

    <script src="{{ asset('asset/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js') }}"></script>
    <script src="{{ asset('asset/vendors/starrr/dist/starrr.js') }}"></script>
    <script src="{{ asset('asset/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('asset/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('asset/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('asset/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('asset/vendors/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('asset/vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('asset/vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('asset/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('asset/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('asset/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('asset/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
    <script src="{{ asset('asset/vendors/datatables.net-scroller/js/dataTables.scroller.min.js') }}"></script>
    <script src="{{ asset('asset/vendors/jszip/dist/jszip.min.js') }}"></script>
    <script src="{{ asset('asset/vendors/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('asset/vendors/pdfmake/build/vfs_fonts.js') }}"></script>
    <!-- Custom Theme Scripts -->
    <script src="{{ asset('asset/build/js/custom.min.js') }}"></script>

</body>

</html>
