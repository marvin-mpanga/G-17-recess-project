*<!-- resources/views/admin/schools.blade.php -->
@extends('layouts.app', ['activePage' => 'schools', 'title' => 'Manage Schools', 'navName' => 'Manage Schools', 'activeButton' => 'laravel'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-11">
                    <div class="card">
                        <div class="card-header">
                        <h1 style="text-align: center; font-weight: bold; font-family: Arial Black;">Upload School</h1>
                            <p class="card-category">{{ __('Add, edit, or remove schools') }}</p>
                        </div>
                        <div class="card-body">
                            <!-- Add School Form -->
                            <form method="POST" action="{{ route('store_schools') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="schoolName" style="color: #333; font-weight: bold; font-family: Arial Black;"> {{ __('School Name') }}</label>
                                    <input type="text" class="form-control" id="schoolName" name="schoolName" required>
                                </div>
                                <div class="form-group">
                                    <label for="schoolDistrict" style="color: #333; font-weight: bold; font-family: Arial Black;">{{ __('School District') }}</label>
                                    <input type="text" class="form-control" id="schoolDistrict" name="schoolDistrict" required>
                                </div>
                                <div class="form-group">
                                    <label for="schoolRegNo" style="color: #333; font-weight: bold; font-family: Arial Black;">{{ __('School Reg No') }}</label>
                                    <input type="text" class="form-control" id="schoolRegNo" name="schoolRegNo" required>
                                </div>
                                <div class="form-group">
                                    <label for="Name of Representative" style="color: #333; font-weight: bold; font-family: Arial Black;">{{ __('Name Of Representative') }}</label>
                                    <input type="text" class="form-control" id="Name Of Representative" name="Name Of Representative" required>
                                </div>
                                <div class="form-group">
                                    <label for="representativeEmail" style="color: #333; font-weight: bold; font-family: Arial Black;">{{ __('Representative Email') }}</label>
                                    <input type="email" class="form-control" id="representativeEmail" name="representativeEmail" required>
                                </div>
                                
                                <button type="submit" class="btn btn-primary">{{ __('Add School') }}</button>
                            </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="col-md-11">
                    <div class="card">
                        <div class="card-header">
                        <h1 style="text-align: center; font-weight: bold; font-family: Arial Black;">Register Representative</h1>

                        </div>
                        <div class="card-body">
                            <!-- Add School Form -->
                            <form method="POST" action="{{ route('store_schools') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="repId" style="color: #333; font-weight: bold; font-family: Arial Black;">{{ __('Rep ID') }}</label>
                                    <input type="text" class="form-control" id="repId" name="repId" required>
                                </div>
                                <div class="form-group">
                                    <label for="Name of Representative" style="color: #333; font-weight: bold; font-family: Arial Black;">{{ __('Name Of Representative') }}</label>
                                    <input type="text" class="form-control" id="Name Of Representative" name="Name Of Representative" required>
                                </div>
                                <div class="form-group">
                                    <label for="representativeEmail" style="color: #333; font-weight: bold; font-family: Arial Black;">{{ __('Representative Email') }}</label>
                                    <input type="email" class="form-control" id="representativeEmail" name="representativeEmail" required>
                                </div>
                                <button type="submit" class="btn btn-primary">{{ __('Register Representative') }}</button>
                            </form>
                </div>
            </div>
        </div>
        

@endsection