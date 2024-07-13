<div class="sidebar" data-image="{{ asset('light-bootstrap/img/sidebar-5.jpg') }}">
    <!--
Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

Tip 2: you can also add an image using data-image tag
-->
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="http://www.creative-tim.com" class="simple-text">
                {{ __("Maths Competition") }}
            </a>
        </div>
        <ul class="nav">
        <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#pupilDashboard" @if($activeButton == 'pupilDashboard') aria-expanded="true" @endif>
        <i>
        <i class="nc-icon nc-single-02"></i> <!-- <img src="{{ asset('light-bootstrap/img/dashboard.svg') }}" style="width:25px"> -->
        </i>
        <p>
            {{ __('Pupil Dashboard') }}
            <b class="caret"></b>
        </p>
        </a>
     <div class="collapse @if($activeButton == 'pupilDashboard') show @endif" id="pupilDashboard">
        <ul class="nav">
            <li class="nav-item @if($activePage == 'home') active @endif">
                <a class="nav-link" href="{{ url('home') }}">
                    <!-- <i class="nc-icon nc-bank"></i>home page icon -->
                    <p>{{ __("Home") }}</p>
                </a>
            </li>
            <li class="nav-item @if($activePage == 'challenges') active @endif">
                <a class="nav-link" href="{{ url('challenges') }}">
                    <!-- <i class="nc-icon nc-trophy"></i> challenges icon-->
                    <p>{{ __("Challenges") }}</p>
                </a>
            </li>
            <li class="nav-item @if($activePage == 'progress') active @endif">
                <a class="nav-link" href="{{ url('progress') }}">
                    <!-- <i class="nc-icon nc-chart-bar-32"></i> progress -->
                    <p>{{ __("Progress") }}</p>
                </a>
            </li>
            <li class="nav-item @if($activePage == 'submissions') active @endif">
                <a class="nav-link" href="{{ url('submissions') }}">
                    <!-- <i class="nc-icon nc-paper"></i> -->
                    <p>{{ __("Submissions") }}</p> 
                </a>
            </li>
            <li class="nav-item @if($activePage == 'profile') active @endif">
                <a class="nav-link" href="{{ url('profile') }}">
                    <!-- <i class="nc-icon nc-single-02"></i> profile -->
                    <p>{{ __("Profile") }}</p>
                </a>
            </li>
            <li class="nav-item @if($activePage == 'settings') active @endif">
                <a class="nav-link" href="{{ url('settings') }}">
                    <!-- <i class="nc-icon nc-settings-gear-65"></i>setting -->
                    <p>{{ __("Settings") }}</p>
                </a>
            </li>
            <li class="nav-item @if($activePage == 'help') active @endif">
                <a class="nav-link" href="{{ url('help') }}">
                    <!-- <i class="nc-icon nc-support-17"></i>help/support -->
                    <p>{{ __("Help/Support") }}</p>
                </a>
            </li>
        </ul>
    </div>
</li>


            <!-- <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#laravelExamples" @if($activeButton =='laravel') aria-expanded="true" @endif>
                    <i>
                        <img src="{{ asset('light-bootstrap/img/laravel.svg') }}" style="width:25px">
                    </i>
                    <p>
                        {{ __('Laravel example') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse @if($activeButton =='laravel') show @endif" id="laravelExamples">
                    <ul class="nav">
                        <li class="nav-item @if($activePage == 'user') active @endif">
                            <a class="nav-link" href="{{route('profile.edit')}}">
                                <i class="nc-icon nc-single-02"></i>
                                <p>{{ __("User Profile") }}</p>
                            </a>
                        </li> -->
                        <!-- <li class="nav-item @if($activePage == 'user-management') active @endif">
                            <a class="nav-link" href="{{route('user.index')}}">
                                <i class="nc-icon nc-circle-09"></i>
                                <p>{{ __("User Management") }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item @if($activePage == 'table') active @endif">
                <a class="nav-link" href="{{route('page.index', 'table')}}">
                    <i class="nc-icon nc-notes"></i>
                    <p>{{ __("Table List") }}</p>
                </a>
            </li> -->
            <!-- <li class="nav-item @if($activePage == 'typography') active @endif">
                <a class="nav-link" href="{{route('page.index', 'typography')}}">
                    <i class="nc-icon nc-paper-2"></i>
                    <p>{{ __("Typography") }}</p>
                </a>
            </li>
            <li class="nav-item @if($activePage == 'icons') active @endif">
                <a class="nav-link" href="{{route('page.index', 'icons')}}">
                    <i class="nc-icon nc-atom"></i>
                    <p>{{ __("Icons") }}</p>
                </a>
            </li>
            <li class="nav-item @if($activePage == 'maps') active @endif">
                <a class="nav-link" href="{{route('page.index', 'maps')}}">
                    <i class="nc-icon nc-pin-3"></i>
                    <p>{{ __("Maps") }}</p> -->
                <!-- </a> -->
            </li>
            <li class="nav-item @if($activePage == 'notifications') active @endif">
                <a class="nav-link" href="{{route('page.index', 'notifications')}}">
                    <i class="nc-icon nc-bell-55"></i>
                    <p>{{ __("Notifications") }}</p>
                </a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link active bg-danger" href="{{route('page.index', 'upgrade')}}">
                    <i class="nc-icon nc-alien-33"></i>
                    <p>{{ __("Upgrade to PRO") }}</p>
                </a>
<<<<<<< HEAD
            </li> -->
=======
            </li>

>>>>>>> origin/laravel-project
        </ul>
    </div>
</div>
