@extends('layouts.app', ['activePage' => 'progress', 'title' => 'National Mathematics Competition', 'navName' => 'Progress', 'activeButton' => 'pupilDashboard'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('Progress') }}</h4>
                            <p class="card-category">{{ __('Your performance over time') }}</p>
                        </div>
                        <div class="card-body">
                            <div id="chartProgress" class="ct-chart"></div>
                        </div>
                        <div class="card-footer">
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
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('Assessments') }}</h4>
                            <p class="card-category">{{ __('Details of your assessments') }}</p>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead class=" text-primary">
                                    <tr>
                                        <th>{{ __('Challenge') }}</th>
                                        <th>{{ __('Score') }}</th>
                                        <th>{{ __('Date') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($assessments as $assessment)
                                        <tr>
                                            <td>{{ $assessment->challenge->title }}</td>
                                            <td>{{ $assessment->score }}</td>
                                            <td>{{ $assessment->created_at->format('d/m/Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('Submissions') }}</h4>
                            <p class="card-category">{{ __('Details of your submissions') }}</p>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead class=" text-primary">
                                    <tr>
                                        <th>{{ __('Challenge') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Date') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($submissions as $submission)
                                        <tr>
                                            <td>{{ $submission->challenge->title }}</td>
                                            <td>{{ $submission->status }}</td>
                                            <td>{{ $submission->created_at->format('d/m/Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fetch data for the chart
            var completedChallenges = {{ $completedChallenges }};
            var pendingChallenges = {{ $pendingChallenges }};

            // Chartist configuration
            new Chartist.Line('#chartProgress', {
                labels: [@foreach($assessments as $assessment) '{{ $assessment->created_at->format('d/m/Y') }}', @endforeach],
                series: [
                    [@foreach($assessments as $assessment) {{ $assessment->score }}, @endforeach]
                ]
            }, {
                low: 0,
                showArea: true
            });
        });
    </script>
@endpush
