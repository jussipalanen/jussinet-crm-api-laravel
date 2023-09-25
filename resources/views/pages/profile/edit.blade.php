@extends('layout.dashboard')
@section('content')
    <h2>Edit profile</h2>
    <form action="" method="post" enctype="multipart/form-data">

        @if (session()->get('errors'))
            <div class="alert alert-success">
                {{ session()->get('errors') }}
            </div>
        @endif
        @csrf

        <div class="mb-3">
            <label for="person_image" class="form-label">Person image</label>
            <input type="file" name="person_image" id="person_image" class="form-control">
            @if (isset($user->person_image))
                <input type="hidden" name="uploaded_person_image" value="{{ $user->person_image }}">
            @endif
            @error('person_image')
                <span class="invalid-feedback d-block" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>


        <div class="mb-3">
            <p>Preview image:</p>
            @if (isset($user->person_image))
                <img class="img-thumbnail rounded person-image-edit"
                    src="{{ Storage::url('app/' . $user->person_image) }}">
            @endif
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $user->name ?? '' }}" disabled>
            @error('name')
                <span class="invalid-feedback d-block" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" name="email" id="email" class="form-control" value="{{ $user->email ?? '' }}" disabled>
            @error('email')
                <span class="invalid-feedback d-block" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="firstname" class="form-label">Firstname</label>
            <input type="text" name="firstname" id="firstname" class="form-control" value="{{ $user->firstname ?? '' }}">
            @error('firstname')
                <span class="invalid-feedback d-block" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>


        <div class="mb-3">
            <label for="lastname" class="form-label">Lastname</label>
            <input type="text" name="lastname" id="lastname" class="form-control" value="{{ $user->lastname ?? '' }}">
            @error('lastname')
                <span class="invalid-feedback d-block" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>


        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" name="address" id="address" class="form-control" value="{{ $user->address ?? '' }}">
            @error('address')
                <span class="invalid-feedback d-block" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="city" class="form-label">City</label>
            <input type="text" name="city" id="city" class="form-control" value="{{ $user->city ?? '' }}">
            @error('city')
                <span class="invalid-feedback d-block" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>


        <div class="mb-3">
            <label for="country" class="form-label">Country</label>
            <select class="form-select form-select-lg" name="country" id="country">
                @foreach ($countries as $country)
                    <option value="{{ $country['key'] }}" {{ $user->country == $country['key'] ? 'selected' : '' }}>{{ $country['value'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ $user->phone ?? '' }}">
            @error('phone')
                <span class="invalid-feedback d-block" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <button type="submit" name="submit"
                class="btn btn-primary">Update</button>
            <a class="btn btn-primary" href="{{ url('profile/change_password') }}">Change password</a>
        </div>
    </form>
@endsection
