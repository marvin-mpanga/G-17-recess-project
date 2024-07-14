@extends('layouts.app', ['activePage' => 'statistics', 'title' => 'View Statistics', 'navName' => 'View Statistics', 'activeButton' => 'laravel'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Example Statistics Cards -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header" data-background-color="purple">
                            <i class="material-icons">people</i>
                        </div>
                        <div class="card-content">
                            <p class="category">Total Users</p>
                            <h3 class="card-title">1,245</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">update</i> Updated now
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header" data-background-color="orange">
                            <i class="material-icons">school</i>
                        </div>
                        <div class="card-content">
                            <p class="category">Total Schools</p>
                            <h3 class="card-title">45</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">update</i> Updated now
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header" data-background-color="green">
                            <i class="material-icons">question_answer</i>
                        </div>
                        <div class="card-content">
                            <p class="category">Total Questions</p>
                            <h3 class="card-title">1,234</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">date_range</i> Last 24 Hours
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header" data-background-color="blue">
                            <i class="material-icons">assessment</i>
                        </div>
                        <div class="card-content">
                            <p class="category">Submissions</p>
                            <h3 class="card-title">789</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">update</i> Updated now
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detailed Statistics Section -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('Detailed Statistics') }}</h4>
                            <p class="card-category">{{ __('In-depth analysis and insights') }}</p>
                        </div>
                        <div class="card-body">
                            <!-- Add detailed charts, graphs, or tables here -->
                            <div class="row">
                                <div class="col-md-6">
                                    <canvas id="userChart"></canvas>
                                </div>
                                <div class="col-md-6">
                                    <canvas id="questionChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Charts (using Chart.js) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctxUser = document.getElementById('userChart').getContext('2d');
            var ctxQuestion = document.getElementById('questionChart').getContext('2d');

            var userChart = new Chart(ctxUser, {
                type: 'bar',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                    datasets: [{
                        label: 'User Growth',
                        data: [65, 59, 80, 81, 56, 55, 40],
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            var questionChart = new Chart(ctxQuestion, {
                type: 'line',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                    datasets: [{
                        label: 'Questions Added',
                        data: [28, 48, 40, 19, 86, 27, 90],
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endsection

