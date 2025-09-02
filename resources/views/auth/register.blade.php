@extends('layouts.auth')

@section('content')
    <main class="form-signin w-100 m-auto px-4 py-4 shadow-lg overflow-hidden sm:rounded-lg">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <h1 class="h4 mb-3 fw-normal text-center">Create Account</h1>

            <div class="form-floating mb-3">
                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                    name="username" value="{{ old('username') }}" placeholder="Username" required autofocus>
                <label for="username">Username</label>
                @error('username')
                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name') }}" placeholder="Full Name" required>
                <label for="name">Full Name</label>
                @error('name')
                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="form-floating mb-3">
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                    name="email" value="{{ old('email') }}" placeholder="Email" required>
                <label for="email">Email</label>
                @error('email')
                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="form-floating mb-3">
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    name="password" placeholder="Password" required>
                <label for="password">Password</label>
                @error('password')
                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                    placeholder="Confirm Password" required>
                <label for="password_confirmation">Confirm Password</label>
            </div>

            <button class="btn btn-primary w-100 py-2" type="submit">
                Register
            </button>

            <div class="text-center mt-3">
                <span class="text-muted">Already have an account?</span>
                <a href="{{ route('login') }}">Sign in</a>
            </div>

        </form>
    </main>
@endsection
