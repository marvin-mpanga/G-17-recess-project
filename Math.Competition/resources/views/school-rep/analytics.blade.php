@extends('layouts.app', ['activePage' => 'school-rep-analytics', 'title' => 'Analytics', 'navName' => 'Analytics', 'activeButton' => 'schoolRepDashboard'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('Analytics') }}</h4>
                        <p class="card-category">{{ __('View and analyze various metrics') }}</p>
                    </div>
                    <div class="card-body">
                        <!-- Add analytics content here -->
                        <h5>{{ __('Overall Performance') }}</h5>
                        <p>{{ __('Here you can see the overall performance of the pupils in various challenges.') }}</p>
                        <!-- Sample Data -->
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>{{ __('Metric') }}</th>
                                        <th>{{ __('Value') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ __('Total Pupils') }}</td>
                                        <td>{{ $totalPupils }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('Total Confirmed Pupils') }}</td>
                                        <td>{{ $totalConfirmedPupils }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('Average Score') }}</td>
                                        <td>{{ $averageScore }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('Top Scorer') }}</td>
                                        <td>{{ $topScorer->name }} - {{ $topScorer->score }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- Add more analytics as needed -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
