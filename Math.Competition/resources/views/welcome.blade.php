@extends('layouts/app', ['activePage' => 'welcome', 'title' => 'Light Bootstrap Dashboard laravel by Creative Tim & UPDIVISION'])

@section('content')
<div class="full-page section-image" data-color="light-blue" data-image="{{asset('light-bootstrap/img/math-olympiad-2.jpg')}}">
  <div class="content">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-10 col-md-15">
          <h1 class="text-black text-center" style="color: white;"><b>{{ __('NATIONAL MATH OLYMPIAD!') }}</b></h1>
          <h2 class="text-black text-center" style="font-size: 1em;">{{ __('Solve today, lead tomorrow') }}</h2>
        </div>
      </div>
      <div class="slider-container">
        <div class="slides">
          
          <!-- Slide 2 -->
           <div class="slide">
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
          </div>
          <!-- Slide 3 -->
           <div class="slide">
          <div class="card card-success text-center mt-4">
            <div class="card-header">
              <h4 class="card-title">{{ __('Testimonials') }}</h4>
            </div>
            <div class="card-body">
              <p style="font-size:0.5rem;" >"Participating in the National Math Olympiad has been a life-changing experience. It has helped me improve my problem-solving skills and gain confidence." - <i>Jane Doe, Previous Participant</i></p>
              <p style="font-size:0.5rem;">"The Olympiad is a fantastic opportunity for students to showcase their talents and meet like-minded peers." - <i>John Smith, Math Teacher</i></p>
            </div>
          </div>
          </div>
          <!-- Slide 4 -->
           <div class="slide">
          <div class="card card-primary text-center mt-4">
            <div class="card-header">
              <h4 class="card-title">{{ __('Get Involved') }}</h4>
            </div>
            <div class="card-body">
              <p style="font-size:0.5rem;">There are many ways to get involved with the National Math Olympiad. Whether you are a student, teacher, or volunteer, we welcome your participation and support. You can help in organizing events, spreading the word, or mentoring participants.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    demo.checkFullPageBackgroundImage();
    setTimeout(function() {
      // after 1000 ms we add the class animated to the login/register card
      $('.card').removeClass('card-hidden');
    }, 700)
  });
  setInterval(function() {
  var currentSlide = $('.slides .slide.active');
  var nextSlide = currentSlide.next();
  
  if (nextSlide.length === 0) {
    nextSlide = $('.slides .slide:first');
  }
  
  currentSlide.removeClass('active');
  nextSlide.addClass('active');
}, 5000); // Adjust the time to your liking
 // Adjust the time to your liking

</script>

<style>
    body {
        background-image: url('{{ asset('light-bootstrap/img/math-olympiad-2.jpg') }}');
  background-size: cover;
  background-position: center;
    }
  .slides {
    font-size: 0.5rem;
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: flex-end;
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    max-height: 100px;
    transition: transform 0.5s ease-in-out;
    transform: translateX(0);
        }

    .slides.active {
         transform: translateX(-20rem); /* Adjust the value to your liking */
         display: block;
        }
.slides:hover {
transform: translateX(-20rem); /* Adjust the value to your liking */
}

  .card {
    background-color: #F5F5DC;
    margin: 1rem; 
    width: 20rem;
    height: 10rem;
    display; flex;
    flex-direction: column;
    justify-content: space-between;
  }
</style>
@endsection


