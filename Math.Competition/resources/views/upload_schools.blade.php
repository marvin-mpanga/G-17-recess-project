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
                                    <label for="repId">{{ __('Rep ID') }}</label>
                                    <input type="text" class="form-control" id="repId" name="repId" required>
                                </div>
                                <div class="form-group">
                                    <label for="schoolName">{{ __('School Name') }}</label>
                                    <input type="text" class="form-control" id="schoolName" name="schoolName" required>
                                </div>
                                <div class="form-group">
                                    <label for="schoolDistrict">{{ __('School District') }}</label>
                                    <input type="text" class="form-control" id="schoolDistrict" name="schoolDistrict" required>
                                </div>
                                <div class="form-group">
                                    <label for="schoolRegNo">{{ __('School Reg No') }}</label>
                                    <input type="text" class="form-control" id="schoolRegNo" name="schoolRegNo" required>
                                </div>
                                <div class="form-group">
                                    <label for="Name of Representative">{{ __('Name Of Representative') }}</label>
                                    <input type="text" class="form-control" id="Name Of Representative" name="Name Of Representative" required>
                                </div>
                                <div class="form-group">
                                    <label for="representativeEmail">{{ __('Representative Email') }}</label>
                                    <input type="email" class="form-control" id="representativeEmail" name="representativeEmail" required>
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
                                            <a href="{{ url('upload_schools/edit') }}" class="btn btn-sm btn-warning">Edit</a>
                                            <a href="{{ url('upload_schools/delete') }}" class="btn btn-sm btn-danger">Delete</a>
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
