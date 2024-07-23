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
<script>
    $(document).ready(function() {
        $('#schoolName').on('change', function() {
            var schoolName = $(this).val();
            $.ajax({
                type: 'GET',
                url: '/check-school-name',
                data: { schoolName: schoolName },
                success: function(data) {
                    if (data.exists) {
                        alert('School name already exists in our database.');
                    }
                }
            });
        });
        $('#representativeEmail').on('change', function() {
            var representativeEmail = $(this).val();
            $.ajax({
                type: 'GET',
                url: '/check-representative-email',
                data: { representativeEmail: representativeEmail },
                success: function(data) {
                    if (data.exists) {
                        alert('Representative email already exists in our database.');
                    }
                }
            });
        });
    });
</script>



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
