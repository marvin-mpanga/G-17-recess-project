<div class="sidebar" data-image="{{ asset('light-bootstrap/img/sidebar-5.jpg') }}">
  
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="http://www.creative-tim.com" class="simple-text">
                {{ __("Maths Competition") }}
            </a>
        </div>
        <ul class="nav">
        <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#pupilDashboard" @if($activeButton == 'pupilDashboard') aria-expanded="true" @endif>

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
                <ul class="nav">
                <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#adminDashboard" @if($activeButton == 'adminDashboard') aria-expanded="true" @endif>
                    <i class="nc-icon nc-circle-09"></i>
                    <p>
                        {{ __('Admin Dashboard') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse @if($activeButton == 'adminDashboard') show @endif" id="adminDashboard">
                <ul class="nav">
                        <li class="nav-item @if($activePage == 'overview') active @endif">
                            <a class="nav-link" href="{{ url('admin/overview') }}">
                                <p>{{ __("Overview") }}</p>
                            </a>
                        </li>
                        <li class="nav-item @if($activePage == 'schools') active @endif">
                            <a class="nav-link" href="{{ url('admin/schools') }}">
                                <p>{{ __("Manage Schools") }}</p>
                            </a>
                        </li>
                        <li class="nav-item @if($activePage == 'questions') active @endif">
                            <a class="nav-link" href="{{ url('admin/questions') }}">
                                <p>{{ __("Manage Questions") }}</p>
                            </a>
                        </li>
                        <li class="nav-item @if($activePage == 'answers') active @endif">
                            <a class="nav-link" href="{{ url('admin/answers') }}">
                                <p>{{ __("Manage Answers") }}</p>
                            </a>
                        </li>
                        <li class="nav-item @if($activePage == 'uploads') active @endif">
                            <a class="nav-link" href="{{ url('admin/uploads') }}">
                                <p>{{ __("Manage Uploads") }}</p>
                            </a>
                        </li>
                        <li class="nav-item @if($activePage == 'statistics') active @endif">
                            <a class="nav-link" href="{{ url('admin/statistics') }}">
                                <p>{{ __("View Statistics") }}</p>
                            </a>
 </li> 
 </ul>  
</div>
 </li>
 <ul class="nav">
    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#schoolRepDashboard" @if($activeButton == 'schoolRepDashboard') aria-expanded="true" @endif>
            <i class="nc-icon nc-bank"></i>
            <p>
                {{ __('School Representative Dashboard') }}
                <b class="caret"></b>
            </p>
        </a>
        <div class="collapse @if($activeButton == 'schoolRepDashboard') show @endif" id="schoolRepDashboard">
            <ul class="nav">
                <li class="nav-item @if($activePage == 'rep_profile') active @endif">
                    <a class="nav-link" href="{{ url('school-rep/rep_profile') }}">
                        <p>{{ __("Rep Profile") }}</p>
                    </a>
                </li>
                <li class="nav-item @if($activePage == 'viewApplicants') active @endif">
                    <a class="nav-link" href="{{ url('school-rep/viewApplicants') }}">
                        <p>{{ __("View Applicants") }}</p>
                    </a>
                </li>
                <li class="nav-item @if($activePage == 'communications') active @endif">
                    <a class="nav-link" href="{{ url('school-rep/communications') }}">
                        <p>{{ __("Communications") }}</p>
                    </a>
                </li>
                <li class="nav-item @if($activePage == 'analytics') active @endif">
                    <a class="nav-link" href="{{ url('school-rep/analytics') }}">
                        <p>{{ __("Performance Analytics") }}</p>
                    </a>
                </li>
                <li class="nav-item @if($activePage == 'resources') active @endif">
                    <a class="nav-link" href="{{ url('school-rep/resources') }}">
                        <p>{{ __("Resources") }}</p>
                    </a>
                </li>
            </ul>
        </div>
    </li>
</ul>

            
            <li class="nav-item @if($activePage == 'notifications') active @endif">
                <a class="nav-link" href="{{route('page.index', 'notifications')}}">
                    <i class="nc-icon nc-bell-55"></i>
                    <p>{{ __("Notifications") }}</p>
                </a>
            </li>
            <li class="nav-item @if($activePage == 'general settings') active @endif">
                <a class="nav-link" href="{{route('page.index', 'general settings')}}">
                    <i class="nc-icon nc-pin-3"></i>
                    <p>{{ __("General settings") }}</p>
        </ul>
    </div>
</div>
