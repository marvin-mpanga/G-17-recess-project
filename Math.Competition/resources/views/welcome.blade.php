@extends('layouts/app', ['activePage' => 'welcome', 'title' => 'Light Bootstrap Dashboard laravel by Creative Tim & UPDIVISION'])

@section('content')
    <div class="full-page section-image" data-color="light-blue" data-image="{{asset('light-bootstrap/img/math-olympiad-2.jpg')}}">
        <div class="content">
            <div class="container">
                <div class="row justify-content-center">
                <div class="col-lg-10 col-md-15">
                    <h1 class="text-black text-center"><b>{{ __('NATIONAL MATH OLYMPIAD!') }}</b></h1>
                    <h2 class="text-black text-center" style="font-size: 1em;">{{ __('Join the excitement!') }}</h2>
                </div>
            </div>
            <div class="row justify-content-right mt-6">
                <div class="col-lg-15" >
                    <div class="card card-info text-center">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('What is the National Math Olympiad?') }}</h4>
                        </div>
                        <div class="card-body">
                            <p>The National Math Olympiad is an annual competition that brings together the brightest minds from schools across the country. Participants engage in challenging math problems, fostering a love for mathematics and encouraging critical thinking.</p>
                             <a href="{{ route('auth.admin.login') }}" class="btn btn-primary btn-round">{{ __('Login Now') }}</a>
                        </div>
                    </div>
                    <div class="card card-warning text-center mt-4">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('Why Participate?') }}</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled">
                                <li>Develop critical thinking and problem-solving skills</li>
                                <li>Enhance your college application with a prestigious competition</li>
                                <li>Meet and network with peers who share your passion for mathematics</li>
                                <li>Win scholarships and prizes</li>
                            </ul>
                        </div>
                    </div>
                    <div class="card card-success text-center mt-4">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('Testimonials') }}</h4>
                        </div>
                        <div class="card-body">
                            <p>"Participating in the National Math Olympiad has been a life-changing experience. It has helped me improve my problem-solving skills and gain confidence." - <i>Jane Doe, Previous Participant</i></p>
                            <p>"The Olympiad is a fantastic opportunity for students to showcase their talents and meet like-minded peers." - <i>John Smith, Math Teacher</i></p>
                        </div>
                    </div>
                    <div class="card card-primary text-center mt-4">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('Get Involved') }}</h4>
                        </div>
                        <div class="card-body">
                            <p>There are many ways to get involved with the National Math Olympiad. Whether you are a student, teacher, or volunteer, we welcome your participation and support. You can help in organizing events, spreading the word, or mentoring participants.</p>
                        </div>
                    </div>
                </div>
            </div>
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