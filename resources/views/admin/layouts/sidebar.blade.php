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
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('assets/admin/theme/img/logo/logo.png') }}" alt="Company Logo">
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
        <li class="menu-item {{ $currentRouteName == 'admin.profile' ? 'active' : '' }}">
            <a href="{{ route('admin.profile') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-user-circle"></i>
                <div data-i18n="User Profile">User Profile</div>
            </a>
        </li>
        <!-- Users -->
        <li class="menu-item {{ $currentRouteName == 'admin.users' ? 'active' : '' }}">
            <a href="{{ route('admin.users') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-group"></i>
                <div data-i18n="Users">Users</div>
            </a>
        </li>
    </ul>
</aside>


{{-- <li class="menu-item">
    <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bxs-image"></i>
        <div data-i18n="Layouts">Banner</div>
    </a>

    <ul class="menu-sub">
        <li class="menu-item {{ $currentRouteName == 'admin.banner_category' ? 'active' : '' }}">
            <a href="{{ route('admin.banner_category') }}" class="menu-link">
                <div>Banner Category</div>
            </a>
        </li>
    </ul>

    <ul class="menu-sub">
        <li class="menu-item {{ $currentRouteName == 'admin.banner' ? 'active' : '' }}">
            <a href="{{ route('admin.banner') }}" class="menu-link">
                <div data-i18n="Basic">Banner</div>
            </a>
        </li>
    </ul>
</li> --}}
