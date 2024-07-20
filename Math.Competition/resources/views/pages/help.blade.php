@extends('layouts.app', ['activePage' => 'help', 'title' => 'Help/Support'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">{{ __('Help/Support') }}</h4>
                    </div>
                    <div class="card-body">
                        <p>Help and support content goes here.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
