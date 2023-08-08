@extends('layout.dashboard')
@section('content')
    View profile
    <a href="{{ url('/profile/edit') }}">
        Edit
    </a>
@endsection