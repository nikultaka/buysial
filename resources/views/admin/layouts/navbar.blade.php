<nav class="container-xxl navbar navbar-expand-xl align-items-center" id="layout-navbar">
  <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
      <i class="bx bx-menu bx-sm"></i>
    </a>
  </div>
      @php
        $user = Auth::user();
      @endphp
      <ul class="navbar-nav flex-row align-items-center ms-auto">
      <li class="nav-item navbar-dropdown dropdown-user dropdown">
        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
          <div class="avatar avatar-online bg-dark rounded-circle">
            @if ($user->logo && file_exists(public_path($user->logo)))
                  <img src="{{ asset($user->logo) }}" style="object-fit: cover" alt="User Logo" class="">
              @else
                  <img src="{{ asset('assets/admin/theme/img/1.png') }}" alt="" class="w-px-40 h-auto rounded-circle">
              @endif
          </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
          <li>
            <a class="dropdown-item" href="#">
              <div class="d-flex">
                <div class="flex-shrink-0 me-3">
                  <div class="avatar avatar-online bg-dark rounded-circle">
                    <div class="avatar avatar-online bg-dark rounded-circle">
                        @if ($user->logo && file_exists(public_path($user->logo)))
                            <img src="{{ asset($user->logo) }}" style="object-fit: cover" alt="User Logo" class="">
                        @else
                            <img src="{{ asset('assets/admin/theme/img/1.png') }}" alt="" class="w-px-40 h-auto rounded-circle">
                        @endif
                    </div>
                  </div>
                </div>
               
                <div class="flex-grow-1">
                  <span class="fw-semibold d-block">{{ isset($user->name) ? $user->name : "" }}</span>
                  <small class="text-muted">{{ isset($user->role) ? $user->role : "User" }}</small>
                </div>
              </div>
            </a>
          </li>
          <li>
            <div class="dropdown-divider"></div>
          </li>
          <li>
            <div class="dropdown-divider"></div>
          </li>
          <li>
            <a class="dropdown-item" href="{{ route('admin.logout') }}">
              <i class="bx bx-power-off me-2"></i>
              <span class="align-middle">Log Out</span>
            </a>
          </li>
        </ul>
      </li>
      <!--/ User -->
    </ul>
</nav>
