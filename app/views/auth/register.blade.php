@extends('layouts.auth.main')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="text-center mb-4">
                <a href="/">
                    <span><img src="/assets/images/logo-dark.png" alt="" height="30"></span>
                </a>
            </div>

            <form action="{{ route('signup') }}" id="registerForm" onsubmit="submitForm(event)">

                @if(isset($oauthData))
                   <div class="alert alert-danger" role="alert">
                        User not found, Enter password to Create User
                    </div> 
                @endif

                @csrf
                <div class="form-group">
                    <label for="fullname">Full Name</label>
                    <input name="name" class="form-control" type="text" id="name" placeholder="John Doe" 
                        value="{{ !isset($oauthData) ? null : $oauthData['givenName'] .' '. $oauthData['familyName'] }}" required>
                </div>

                <div class="form-group">
                    <label for="emailaddress">Email Address</label>
                    <input name="email" class="form-control" type="email" id="email" placeholder="johndoe@gmail.com" value="{{ $oauthData['email'] ?? null }}" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input name="password" class="form-control" type="password" id="password" placeholder="··········" required>
                </div>

                <div class="mb-3 text-center">
                    <button class="btn btn-primary btn-block" id="btnRegister" type="submit"> Sign Up </button>
                </div>

                @if(AuthConfig('ALLOW_GOOGLE_AUTH'))
                    <div class="mb-3 text-center">
                        <a href="{{ route('google.auth') }}" class="btn btn-danger btn-block">
                            Sign in with Google
                        </a>
                    </div>
                @endif
            </form>
            
            <div class="row mt-2">
                <div class="col-sm-12 text-center">
                    <p class="text-muted mb-0">
                        Already have an account?
                        <a class="fw-bold" href="{{ route('login') }}" class="text-dark ml-1">Login</a>
                    </p>
                </div>
            </div>
        
        </div>
    </div>
@endsection
@script('auth.scripts.auth')