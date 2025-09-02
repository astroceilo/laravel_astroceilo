@extends('layouts.auth')

@section('content')
    <main class="form-signin w-100 m-auto px-4 py-4 shadow-lg overflow-hidden sm:rounded-lg">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- <h1 class="h4 mb-3 fw-normal text-center">Login</h1> --}}

            <div class="form-floating">
                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                    name="username" placeholder="Username" autofocus autocomplete="username" />
                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <label for="username">Username</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    name="password" placeholder="Password" autocomplete="current-password" />
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <label for="password">Password</label>
            </div>
            <div class="form-check text-start my-3">
                <input class="form-check-input" type="checkbox" value="remember-me" id="checkDefault" />
                <label class="form-check-label" for="checkDefault">
                    Remember me
                </label>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-3 mb-3">
                <span class="text-muted">Don't have an account?
                    <a href="{{ route('register') }}">Register</a>
                </span>
                <button class="btn btn-primary" type="submit">
                    Login
                </button>
            </div>
        </form>
    </main>
@endsection
