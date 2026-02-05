@extends('layouts.frontsite')

@section('title', 'Test Custom Itinerary')

@section('content')
<div style="padding: 50px;">
    <h1>Test Custom Itinerary Page</h1>
    <p>This is a test page to check if the route and view are working.</p>
    
    <h2>Destinations Count: {{ $destinations->count() }}</h2>
    
    @if($destinations->count() > 0)
        <h3>Available Destinations:</h3>
        <ul>
            @foreach($destinations as $destination)
                <li>{{ $destination->title }}</li>
            @endforeach
        </ul>
    @else
        <p>No destinations found.</p>
    @endif
</div>
@endsection