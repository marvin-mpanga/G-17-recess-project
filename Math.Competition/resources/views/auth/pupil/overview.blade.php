@extends('pupil_dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard Overview') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h3>Welcome, {{ Auth::user()->name }}!</h3>
                    <p>Here's a quick overview of your recent activities and progress.</p>

                    <div class="mt-4">
                        <h4>Recent Activities</h4>
                        <ul class="list-group">
                            @forelse($activities as $activity)
                                <li class="list-group-item">
                                    <strong>{{ $activity->title }}</strong>
                                    <br>
                                    <small>{{ $activity->created_at->diffForHumans() }}</small>
                                    <p>{{ $activity->description }}</p>
                                </li>
                            @empty
                                <li class="list-group-item">No recent activities.</li>
                            @endforelse
                        </ul>
                    </div>

                    <div class="mt-4">
                        <h4>Your Progress</h4>
                        <!-- Include progress charts, stats, etc. -->
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">75%</div>
                        </div>
                        <p class="mt-2">Keep up the good work! You're doing great.</p>
                    </div>

                    <div class="mt-4">
                        <h4>Upcoming Events</h4>
                        <ul class="list-group">
                            @forelse($events as $event)
                                <li class="list-group-item">
                                    <strong>{{ $event->name }}</strong>
                                    <br>
                                    <small>{{ $event->date->format('F d, Y') }}</small>
                                    <p>{{ $event->description }}</p>
                                </li>
                            @empty
                                <li class="list-group-item">No upcoming events.</li>
                            @endforelse
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection