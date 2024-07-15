@extends('layouts.app', ['activePage' => 'school-rep-communications', 'title' => 'Communications', 'navName' => 'Communications', 'activeButton' => 'schoolRepDashboard'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 ml-auto mr-auto">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('Communications') }}</h4>
                        <p class="card-category">{{ __('Send messages to pupils') }}</p>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('school-rep/communications') }}">
                            @csrf
                            <div class="form-group">
                                <label for="pupil_id">{{ __('Select Pupil') }}</label>
                                <select name="pupil_id" class="form-control" required>
                                    @foreach($pupils as $pupil)
                                    <option value="{{ $pupil->id }}">{{ $pupil->name }} ({{ $pupil->registration_number }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="message">{{ __('Message') }}</label>
                                <textarea name="message" class="form-control" rows="4" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">{{ __('Send Message') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
