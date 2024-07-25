@extends('layouts.app')

@section('content')
    <h1>Schools</h1>

    <table>
        <thead>
            <tr>
                <th>School Registration Number</th>
                <th>School Name</th>
                <th>District</th>
                <th>Representative Name</th>
                <th>Representative Email</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach($schools as $school)
                <tr>
                    <td>{{ $school->schoolRegNo }}</td>
                    <td>{{ $school->schoolName }}</td>
                    <td>{{ $school->district }}</td>
                    <td>{{ $school->repName }}</td>
                    <td>{{ $school->repEmail }}</td>
                    <td>
                        <a href="{{ route('edit_school', $school->id) }}">Edit School</a>
                        <form action="{{ route('delete_school', $school->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete School</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection


These views assume you have a layouts.app view that contains the basic HTML structure, and that you have defined the routes for editing and deleting schools.