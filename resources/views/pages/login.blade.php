@extends('layout.master')
@section('content')
    <h2>Login</h2>
    <p>Please enter your email and password to login.</p>
    <form action="{{ route('auth.dologin') }}" method="post">
        @csrf

        @if (session('success'))
            <p>{{session('success')}}</p>
        @endif

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" required>
            @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="text" name="password" id="password" required>
            @if ($errors->has('password'))
            <span class="text-danger">{{ $errors->first('password') }}</span>
        @endif
        </div>

        <div class="form-group">
            <label for="rememberme">Remember me:</label>
            <input type="checkbox" name="rememberme" id="rememberme">
        </div>

        <div class="form-group">
            <input type="submit" name="login" value="Login">
        </div>
    </form>
@endsection
