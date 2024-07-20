@extends('layouts.app', ['activePage' => 'admin', 'title' => 'Admin Dashboard', 'navName' => 'Admin Dashboard'])
@section('content')
    <div class="content">
        <div class="container-fluid">
        <nav class="navbar navbar-expand-lg " color-on-scroll="500">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"> {{ $navName ?? 'National Maths Competition' }} </a>
        <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar burger-lines"></span>
            <span class="navbar-toggler-bar burger-lines"></span>
            <span class="navbar-toggler-bar burger-lines"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="nav navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="#" class="nav-link" data-toggle="dropdown">
                        <i class="nc-icon nc-palette"></i>
                        <span class="d-lg-none">{{ __('Dashboard') }}</span>
                    </a>
                </li>
                <li class="dropdown nav-item">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <i class="nc-icon nc-planet"></i>
                        <span class="notification">5</span>
                        <span class="d-lg-none">{{ __('Notification') }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <a class="dropdown-item" href="#">{{ __('Notification 1') }}</a>
                        <a class="dropdown-item" href="#">{{ __('Notification 2') }}</a>
                        <a class="dropdown-item" href="#">{{ __('Notification 3') }}</a>
                        <a class="dropdown-item" href="#">{{ __('Notification 4') }}</a>
                        <a class="dropdown-item" href="#">{{ __('Another notification') }}</a>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nc-icon nc-zoom-split"></i>
                        <span class="d-lg-block">&nbsp;{{ __('Search') }}</span>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav d-flex align-items-center">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('profile.edit') }}">
                        <span class="no-icon">{{ __('My Account') }}</span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="no-icon">{{ __('menu') }}</span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('admin_profile') }}"> {{ __('admin profile') }}</a>
                        <a class="dropdown-item" href="{{ route('admin_overview') }}">{{ __('admin Overview') }}</a>
                        <a class="dropdown-item" href="{{ route('upload_questions') }}">{{ __('manage Questions') }}</a>
                        <a class="dropdown-item" href="{{ route('upload_answers') }}">{{ __('manage Answers') }}</a>
                        <a class="dropdown-item" href="{{ route('upload_schools') }}">{{ __('upload Schools') }}</a>
                        <div class="divider"></div>
                        <a class="dropdown-item" href="{{ route('upload_docs') }}">{{ __('upload docs') }}</a>
                    </div>
                </li>
                <li class="nav-item">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <a class="text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> {{ __('Log out') }} </a>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

                <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title" style="color:red"><b>{{ __('ADMIN DASHBOARD') }}</b></h4>
                            <p class="card-category">{{ __('Manage the system and view statistics') }}</p>
                        </div>
                        <div class="card-body">
                             <!-- Navigation Links -->
                              
                             <div class="row">

                            <div class="col-md-6">
                                    <a href="{{ route('admin_profile') }}" class="btn btn-primary btn-block">{{ __('Admin Profile') }}</a>
                                </div>
                                
                                <div class="col-md-6">
                                    <a href="{{ route('admin_overview') }}" class="btn btn-primary btn-block">{{ __('Admin Overview') }}</a>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('upload_schools') }}" class="btn btn-primary btn-block">{{ __('Manage Schools') }}</a>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('upload_questions') }}" class="btn btn-primary btn-block">{{ __('Manage Questions') }}</a>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('upload_answers') }}" class="btn btn-primary btn-block">{{ __('Manage Answers') }}</a>
                                </div>     
                                <div class="col-md-6">
                                    <a href="{{ route('overall_stats') }}" class="btn btn-primary btn-block">{{ __('View Statistics') }}</a>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('upload_docs') }}" class="btn btn-primary btn-block">{{ __('Upload Excel Documents') }}</a>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
    
@endsection

