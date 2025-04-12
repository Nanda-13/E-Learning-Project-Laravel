<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>ELearning Admin Panel</title>

    <!-- Meta -->
    <meta name="description" content="Marketplace for Bootstrap Admin Dashboards" />
    <meta name="author" content="Bootstrap Gallery" />
    <link rel="canonical" href="https://www.bootstrap.gallery/">
    <meta property="og:url" content="https://www.bootstrap.gallery">
    <meta property="og:title" content="Admin Templates - Dashboard Templates | Bootstrap Gallery">
    <meta property="og:description" content="Marketplace for Bootstrap Admin Dashboards">
    <meta property="og:type" content="Website">
    <meta property="og:site_name" content="Bootstrap Gallery">
    <link rel="shortcut icon" href="{{ asset('admin/images/favicon.svg') }}" />

    <!-- *************
   ************ CSS Files *************
  ************* -->
    <link rel="stylesheet" href="{{ asset('admin/fonts/bootstrap/bootstrap-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/css/main.min.css') }}" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- *************
   ************ Vendor Css Files *************
  ************ -->

    <!-- Scrollbar CSS -->
    <link rel="stylesheet" href="{{ asset('admin/vendor/overlay-scroll/OverlayScrollbars.min.css') }}" />
</head>

<body>
    <!-- Page wrapper start -->
    <div class="page-wrapper">

        <!-- Main container start -->
        <div class="main-container">

            <!-- Sidebar wrapper start -->
            <nav id="sidebar" class="sidebar-wrapper">

                <!-- App brand starts -->
                <div class="app-brand px-3 py-3 d-flex align-items-center">
                    <a href="index.html">
                        <img src="{{ asset('admin/images/logo.svg') }}" class="logo" alt="Bootstrap Gallery" />
                    </a>
                </div>
                <!-- App brand ends -->

                <!-- Sidebar profile starts -->
                <div class="sidebar-user-profile">
                    <img src="{{ asset( Auth::user()->profile != null ? 'ProfileImage/' . Auth::user()->profile : 'MasterImage/undraw_profile.svg' ) }}"
                        class="profile-thumb rounded-circle p-2 d-lg-flex d-none" alt="Bootstrap Gallery" />
                    <h6 class="profile-name lh-lg mt-2 text-white">{{ Auth::user()->name }}</h6>
                    <ul class="profile-actions d-flex m-0 p-0">
                        <li>
                            <a href="javascript:void(0)">
                                <i class="bi bi-skype fs-4"></i>
                                <span class="count-label"></span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="bi bi-dribbble fs-4"></i>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="bi bi-twitter fs-4"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- Sidebar profile ends -->

                <!-- Sidebar menu starts -->
                <div class="sidebarMenuScroll">
                    <ul class="sidebar-menu">

                        <li class="active current-page">
                            <a href="{{ route('admin#home') }}">
                                <i class="bi bi-pie-chart"></i>
                                <span class="menu-text">Dashboard</span>
                            </a>
                        </li>
                        {{-- <li>
                            <a href="widgets.html">
                                <i class="bi bi-stickies"></i>
                                <span class="menu-text">Widgets</span>
                            </a>
                        </li> --}}
                        <li class="treeview">
                            <a href="#!">
                                <i class="bi bi-box"></i>
                                <span class="menu-text">Category</span>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="{{ route('admin#category#create#page') }}"><i class=" bi bi-plus-circle-fill me-2"></i><span style="font-size: 14px">Category Create</span></a>
                                </li>
                                <li>
                                    <a href="{{ route('admin#category#list') }}"><i class=" bi bi-list-task me-2"></i><span style="font-size: 14px">Category List</span></a>
                                </li>
                            </ul>
                        </li>

                        <li class="treeview">
                            <a href="#!">
                                <i class="bi bi-ui-checks-grid"></i>
                                <span class="menu-text">Sub Category</span>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="{{ route('admin#subCategory#create#page') }}"><i class=" bi bi-plus-circle-fill me-2"></i><span style="font-size: 14px">Sub Category Create</span></a>
                                </li>
                                <li>
                                    <a href="{{ route('admin#subCategory#list') }}"><i class=" bi bi-list-task me-2"></i><span style="font-size: 14px">Sub Category List</span></a>
                                </li>
                            </ul>
                        </li>

                        <li class="treeview">
                            <a href="#!">
                                <i class="bi bi-window-sidebar"></i>
                                <span class="menu-text">Lesson</span>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="{{ route('admin#lesson#create#page') }}"><i class=" bi bi-plus-circle-fill me-2"></i><span style="font-size: 14px">Lesson Create</span></a>
                                </li>
                                <li>
                                    <a href="{{ route('admin#lesson#list') }}"><i class=" bi bi-list-task me-2"></i><span style="font-size: 14px">Lesson List</span></a>
                                </li>

                                <li class="treeview">
                                    <a href="#!">
                                        <i class="bi bi-code-square me-1"></i>
                                        <span style="font-size: 14px">Lesson Course</span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li>
                                            <a href="{{ route('admin#lesson#course#create#page') }}"><i class=" bi bi-plus-circle-fill me-2"></i><span style="font-size: 14px">Lesson Course Create</span></a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin#lesson#course#list') }}"><i class=" bi bi-list-task me-2"></i><span style="font-size: 14px">Lesson Course List</span></a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="treeview">
                                    <a href="">
                                        <i class="bi bi-textarea me-1"></i>
                                        <span style="font-size: 14px">Lesson Blog</span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li>
                                            <a href="{{ route('admin#lesson#blog#create#page') }}"><i class=" bi bi-plus-circle-fill me-2"></i><span style="font-size: 14px">Lesson Blog Create</span></a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin#lesson#blog#list') }}"><i class=" bi bi-list-task me-2"></i><span style="font-size: 14px">Lesson Blog List</span></a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <li class="treeview">
                            <a href="#!">
                                <i class="bi bi-upc-scan"></i>
                                <span class="menu-text">Payment</span>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="{{ route('admin#payment#create#page') }}"><i class=" bi bi-plus-circle-fill me-2"></i><span style="font-size: 14px">Payment Create</span></a>
                                </li>
                                <li>
                                    <a href="{{ route('admin#payment#list') }}"><i class=" bi bi-list-task me-2"></i><span style="font-size: 14px">Payment List</span></a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="{{ route('admin#order#list') }}">
                                <i class="bi bi-clipboard2-pulse"></i>
                                <span class="menu-text">Orders</span>
                            </a>
                        </li>

                        <li>
                            <a href="tables.html">
                                <i class="bi bi-border-all"></i>
                                <span class="menu-text">Tables</span>
                            </a>
                        </li>
                        <li>
                            <a href="subscribers.html">
                                <i class="bi bi-check-circle"></i>
                                <span class="menu-text">Subscribers</span>
                            </a>
                        </li>
                        <li>
                            <a href="contacts.html">
                                <i class="bi bi-wallet2"></i>
                                <span class="menu-text">Contacts</span>
                            </a>
                        </li>
                        <li>
                            <a href="settings.html">
                                <i class="bi bi-gear"></i>
                                <span class="menu-text">Settings</span>
                            </a>
                        </li>
                        <li>
                            <a href="profile.html">
                                <i class="bi bi-person-square"></i>
                                <span class="menu-text">Profile</span>
                            </a>
                        </li>

                        <li class="treeview">
                            <a href="#!">
                                <i class="bi bi-pie-chart"></i>
                                <span class="menu-text">Graphs</span>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="apex.html">Apex</a>
                                </li>
                                <li>
                                    <a href="morris.html">Morris</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="maps.html">
                                <i class="bi bi-pin-map"></i>
                                <span class="menu-text">Maps</span>
                            </a>
                        </li>
                        <li>
                            <a href="tabs.html">
                                <i class="bi bi-slash-square"></i>
                                <span class="menu-text">Tabs</span>
                            </a>
                        </li>
                        <li>
                            <a href="modals.html">
                                <i class="bi bi-terminal"></i>
                                <span class="menu-text">Modals</span>
                            </a>
                        </li>
                        <li>
                            <a href="icons.html">
                                <i class="bi bi-textarea"></i>
                                <span class="menu-text">Icons</span>
                            </a>
                        </li>
                        <li>
                            <a href="typography.html">
                                <i class="bi bi-explicit"></i>
                                <span class="menu-text">Typography</span>
                            </a>
                        </li>

                        <li>
                            <a href="page-not-found.html">
                                <i class="bi bi-exclamation-diamond"></i>
                                <span class="menu-text">Page Not Found</span>
                            </a>
                        </li>
                        <li>
                            <a href="maintenance.html">
                                <i class="bi bi-exclamation-octagon"></i>
                                <span class="menu-text">Maintenance</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#!">
                                <i class="bi bi-code-square"></i>
                                <span class="menu-text">Multi Level</span>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="#!">Level One Link</a>
                                </li>
                                <li>
                                    <a href="#!">
                                        Level One Menu
                                        <i class="bi bi-chevron-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li>
                                            <a href="#!">Level Two Link</a>
                                        </li>
                                        <li>
                                            <a href="#!">Level Two Menu
                                                <i class="bi bi-chevron-right"></i>
                                            </a>
                                            <ul class="treeview-menu">
                                                <li>
                                                    <a href="#!">Level Three Link</a>
                                                </li>
                                                <li>
                                                    <a href="#!">Level Three Link</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#!">Level One Link</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- Sidebar menu ends -->

            </nav>
            <!-- Sidebar wrapper end -->

            <!-- App container starts -->
            <div class="app-container">

                <!-- App header starts -->
                <div class="app-header d-flex align-items-center">

                    <!-- Toggle buttons start -->
                    <div class="d-flex">
                        <button class="btn btn-outline-primary me-2 toggle-sidebar" id="toggle-sidebar">
                            <i class="bi bi-chevron-left fs-5"></i>
                        </button>
                        <button class="btn btn-outline-primary me-2 pin-sidebar" id="pin-sidebar">
                            <i class="bi bi-chevron-left fs-5"></i>
                        </button>
                    </div>
                    <!-- Toggle buttons end -->

                    <!-- App brand sm start -->
                    <div class="app-brand-sm d-md-none d-sm-block">
                        <a href="index.html">
                            <img src="{{ asset('admin') }}/images/logo-sm.svg" class="logo"
                                alt="Bootstrap Gallery">
                        </a>
                    </div>
                    <!-- App brand sm end -->

                    <!-- App header actions start -->
                    <div class="header-actions">
                        <div class="d-lg-block d-none me-2">

                            <!-- Search container start -->
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search" />
                                <button class="btn btn-outline-primary" type="button">
                                    <i class="bi bi-search fs-5"></i>
                                </button>
                            </div>
                            <!-- Search container end -->

                        </div>
                        <div class="dropdown ms-3">
                            <a class="dropdown-toggle d-flex p-2 py-3" href="#!" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-grid fs-2 lh-1"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end shadow">
                                <!-- Row start -->
                                <div class="d-flex gap-2 m-2">
                                    <a href="javascript:void(0)" class="g-col-4 p-2 border rounded-2">
                                        <img src="{{ asset('admin/images/brand-behance.svg') }}" class="img-3x"
                                            alt="Admin Themes" />
                                    </a>
                                    <a href="javascript:void(0)" class="g-col-4 p-2 border rounded-2">
                                        <img src="{{ asset('admin/images/brand-gatsby.svg') }}" class="img-3x"
                                            alt="Admin Themes" />
                                    </a>
                                    <a href="javascript:void(0)" class="g-col-4 p-2 border rounded-2">
                                        <img src="{{ asset('admin/images/brand-google.svg') }}" class="img-3x"
                                            alt="Admin Themes" />
                                    </a>
                                    <a href="javascript:void(0)" class="g-col-4 p-2 border rounded-2">
                                        <img src="{{ asset('admin/images/brand-bitcoin.svg') }}" class="img-3x"
                                            alt="Admin Themes" />
                                    </a>
                                    <a href="javascript:void(0)" class="g-col-4 p-2 border rounded-2">
                                        <img src="{{ asset('admin/images/brand-dribbble.svg') }}" class="img-3x"
                                            alt="Admin Themes" />
                                    </a>
                                </div>
                                <!-- Row end -->
                            </div>
                        </div>
                        <div class="dropdown ms-3">
                            <a class="dropdown-toggle d-flex p-2 py-3" href="#!" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-bell fs-2 lh-1"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end shadow">
                                <div class="dropdown-item">
                                    <div class="d-flex py-2 border-bottom">
                                        <img src="{{ asset('admin/images/user.png') }}" class="img-4x me-3 rounded-3"
                                            alt="Admin Theme" />
                                        <div class="m-0">
                                            <h5 class="mb-1 fw-semibold">Sophie Michiels</h5>
                                            <p class="mb-1">Membership has been ended.</p>
                                            <p class="small m-0 text-primary">Today, 07:30pm</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown-item">
                                    <div class="d-flex py-2 border-bottom">
                                        <img src="{{ asset('admin/images/user2.png') }}"
                                            class="img-4x me-3 rounded-3" alt="Admin Theme" />
                                        <div class="m-0">
                                            <h5 class="mb-1 fw-semibold">Sophie Michiels</h5>
                                            <p class="mb-1">Congratulate, James for new job.</p>
                                            <p class="small m-0 text-primary">Today, 08:00pm</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown-item">
                                    <div class="d-flex py-2">
                                        <img src="{{ asset('admin/images/user1.png') }}"
                                            class="img-4x me-3 rounded-3" alt="Admin Theme" />
                                        <div class="m-0">
                                            <h5 class="mb-1 fw-semibold">Sophie Michiels</h5>
                                            <p class="mb-2">Lewis added new schedule release.</p>
                                            <p class="small m-0 text-primary">Today, 09:30pm</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-top py-2 px-3 text-end">
                                    <a href="javascript:void(0)">View all</a>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown ms-3">
                            <a id="userSettings"
                                class="dropdown-toggle d-flex py-2 align-items-center text-decoration-none"
                                href="#!" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="d-none d-md-block me-2 text-muted">{{ Auth::user()->name }}</span>
                                <img src="{{ asset( Auth::user()->profile != null ? 'ProfileImage/' . Auth::user()->profile : 'MasterImage/undraw_profile.svg' ) }}" class="rounded-circle img-3x"
                                    alt="Bootstrap Gallery" />
                            </a>
                            <div class="dropdown-menu dropdown-menu-end shadow">
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('admin#profile#page') }}"><i
                                        class="bi bi-person fs-4 me-2"></i>Profile</a>
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('admin#profile#changePassword#page') }}"><i
                                        class="bi bi-gear fs-4 me-2"></i>Change Password</a>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <span class="dropdown-item d-flex align-items-center"><i
                                        class="bi bi-escape fs-4 me-2"></i><button type="submit" class="border-0 p-0 btn">Logout</button></span>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- App header actions end -->

                </div>
                <!-- App header ends -->

                @yield('content')
                @include('sweetalert::alert')

                <!-- App footer start -->
                <div class="app-footer">
                    <span>© Bootstrap Gallery 2024</span>
                </div>
                <!-- App footer end -->

            </div>
            <!-- App container ends -->

        </div>
        <!-- Main container end -->

    </div>
    <!-- Page wrapper end -->

    <!-- *************
   ************ JavaScript Files *************
  ************* -->
    <!-- Required jQuery first, then Bootstrap Bundle JS -->
    <script src="{{ asset('admin/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/js/bootstrap.bundle.min.js') }}"></script>

    <!-- *************
   ************ Vendor Js Files *************
  ************* -->

    <!-- Overlay Scroll JS -->
    <script src="{{ asset('admin/vendor/overlay-scroll/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/overlay-scroll/custom-scrollbar.js') }}"></script>

    <!-- Apex Charts -->
    <script src="{{ asset('admin/vendor/apex/apexcharts.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/apex/custom/dash1/sales.js') }}"></script>
    <script src="{{ asset('admin/vendor/apex/custom/dash1/sparkline.js') }}"></script>
    <script src="{{ asset('admin/vendor/apex/custom/dash1/sparkline2.js') }}"></script>

    <!-- Rating -->
    <script src="{{ asset('admin/vendor/rating/raty.js') }}"></script>
    <script src="{{ asset('admin/vendor/rating/raty-custom.js') }}"></script>

    <!-- Custom JS files -->
    <script src="{{ asset('admin/js/custom.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- Upload Video File --}}
    <script src="https://cdn.jsdelivr.net/npm/resumablejs@1.1.0/resumable.min.js"></script>

    @yield('js-content')
</body>

</html>
