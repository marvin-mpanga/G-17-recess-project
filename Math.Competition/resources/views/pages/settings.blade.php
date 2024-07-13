@extends('layouts.app', ['activePage' => 'settings', 'title' => 'National Mathematics Competition', 'navName' => 'settings', 'activeButton' => 'laravel'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <!-- Settings Page Header -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('Settings') }}</h4>
                            <p class="card-category">{{ __('Customize your preferences') }}</p>
                        </div>
                        <div class="card-body">
                            <!-- Sidebar Style -->
                            <div class="setting-section">
                                <h5>{{ __('Sidebar Style') }}</h5>
                                <div class="form-group">
                                    <label for="backgroundImage">{{ __('Background Image') }}</label>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="backgroundImageToggle" checked>
                                        <label class="custom-control-label" for="backgroundImageToggle">{{ __('Enable') }}</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Dark/Light Mode Toggle -->
                            <div class="setting-section">
                                <h5>{{ __('Dark Mode') }}</h5>
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="darkModeToggle">
                                        <label class="custom-control-label" for="darkModeToggle">{{ __('Enable Dark Mode') }}</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Background Filters -->
                            <div class="setting-section">
                                <h5>{{ __('Filters') }}</h5>
                                <div class="form-group">
                                    <label>{{ __('Choose Filter') }}</label>
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-secondary">
                                            <input type="radio" name="filterOptions" id="filterBlack" value="black">{{ __('Black') }}
                                        </label>
                                        <label class="btn btn-secondary">
                                            <input type="radio" name="filterOptions" id="filterAzure" value="azure">{{ __('Azure') }}
                                        </label>
                                        <label class="btn btn-secondary">
                                            <input type="radio" name="filterOptions" id="filterGreen" value="green">{{ __('Green') }}
                                        </label>
                                        <label class="btn btn-secondary">
                                            <input type="radio" name="filterOptions" id="filterOrange" value="orange">{{ __('Orange') }}
                                        </label>
                                        <label class="btn btn-secondary">
                                            <input type="radio" name="filterOptions" id="filterRed" value="red">{{ __('Red') }}
                                        </label>
                                        <label class="btn btn-secondary">
                                            <input type="radio" name="filterOptions" id="filterPurple" value="purple">{{ __('Purple') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Additional Features -->
                            <div class="setting-section">
                                <h5>{{ __('Additional Settings') }}</h5>
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="notificationsToggle" checked>
                                        <label class="custom-control-label" for="notificationsToggle">{{ __('Enable Notifications') }}</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="tutorialsToggle" checked>
                                        <label class="custom-control-label" for="tutorialsToggle">{{ __('Show Tutorials') }}</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="autoSaveToggle" checked>
                                        <label class="custom-control-label" for="autoSaveToggle">{{ __('Enable Auto-Save') }}</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Sidebar Images -->
                            <div class="setting-section">
                                <h5>{{ __('Sidebar Images') }}</h5>
                                <div class="form-group">
                                    <label>{{ __('Choose an Image') }}</label>
                                    <div class="image-selector">
                                        <img src="{{ asset('light-bootstrap/img/sidebar-1.jpg') }}" alt="Image 1" class="img-thumbnail">
                                        <img src="{{ asset('light-bootstrap/img/sidebar-3.jpg') }}" alt="Image 2" class="img-thumbnail">
                                        <img src="{{ asset('light-bootstrap/img/sidebar-4.jpg') }}" alt="Image 3" class="img-thumbnail">
                                        <img src="{{ asset('light-bootstrap/img/sidebar-5.jpg') }}" alt="Image 4" class="img-thumbnail">
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="form-group">
                                <a href="https://www.creative-tim.com/product/light-bootstrap-dashboard-laravel" target="_blank" class="btn btn-info btn-fill">{{ __("Download, it's free!") }}</a>
                            </div>
                            <div class="form-group">
                                <a href="https://light-bootstrap-dashboard-laravel.creative-tim.com/docs/tutorial-components.html" target="_blank" class="btn btn-default btn-fill">{{ __('View Documentation') }}</a>
                            </div>
                            <div class="form-group">
                                <a href="https://www.creative-tim.com/product/light-bootstrap-dashboard-pro-laravel" target="_blank" class="btn btn-warning btn-fill">{{ __('Get The PRO Version!') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional JavaScript for Dark/Light Mode Toggle -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const darkModeToggle = document.getElementById('darkModeToggle');
            const body = document.body;
            
            // Check localStorage for dark mode preference
            if (localStorage.getItem('darkMode') === 'enabled') {
                body.classList.add('dark-mode');
                darkModeToggle.checked = true;
            }

            darkModeToggle.addEventListener('change', function() {
                if (darkModeToggle.checked) {
                    body.classList.add('dark-mode');
                    localStorage.setItem('darkMode', 'enabled');
                } else {
                    body.classList.remove('dark-mode');
                    localStorage.setItem('darkMode', 'disabled');
                }
            });
        });
    </script>
@endsection

<!-- Additional CSS for Dark/Light Mode -->
<style>
    .dark-mode {
        background-color: #121212;
        color: #ffffff;
    }
    .dark-mode .card {
        background-color: #2c2c2c;
    }
    .img-thumbnail {
        max-width: 100px;
        cursor: pointer;
    }
    .image-selector {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }
</style>
             