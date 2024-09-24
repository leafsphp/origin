<div id="securityDetails" class="profile-overview-tab d-none">
    <h4 class="card-title">Security</h4>
    <p class="text-muted">Update your account security settings.</p>
    <hr>

    <!-- warning: under development -->
    <div class="alert alert-warning" role="alert">
        <strong>Under Development!</strong> This feature is currently under development, and won't be available anytime soon.
    </div>

    <!-- 2FA -->
    <div class="form-group mt-3">
        <label for="2fa" class="form-label">2F Authentication</label>
        <div class="custom-control custom-switch inline-switch">
            <input type="checkbox" class="custom-control-input" id="2fa">
            <label class="custom-control-label" for="2fa"></label>
        </div>
    </div>

    <!-- 2fa code -->
    <div class="form-group mt-3 d-none">
        <label for="2faCode" class="form-label">2FA Code</label>
        <input type="text" class="form-control" id="2faCode" placeholder="Enter 2FA Code">
    </div>

    <!-- password expiration -->
    <div class="form-group mt-3">
        <label for="passwordExpiration" class="form-label">Password Expiration</label>
        <div class="custom-control custom-switch inline-switch">
            <input type="checkbox" class="custom-control-input" id="passwordExpiration">
            <label class="custom-control-label" for="passwordExpiration"></label>
        </div>
    </div>

    <!-- email notifications -->
    <div class="form-group mt-3">
        <label for="emailNotifications" class="form-label">Email Notifications</label>
        <div class="custom-control custom-switch inline-switch">
            <input type="checkbox" class="custom-control-input" id="emailNotifications">
            <label class="custom-control-label" for="emailNotifications"></label>
        </div>
    </div>

</div>