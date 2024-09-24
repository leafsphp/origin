<ul class="list-unstyled mb-0 profile-overview-menus">
    <li class="py-1 profile-overview-menu profile-overview-switch active" data-target-block="#profileDetails">
        <a href="javascript:void(0)" class="text-muted d-flex align-items-center">
            <i class="ph-duotone ph-user h5 mr-2"></i>
            <span>Profile</span>
        </a>
    </li>

    <!-- password -->
    <li class="py-1 profile-overview-menu profile-overview-switch" data-target-block="#passwordDetails">
        <a href="javascript:void(0)" class="text-muted d-flex align-items-center">
            <i class="ph-duotone ph-key h5 mr-2"></i>
            <span>Password</span>
        </a>
    </li>

    <!-- security -->
    <li class="py-1 profile-overview-menu profile-overview-switch" data-target-block="#securityDetails">
        <a href="javascript:void(0)" class="text-muted d-flex align-items-center">
            <i class="ph-duotone ph-shield-check h5 mr-2"></i>
            <span>Security</span>
        </a>
    </li>

    <li class="py-1 profile-overview-menu">
        <a href="{{ route('logout') }}" class="text-muted d-flex align-items-center">
            <i class="ph-duotone ph-sign-out h5 mr-2"></i>
            <span>Logout</span>
        </a>
    </li>
</ul>