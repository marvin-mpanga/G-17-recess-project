@extends('layouts.app', ['activePage' => 'submissions', 'title' => 'National Mathematics Competition', 'navName' => 'Submissions', 'activeButton' => 'laravel'])
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card  card-tasks">
                    <div class="card-header ">
                        <h4 class="card-title">{{ __('Submissions') }}</h4>
                        <p class="card-category">{{ __('Your recent submissions') }}</p>
                    </div>
                    <div class="card-body ">
                        <div class="table-full-width">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="checkbox" value="" checked>
                                                    <span class="form-check-sign"></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td>{{ __('Challenge 1: Algebra') }}</td>
                                        <td class="td-actions text-right">
                                            <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-link">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-link">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="checkbox" value="" checked>
                                                    <span class="form-check-sign"></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td>{{ __('Challenge 2: Geometry') }}</td>
                                        <td class="td-actions text-right">
                                            <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-link">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-link">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- Add more submissions as needed -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            <i class="now-ui-icons loader_refresh spin"></i> {{ __('Updated 3 minutes ago') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
