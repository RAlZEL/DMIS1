<div>
    <header class="navbar navbar-expand-md navbar-light d-print-none">
        <div class="container-xl" style="display: flex; align-items: center;">
          <div style="display: flex; align-items: center; gap: 0.5rem; margin-right: auto;">
            <img src="{{ asset('images/logo.png') }}" width="32" height="32" alt="Logo">
            <!-- <span style="font-size: 1rem; font-weight: 600; color: #2c3e50;">Inventory Management System</span> -->
          </div>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="navbar-nav flex-row" style="margin-left: auto;">
            <a href="{{ route('admin.home') }}" class="nav-link px-0" tabindex="-1">
                <!-- Download SVG icon from http://tabler-icons.io/i/bell -->
                    <i class="fas fa-home"></i>     
            </a>
            <div class="nav-item dropdown d-none d-md-flex me-3">
                
              <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show notifications">
                <!-- Download SVG icon from http://tabler-icons.io/i/bell -->
                    <i class="fas fa-envelope"></i>
                <span class="badge bg-red"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-card">
                <div class="card">
                  <div class="card-body">
                    <div class="header">
                       <h6>Financial Management</h6> 
                    </div> 
                    <div class="dropdown-divider"></div>
                    <div class="header">
                        <h6>Document Tracking<span class="badge bg-red">1</span></h6> 
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="nav-item dropdown">
              <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                <span class="avatar avatar-sm" style="background-image: url({{ asset('/images/user.png')}})"></span>
                <div class="d-none d-xl-block ps-2">
                  <div>{{ $employee->username }}</div>
                  <div class="mt-1 small text-muted">Administrator</div>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                {{-- <a href="#" class="dropdown-item">Set status</a> --}}
                <a href="{{ route('admin.profile') }}" class="dropdown-item">Profile</a>
                {{-- <a href="#" class="dropdown-item">Feedback</a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">Settings</a> --}}
                <a href="{{ route('admin.logout')}}" class="dropdown-item" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                <form action="{{ route('admin.logout') }}" id="logout-form" method="POST"> @csrf </form>
              </div>
            </div>
          </div>
        </div>
      </header>
    
</div>
