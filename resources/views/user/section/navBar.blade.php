<?php

$categoryList = getCategories() ;
$subCategoryList = getSubCategories() ;

?>
    <!-- Navbar Start -->
    <div class="container-fluid">
        <div class="row border-top px-xl-5">
            {{-- <div class="col-lg-3 d-none d-lg-block">
                <a class="d-flex align-items-center justify-content-between bg-secondary w-100 text-decoration-none" data-toggle="collapse" href="#navbar-vertical" style="height: 67px; padding: 0 30px;">
                    <h5 class="text-primary m-0"><i class="fa fa-book-open mr-2"></i>Subjects</h5>
                    <i class="fa fa-angle-down text-primary"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 9;">
                    <div class="navbar-nav w-100">
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link" data-toggle="dropdown">Web Design <i class="fa fa-angle-down float-right mt-1"></i></a>
                            <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                                <a href="" class="dropdown-item">HTML</a>
                                <a href="" class="dropdown-item">CSS</a>
                                <a href="" class="dropdown-item">jQuery</a>
                            </div>
                        </div>
                        @foreach ($subCategoryList as $item)
                            <a href="" class="nav-item nav-link">{{ $item->name }}</a>
                        @endforeach
                    </div>
                </nav>
            </div> --}}
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0"><span class="text-primary">E</span>COURSES</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav py-0">
                            <a href="{{ route('user#home') }}" class="nav-item nav-link @if( Request::route()->getName() == 'user#home' ) active @endif">Home</a>
                            <a href="{{ route('user#course#list') }}" class="nav-item nav-link @if( Request::route()->getName() == 'user#course#list' ) active @endif">Courses</a>
                            <a href="{{ route('user#blog#list') }}" class="nav-item nav-link @if( Request::route()->getName() == 'user#blog#list' ) active @endif">Blogs</a>
                            <a href="{{ route('user#cart#list') }}" class="nav-item nav-link @if( Request::route()->getName() == 'user#cart#list' ) active @endif">My Library</a>
                            <a href="contact.html" class="nav-item nav-link">Contact</a>
                        </div>
                        {{-- <a class="btn btn-primary py-2 px-4 ml-auto d-none d-lg-block" href="">Join Now</a> --}}
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle btn btn-dark py-2 px-4" data-toggle="dropdown"><img src="{{ asset( Auth::user()->profile == null ? 'MasterImage/profile.jpg' : 'ProfileImage/' . Auth::user()->profile ) }}" class="profile-thumb rounded-circle mr-3">
                                {{ Auth::user()->name == null ? Auth::user()->nickname : Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="{{ route('user#profile#page') }}" class="dropdown-item" style="font-size: 15px"><i class="fa-solid fa-circle-user mr-2 py-2"></i>Profile Setting</a>
                                @if ( Auth::user()->provider == 'simple' )
                                    <a href="{{ route('user#profile#changePassword#page') }}" class="dropdown-item" style="font-size: 15px"><i class="fa-solid fa-lock mr-2 py-2"></i>Change Password</a>
                                @else
                                    <a href="{{ route('user#profile#changePassword#page') }}" class="dropdown-item d-none" style="font-size: 15px"><i class="fa-solid fa-lock mr-2 py-2"></i>Change Password</a>
                                @endif
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <span class="dropdown-item"><i class="fa-solid fa-arrow-right-from-bracket mr-1 py-2"></i><button type="submit" class="border-0 px-1 py-2 btn text-dark" style="font-size: 15px">Logout</button></span>
                                </form>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->
