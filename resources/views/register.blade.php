@extends('layouts.master')

@section('title', 'register page')

@section('content')
    <div class="login-form">
        <form action=" {{ route('register') }} " method="post">
            @csrf
            {{-- name  --}}
            <div class="form-group">
                <label>Username</label>
                <input class="au-input au-input--full" type="text" name="name" placeholder="Username">
            </div>
            @error('name')
                <small class="text-danger"> {{$message}} </small>
            @enderror
            {{-- email  --}}
            <div class="form-group">
                <label>Email Address</label>
                <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
            </div>
            @error('email')
                <small class="text-danger"> {{$message}} </small>
            @enderror
            {{-- Phone Number  --}}
            <div class="form-group">
                <label>Phone</label>
                <input class="au-input au-input--full" type="number" name="phone" placeholder="Phone Number">
            </div>
            @error('phone')
                <small class="text-danger"> {{$message}} </small>
            @enderror
            {{-- gender  --}}
            <div class="form-group">
                <label>Gender</label>
                <select class="au-input au-input--full" name="gender">
                    <option value="">Choose Gander ..</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            @error('gender')
                <small class="text-danger"> {{$message}} </small>
            @enderror
            {{-- Address  --}}
            <div class="form-group">
                <label>Address</label>
                <input class="au-input au-input--full" type="text" name="address" placeholder="Location">
            </div>
            @error('address')
            <small class="text-danger"> {{$message}} </small>
            @enderror
            {{-- Password  --}}
            <div class="form-group">
                <label>Password</label>
                <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
            </div>
            @error('password')
            <small class="text-danger"> {{$message}} </small>
            @enderror
            {{-- Confirm Password  --}}
            <div class="form-group">
                <label>Confirm Password</label>
                <input class="au-input au-input--full" type="password" name="password_confirmation"
                    placeholder="Confirm Password">
            </div>
            @error('password_confirmation')
            <small class="text-danger"> {{$message}} </small>
            @enderror

            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">register</button>

        </form>
        <div class="register-link">
            <p>
                Already have account?
                <a href="{{ route('auth#loginPage') }}">Sign In</a>
            </p>
        </div>
    </div>
@endsection
