@php
    $currentRouteName = \Route::currentRouteName();
@endphp

<style>
    img {
        vertical-align: middle;

        width: 38%;
    }
</style>



<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        {{-- <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('assets/admin/theme/img/logo/logo.png') }}" alt="Company Logo">
            </span>
        </a> --}}

        <a href="{{ route('admin.dashboard') }}" class="app-brand-link">
            @php
                $logo = get_setting('logo');
            @endphp
            <span class="app-brand-logo demo" style="display: inline-block; width: 190px; height: 70px;">
                @if ($logo && file_exists(public_path('logos/' . $logo)))
                    <img src="{{ asset('logos/' . $logo) }}" alt="Company Logo"
                        style="width: 100%; height: 100%; object-fit: contain;">
                @else
                    <img src="{{ asset('assets/admin/theme/img/logo/logo.png') }}" alt="Company Logo"
                        style="width: 100%; height: 100%; object-fit: contain;">
                @endif
            </span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ $currentRouteName == 'admin.dashboard' ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-dashboard"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>

        </li>
        <!-- Profile -->
        {{-- <li class="menu-item {{ $currentRouteName == 'admin.profile' ? 'active' : '' }}">
            <a href="{{ route('admin.profile') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-user-circle"></i>
                <div data-i18n="Profile">Profile</div>
            </a>
        </li> --}}
        <!-- Users -->
        <li class="menu-item {{ $currentRouteName == 'admin.users' ? 'active' : '' }}">
            <a href="{{ route('admin.users') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-group"></i>
                <div data-i18n="Users">Users</div>
            </a>
        </li>

        <li class="menu-item {{ $currentRouteName == 'admin.company' ? 'active' : '' }}">
            <a href="{{ route('admin.company') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-buildings"></i>
                <div data-i18n="Company Management">Company Management</div>
            </a>
        </li>


        <li class="menu-item 
            {{ in_array($currentRouteName, ['admin.general_settings', 'admin.profile']) ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-cog"></i>
                <div data-i18n="Settings">Settings</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item {{ $currentRouteName == 'admin.general_settings' ? 'active' : '' }}">
                    <a href="{{ route('admin.general_settings') }}" class="menu-link">
                        <div data-i18n="General Setting">General Setting</div>
                    </a>
                </li>
                <li class="menu-item {{ $currentRouteName == 'admin.profile' ? 'active' : '' }}">
                    <a href="{{ route('admin.profile') }}" class="menu-link">
                        <div data-i18n="Profile Setting">Profile Setting</div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>
