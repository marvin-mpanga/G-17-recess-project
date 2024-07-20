@extends('layouts.app', ['activePage' => 'view Applicants', 'title' => 'Applicants', 'navName' => 'view Applicants'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('Applicants') }}</h4>
                        <p class="card-category">{{ __('View and confirm newly registered participants') }}</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Registration Number') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pupils as $pupil)
                                    <tr>
                                        <td>{{ $pupil->name }}</td>
                                        <td>{{ $pupil->registration_number }}</td>
                                        <td>{{ $pupil->confirmed ? 'Confirmed' : 'Pending' }}</td>
                                        <td>
                                            <form method="post" action="{{ route('school-rep.pupil.confirm', $pupil->id) }}">
                                                @csrf
                                                <div class="btn-group" role="group" aria-label="Confirm Actions">
                                                    <button type="submit" name="confirm" value="yes" class="btn btn-success btn-sm">{{ __('Yes') }}</button>
                                                    <button type="submit" name="confirm" value="no" class="btn btn-danger btn-sm">{{ __('No') }}</button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="pagination justify-content-center">
                            {{ $pupils->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
