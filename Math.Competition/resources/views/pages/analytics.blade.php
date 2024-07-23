<!-- report.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Challenge Report</h1>

    <p>Total Time Taken: {{ gmdate('H:i:s', $totalTime) }}</p>
    <p>Total Score: {{ $totalScore }}</p>

    <h2>Question-wise Report</h2>
    <ul>
        @foreach($scores as $index => $score)
        <li>
            <p>Question ID: {{ $score['question_id'] }}</p>
            <p>Score: {{ $score['score'] }}</p>
            <p>Time Taken: {{ gmdate('H:i:s', $questionTimes[$index]['time_taken']) }}</p>
        </li>
        @endforeach
    </ul>
</div>
@endsection

