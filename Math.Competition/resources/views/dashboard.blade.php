@extends('layouts.app', ['activePage' => 'dashboard', 'title' => 'maths competition', 'navName' => 'Dashboard', 'activeButton' => 'laravel'])

@section('content')
    <div class="content">
        <div class="container-fluid">
        <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header ">
                <h4 class="card-title">{{ __('Welcome') }}</h4>
                <p class="card-category">{{ __('Quick overview of challenges completed and current progress level') }}</p>
            </div>
            <div class="card-body ">
                <div class="table-full-width">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>{{ __('Challenges Completed') }}</td>
                                <td>15</td>
                            </tr>
                            <tr>
                                <td>{{ __('Current Progress Level') }}</td>
                                <td>Intermediate</td>
                            </tr>
                            <tr>
                                <td>{{ __('Total Points') }}</td>
                                <td>1250</td>
                            </tr>
                            <tr>
                                <td>{{ __('Rank') }}</td>
                                <td>7</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <hr>
                <h5>{{ __('Recent Achievements') }}</h5>
                <ul>
                    <li>{{ __('Completed Algebra Challenge with 85% score') }}</li>
                    <li>{{ __('Achieved "Math Genius" badge') }}</li>
                    <li>{{ __('Ranked up to Intermediate level') }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection