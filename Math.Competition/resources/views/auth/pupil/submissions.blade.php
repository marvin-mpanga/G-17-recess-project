@extends('layouts.app', ['activePage' => 'submissions', 'title' => 'Submissions', 'navName' => 'Submissions', 'activeButton' => 'pupilDashboard'])
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">{{ __('Submissions') }}</h4>
                    </div>
                    <div class="card-body">
                        <p>Total Challenges Submitted: {{ $submissionsCount }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
