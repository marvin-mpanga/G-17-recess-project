
<nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-absolute">
    <div class="container">
        
    <div class="navbar-wrapper">
  <a class="navbar-brand"><h1 class="logo" style="text-indent: -999999px; background: url('img/maths.png';">logo here</h1>

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
                    <a href="{{ route('welcome') }}" class="nav-link" style="color:white;">
                        <i class="fa-solid fa-house"></i> {{ __('Home') }}
                    </a>
                </li>
                <li class="nav-item @if($activePage == 'contact') active @endif">
                <a href="{{ route('contact') }}" class="nav-link" style="color:white;">
                        {{ __('Contact') }}
                    </a>
                    </li>
                    <li class="nav-item @if($activePage == 'aboutUs') active @endif">
                <a href="{{ route('aboutUs') }}" class="nav-link" style="color:white;">
                        {{ __('About us') }}
                    </a>
</li>
                <li class="nav-item dropdown @if($activePage == 'login') active @endif">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" style="color: white;">
        {{ __('Login') }}
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
    </li>
        
                
</li>

</nav>
