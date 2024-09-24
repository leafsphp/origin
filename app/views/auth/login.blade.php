@extends('layouts.auth.main')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="text-center mb-4 mt-3">
                <a href="/">
                    <span><img src="/assets/images/logo-dark.png" alt="" height="30"></span>
                </a>
            </div>

            <form action="{{ route('signin') }}" id="loginForm" class="p-2">
                @csrf
                <div class="form-group">
                    <label for="emailaddress">Email Address</label>
                    <input name="email" class="form-control" type="email" id="email" placeholder="johndoe@gmail.com" required>
                </div>
                
                <div class="form-group position-relative">
                    <label for="password">Password</label>
                    <input name="password" class="form-control" type="password" id="password" placeholder="··········" required>
                    <i class="ph-duotone ph-eye togglePassword"></i>
                </div>

                <div class="form-group mb-3 pb-3">
                    <a href="{{ route('reset', 'request') }}" class="text-muted">Reset your password?</a>
                </div>

                <div class="mb-3 text-center">
                    <button class="btn btn-primary btn-block" id="btnLogin" type="submit"> Sign In </button>
                </div>
            </form>
            
            <div class="row mt-2">
                <div class="col-sm-12 text-center">
                    <p class="text-muted mb-0">
                        Don't have an account?
                        <a class="fw-bold" href="{{ route('register') }}" class="text-dark ml-1">Sign Up</a>
                    </p>
                </div>
            </div>
        
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $('#loginForm').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            buttonState('#btnLogin', 'loading');

            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: form.serialize(),
                success: function(response) {
                    if (response.status) {
                        toast.success({ message: response.message });
                        setTimeout(() => {
                            window.location.href = response.redirect;
                        }, 1000);
                    }else{
                        toast.error({ message: response.message });
                    }
                },
                error: function(xhr) {
                    toast.error({ message: 'Unknown Error Occurred' });
                },
                complete: function() {
                    buttonState('#btnLogin', 'reset', 'Sign In');
                }   
            });
            
        });
    </script>
@endpush