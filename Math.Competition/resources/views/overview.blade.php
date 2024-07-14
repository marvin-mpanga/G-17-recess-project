@extends('layouts.app', ['activePage' => 'overview', 'title' => 'Overview','navName' => 'overview', 'activeButton' => 'laravel'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <h2>{{ __('Admin Dashboard Overview') }}</h2>
            <!-- Add your overview content here -->
        </div>
    </div>
@endsection
