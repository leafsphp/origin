@extends('layouts.auth.main')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="text-center mb-4 mt-3">
                <a href="/">
                    <span><img src="/assets/images/logo-dark.png" alt="App Logo" height="30"></span>
                </a>
                <p class="text-muted mt-3">Enter your 2FA code to verify your login</p>
            </div>

            <form action="{{ route('2fa') }}" id="2faForm" class="p-2" onsubmit="submitForm(event)">
                @csrf
                <div class="form-group">
                    <input name="code" class="form-control text-center" type="text" id="code" placeholder="123456" required>
                </div>

                <div class="mb-3 row">
                    <div class="col">
                        <button class="btn btn-primary btn-block" id="btn2fa" type="submit"> Verify Login </button>
                    </div>
                    <div class="col">
                        <button class="btn btn-light btn-block border" id="resendTimer" data-resend-time="{{$timer}}" readonly disabled> Resend Code </button>
                    </div>
                </div>

                <div class="mb-3 text-center">
                    <a href={{ route('logout') }} class="btn btn-danger btn-block"> Logout </a>
                </div>
            </form>
        </div>
    </div>
@endsection
@script('auth.scripts.2fa')