@extends('layout.dashboard')
@section('content')
    <h2>Change your password</h2>
    <form action="{{ url('profile/change_password') }}" method="post" enctype="multipart/form-data">
        @csrf
        
        @if (session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif

        @if ( $errors->any() )
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    {!! $error . '<br>' !!}
                @endforeach
            </div>
        @endif

        <div class="mb-3">
            <label for="current_password" class="form-label">Your current password</label>
            <input type="password" name="current_password" id="current_password" class="form-control" value="">
            @error('current_password')
                <span class="invalid-feedback d-block" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">New password</label>
            <input type="password" name="password" id="password" class="form-control" value="">
            @error('password')
                <span class="invalid-feedback d-block" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="repassword" class="form-label">Re-new password</label>
            <input type="password" name="repassword" id="repassword" class="form-control" value="">
            @error('repassword')
                <span class="invalid-feedback d-block" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>

        
        <div class="mb-3">
            <button type="submit" name="submit"
                class="btn btn-primary">Update</button>
        </div>
    </form>
@endsection
