<nav class="navbar navbar-expand-lg navbar-transparent navbar-dark bg-dark navbar-absolute">
    <div class="container">
    <div class="navbar-wrapper">
  <a class="navbar-brand" href="#pablo">
  </a>
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-bar burger-lines"></span>
    <span class="navbar-toggler-bar burger-lines"></span>
    <span class="navbar-toggler-bar burger-lines"></span>
  </button>
</div>
<div class="collapse navbar-collapse justify-content-end" id="navbar">
            <ul class="navbar-nav">
            <li class="nav-item @if($activePage == 'welcome') active @endif">
                    <a href="{{ route('welcome') }}" class ="nav-link" >
                        {{ __('Home') }}
                    </a>
                </li>
<div class="collapse navbar-collapse justify-content-end" id="navbar">
            <ul class="navbar-nav">
            <li class="nav-item @if($activePage == 'welcome') active @endif">
                    <a href="{{ route('aboutUs') }}" class ="nav-link" >
                        {{ __('AboutUs') }}
                    </a>
                </li>
                <div class="collapse navbar-collapse justify-content-end" id="navbar">
                <ul class="navbar-nav">
            <li class="nav-item @if($activePage == 'welcome') active @endif">
                    <a href="{{ route('contact') }}" class="nav-link">
                     {{ __('Contact') }}
                    </a>
                </li>

                
                <li class="nav-item dropdown @if($activePage == 'login') active @endif">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" style="color: white;">
        <i class="nc-icon nc-mobile"></i> {{ __('Login') }}
    </a>
    <ul class="dropdown-menu">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.login') }}" style="color: #000000;">Administrator</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('pupil.login') }}" style="color: #000000;">Pupil</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('rep.login') }}" style="color: #000000;">Representative</a>
        </li>
    </ul>
</nav>

<style>
    .navbar {
  font-family: Arial, Helvetica, sans-serif;
  position:sticky;
}

    .navbar-nav .nav-link {
    color: #fff; /* Change this to the same color as your navbar */
}
    .navbar-nav .nav-link:active {
    background-color: #007bff; /* Change this to your desired active color */
    color: #ffffff; /* Change this to your desired active text color */
}
.navbar-transparent.bg-dark {
  background-color: teal !important;
  font-family: arial, helvetica, sans-serif;
}

</style>
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>