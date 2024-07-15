@extends('layouts.app', ['activePage' => 'icons', 'title' => 'National Mathematics Competition', 'navName' => 'Challenges', 'activeButton' => 'laravel'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                  
                    <div class="card-header ">
                        <h4 class="card-title">{{ __('Challenges') }}</h4>
                        <p class="card-category">{{ __('List of available challenges with brief score descriptions') }}</p>
                    </div>
                    <div class="card-body ">
                        <div class="table-full-width">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>{{ __('Challenge') }}</th>
                                        <th>{{ __('Score') }}</th>
                                        <th>{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ __('Challenge 1: Algebra') }}</td>
                                        <td>85%</                                        </td>
                                        <td>
                                            <button class="btn btn-success">{{ __('Start') }}</button>
                                            <button class="btn btn-warning">{{ __('Continue') }}</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('Challenge 2: Geometry') }}</td>
                                        <td>90%</                                        </td>
                                        <td>
                                            <button class="btn btn-success">{{ __('Start') }}</button>
                                            <button class="btn btn-warning">{{ __('Continue') }}</button>
                                        </td>
                                    </tr>
                                    <!-- Add more challenges as needed -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
