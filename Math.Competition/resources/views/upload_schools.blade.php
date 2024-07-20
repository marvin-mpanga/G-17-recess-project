<!-- resources/views/admin/schools.blade.php -->
@extends('layouts.app', ['activePage' => 'schools', 'title' => 'Manage Schools', 'navName' => 'Manage Schools', 'activeButton' => 'laravel'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('Manage Schools') }}</h4>
                            <p class="card-category">{{ __('Add, edit, or remove schools') }}</p>
                        </div>
                        <div class="card-body">
                            <!-- Add School Form -->
                            <form method="POST" action="{{ route('upload_schools') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="schoolName">{{ __('School Name') }}</label>
                                    <input type="text" class="form-control" id="schoolName" name="schoolName" required>
                                </div>
                                <div class="form-group">
                                    <label for="schoolAddress">{{ __('School Address') }}</label>
                                    <input type="text" class="form-control" id="schoolAddress" name="schoolAddress" required>
                                </div>
                                <button type="submit" class="btn btn-primary">{{ __('Add School') }}</button>
                            </form>

                            <!-- List of Schools -->
                            <div class="mt-4">
                                <h5>{{ __('Existing Schools') }}</h5>
                                <ul class="list-group">
                                    <!-- Example School Item -->
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Example School
                                        <span>
                                            <a href="{{ url('admin/schools/edit/1') }}" class="btn btn-sm btn-warning">Edit</a>
                                            <a href="{{ url('admin/schools/delete/1') }}" class="btn btn-sm btn-danger">Delete</a>
                                        </span>
                                    </li>
                                    <!-- Add more school items dynamically -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
