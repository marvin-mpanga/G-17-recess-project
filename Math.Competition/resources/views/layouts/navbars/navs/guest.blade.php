<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute">
    <div class="container">
    <div class="navbar-wrapper">
            <a class="navbar-brand" href="#pablo">
            <h1 class="logo" style="text-indent: -999999px; background: url('/light-bootsrap/img/maths.jpg');">logo here</h1>

            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-bar burger-lines"></span>
                <span class="navbar-toggler-bar burger-lines"></span>
                <span class="navbar-toggler-bar burger-lines"></span>
            </button>
        </div> 


        <div class="collapse navbar-collapse justify-content-end" id="navbar">
            <ul class="navbar-nav">
            <li class="nav-item @if($activePage == 'welcome') active @endif">
                    <a href="{{ route('welcome') }}" class="nav-link">
                        <i class="fa-solid fa-house"></i> {{ __('Home') }}
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
</li>


   
   

            </ul>
        </div>
    </div>
</nav>