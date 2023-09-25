@extends('layout.dashboard')
@section('content')
    <h2>View profile</h2>
    <div class="person-card">
        <div class="row">
            <div class="col-md-3 col-sm-12 text-center">
                <img class="img-thumbnail rounded" src="{{ $user->getPersonImage() }}">
            </div>
            <div class="col-md-9 col-sm-12">

                <span class="h4">
                    Name
                </span>
                <p>
                    {{ $user->firstname . ' ' . $user->lastname }}
                </p>
                <span class="h4">
                    Email
                </span>
                <p>
                    {{ $user->email }}
                </p>
                <span class="h4">
                    Last updated
                </span>
                <p>
                    {{ date('d.m.Y H:i:s', strtotime($user->updated_at)) }}
                </p>
            </div>
        </div>
    </div>

    <hr>
    <div class="row">
        <div class="col-12">
            <p>
                <a class="btn btn-primary" href="{{ url('profile/edit') }} ">
                    Edit profile
                </a>
            </p>
        </div>
    </div>
@endsection
