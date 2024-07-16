<!-- resources/views/admin/uploads.blade.php -->
@extends('layouts.app', ['activePage' => 'uploads', 'title' => 'Manage Uploads', 'navName' => 'Manage Uploads', 'activeButton' => 'laravel'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('Manage Uploads') }}</h4>
                            <p class="card-category">{{ __('Upload Excel documents') }}</p>
                        </div>
                        <div class="card-body">
                            <!-- Upload Form -->
                            <form method="POST" action="{{ route('admin.uploads') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="excel1">{{ __('Upload Excel Document 1') }}</label>
                                    <input type="file" class="form-control-file" id="excel1" name="excel1" required>
                                </div>
                                <div class="form-group">
                                    <label for="excel2">{{ __('Upload Excel Document 2') }}</label>
                                    <input type="file" class="form-control-file" id="excel2" name="excel2" required>
                                </div>
                                <button type="submit" class="btn btn-primary">{{ __('Upload') }}</button>
                            </form>

                            <!-- List of Uploaded Files -->
                            <div class="mt-4">
                                <h5>{{ __('Uploaded Files') }}</h5>
                                <ul class="list-group">
                                    <!-- Example File Item -->
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Example File 1
                                        <span>
                                            <a href="{{ url('admin/uploads/download/1') }}" class="btn btn-sm btn-info">Download</a>
                                            <a href="{{ url('admin/uploads/delete/1') }}" class="btn btn-sm btn-danger">Delete</a>
                                        </span>
                                    </li>
                                    <!-- Add more file items dynamically -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
