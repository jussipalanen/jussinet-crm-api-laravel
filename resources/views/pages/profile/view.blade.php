@extends('layout.dashboard')
@section('content')
    <h2>View profile</h2>
    <h3>{{ ($user->firstname ?: 'null') . ' ' . ($user->lastname ?: 'null') }}</h3>
    <p>
        <a href="{{ url('profile/edit')}} ">
            Edit profile
        </a>
    </p>
@endsection
