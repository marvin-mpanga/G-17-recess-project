@extends('layouts/app', ['activePage' => 'welcome', 'title' => 'Light Bootstrap Dashboard laravel by Creative Tim & UPDIVISION'])

@section('content')
    <div class="full-page section-image" data-color="black" data-image="{{asset('light-bootstrap/img/math-olympiad-2.jpg')}}">
        <div class="content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7 col-md-8">
                        <h1 class="text-white text-center">{{ __('NATIONAL MATH OLYMPIAD!') }}</h1>
                        <h2 class="text-white text-center" style="font-size: 1em;">{{ __('Join the excitement!') }}</h2>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            demo.checkFullPageBackgroundImage();

            setTimeout(function() {
                // after 1000 ms we add the class animated to the login/register card
                $('.card').removeClass('card-hidden');
            }, 700)
        });
    </script>
@endpush