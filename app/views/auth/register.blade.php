@extends('layouts.auth.main')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="text-center mb-4">
                <a href="/">
                    <span><img src="/assets/images/logo-dark.png" alt="" height="30"></span>
                </a>
            </div>

            <form action="{{ route('signup') }}" id="registerForm" class="p-2">
                @csrf
                <div class="form-group">
                    <label for="fullname">Full Name</label>
                    <input name="name" class="form-control" type="text" id="name" placeholder="John Doe" required>
                </div>

                <div class="form-group">
                    <label for="emailaddress">Email Address</label>
                    <input name="email" class="form-control" type="email" id="email" placeholder="johndoe@gmail.com" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input name="password" class="form-control" type="password" id="password" placeholder="··········" required>
                </div>

                <div class="mb-3 text-center">
                    <button class="btn btn-primary btn-block" id="btnRegister" type="submit"> Sign Up </button>
                </div>
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
@push('scripts')
    <script>
        $('#registerForm').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            buttonState('#btnRegister', 'loading');

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
                    } else {
                        toast.error({ message: response.message });
                        buttonState('#btnRegister', 'reset');
                    }
                },
                error: function() {
                    toast.error({ message: 'An error occurred. Please try again later.' });
                    buttonState('#btnRegister', 'reset', 'Sign Up');
                }
            });
        });
    </script>
@endpush