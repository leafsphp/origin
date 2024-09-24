@extends('layouts.auth.main')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="text-center mb-4 mt-3">
                <a href="/">
                    <span><img src="/assets/images/logo-dark.png" alt="" height="30"></span>
                </a>
                <p class="text-muted mt-3">Enter your email address to reset your password</p>
            </div>


            <form action="{{ route('update.password') }}" id="resetForm" class="p-2">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                 
                <div class="form-group position-relative">
                    <label for="password">Password</label>
                    <input name="password" class="form-control" type="password" id="password" placeholder="··········" required>
                    <i class="ph-duotone ph-eye togglePassword"></i>
                </div>

                <div class="mb-3 text-center">
                    <button class="btn btn-primary btn-block" id="btnReset" type="submit"> Reset Password </button>
                </div>
            </form>
            
            <div class="row mt-2">
                <div class="col-sm-12 text-center">
                    <p class="text-muted mb-0">
                        Remember your password?
                        <a class="fw-bold" href="{{ route('login') }}" class="text-dark ml-1">Sign In</a>
                    </p>
                </div>
            </div>
        
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $('#resetForm').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            buttonState('#btnReset', 'loading');

            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: form.serialize(),
                success: function(response) {
                    if (response.status) {
                        toast.success({ message: response.message });
                        setTimeout(() => {
                            window.location.href = '{{ route('login') }}';
                        }, 1000);
                    }else{
                        toast.error({ message: response.message });
                    }
                },
                error: function(xhr) {
                    toast.error({ message: 'Unknown Error Occurred' });
                },
                complete: function() {
                    buttonState('#btnReset', 'reset', 'Reset Password');
                }   
            });
            
        });
    </script>
@endpush