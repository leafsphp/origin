<div id="passwordDetails" class="profile-overview-tab d-none">
    <h4 class="card-title">Password</h4>
    <p class="text-muted">Update your account password.</p>
    <hr>

    <form action="{{ route('app.password.update') }}" id="securityForm" onsubmit="updatePassword(event)">
        @csrf
        <div class="form-group">
            <label for="currentPassword" class="form-label">Current Password</label>
            <input name="current_password" class="form-control" type="password" placeholder="··········" required>
        </div>
        <div class="form-group">
            <label for="newPassword" class="form-label">New Password</label>
            <input name="new_password" class="form-control" type="password" placeholder="··········" required>
        </div>
        <div class="form-group">
            <label for="confirmPassword" class="form-label">Confirm Password</label>
            <input name="confirm_password" class="form-control" type="password" placeholder="··········" required>
        </div>
        <div class="form-group text-center pt-3">
            <button class="btn btn-primary btn-form" type="submit">Update Password</button>
        </div>
    </form>
</div>

<script>

    function updatePassword(event) {
        event.preventDefault();
        var form = $('#securityForm');

        // validate form
        if (form.find('input[name="new_password"]').val() != form.find('input[name="confirm_password"]').val()) {
            toast.error({ message: 'New Password and Confirm Password do not match' });
            return;
        }

        // password length
        if (form.find('input[name="new_password"]').val().length < 6) {
            toast.error({ message: 'Password must be at least 6 characters' });
            return;
        }

        buttonState('#btnUpdatePassword', 'loading');

        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: form.serialize(),
            success: function(response) {
                if (response.status) {
                    toast.success({ message: response.message });
                } else {
                    toast.error({ message: response.message });
                }
            },
            error: function() {
                toast.error({ message: 'Unknown Error Occurred' });
            },
            complete: function() {
                buttonState('#btnUpdatePassword', 'reset', 'Update Password');
            }
        });
    }

</script>