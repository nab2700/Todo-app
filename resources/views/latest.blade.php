@extends('layouts.app')

@section('title', 'First Data')

@section('content')
    @if ($firstData)
        <h3>{{ $firstData->name }}</h3>
        <!-- Display other properties as needed -->
    @else
        <p>No data found.</p>
    @endif

    <!-- Additional content goes here -->
@endsection
