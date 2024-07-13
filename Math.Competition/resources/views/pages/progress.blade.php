@extends('layouts.app', ['activePage' => 'table', 'title' => 'National Mathematics Competition', 'navName' => 'Progress', 'activeButton' => 'laravel'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header ">
                        <h4 class="card-title">{{ __('Progress') }}</h4>
                        <p class="card-category">{{ __('Your performance over time') }}</p>
                    </div>
                    <div class="card-body ">
                        <div id="chartProgress" class="ct-chart"></div>
                    </div>
                    <div class="card-footer ">
                        <div class="legend">
                            <i class="fa fa-circle text-info"></i> {{ __('Completed Challenges') }}
                            <i class="fa fa-circle text-danger"></i> {{ __('Pending Challenges') }}
                        </div>
                        <hr>
                        <div class="stats">
                            <i class="fa fa-history"></i> {{ __('Updated 3 minutes ago') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
