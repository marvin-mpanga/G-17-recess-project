@extends('layouts.app', ['activePage' => 'school-rep-dashboard', 'title' => 'Dashboard', 'navName' => 'Dashboard'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('Dashboard') }}</h4>
                        <p class="card-category">{{ __('School Representative Overview') }}</p>
                    </div>
                    <div class="card-body">
                        <p>{{ __('Welcome to the School Representative Dashboard!') }}</p>
                        <!-- Add any additional dashboard content here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
