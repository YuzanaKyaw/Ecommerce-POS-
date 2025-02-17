@extends('layouts.master')

@section('content')
    <div class="login-form">
        <form action="{{route('register')}}" method="post">
            @csrf
            @error('terms')
            <small class='text-danger'>{{$message}}</small>
            @enderror
            <div class="form-group">
                <label>Username</label>
                <input class="au-input au-input--full" type="text" name="username" placeholder="Username">
            </div>
            @error('username')
                <small class='text-danger'>{{$message}}</small>
            @enderror

            <div class="form-group">
                <label>Email Address</label>
                <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
            </div>
            @error('email')
                <small class='text-danger'>{{$message}}</small>
            @enderror

            <div class="form-group">
                <label>Phone</label>
                <input class="au-input au-input--full" type="text" name="phone" placeholder="09xxxxxxxxx">
            </div>
            @error('phone')
                <small class='text-danger'>{{$message}}</small>
            @enderror

            <div class="form-group">
                <label for="">Gender</label>
                <select name="gender" class="form-control" id="">
                    <option value="">Choose gender...</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            @error('gender')
                <small class='text-danger'>{{$message}}</small>
            @enderror

            <div class="form-group">
                <label>Address</label>
                <input class="au-input au-input--full" type="text" name="address" placeholder="Enter address">
            </div>
            @error('address')
                <small class='text-danger'>{{$message}}</small>
            @enderror

            <div class="form-group">
                <label>Password</label>
                <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
            </div>
            @error('password')
                <small class='text-danger'>{{$message}}</small>
            @enderror

            <div class="form-group">
                <label>Password Confirmation</label>
                <input class="au-input au-input--full" type="password" name="password_confirmation"
                    placeholder="Confirm Password">
            </div>
            @error('password_confirmation')
                <small class='text-danger'>{{$message}}</small>
            @enderror


            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">register</button>

        </form>
        <div class="register-link">
            <p>
                Already have account?
                <a href="{{route('auth#loginPage')}}">Sign In</a>
            </p>
        </div>
    </div>

@endsection
