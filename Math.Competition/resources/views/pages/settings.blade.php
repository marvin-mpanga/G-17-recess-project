@extends('layouts.app', ['activePage' => 'settings', 'title' => 'Settings', 'navName' => 'settings', 'activeButton' => 'lpupilDashboard'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">{{ __('Settings') }}</h4>
                    </div>
                    <div class="card-body">
                        <p>Settings page content goes here.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
