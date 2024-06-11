@extends('layouts.auth')

@section('title')
	Sign In
@endsection

@section('content')
	<form role="form" method="POST" action="{{ route('login') }}">
		@csrf
        <div class="mb-3">
            <input name="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror"
            value="{{ old('email') }}" placeholder="Email" aria-label="Email">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-3">
            <input name="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="Password" aria-label="Password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Sign in</button>
        </div>
    </form>
@endsection