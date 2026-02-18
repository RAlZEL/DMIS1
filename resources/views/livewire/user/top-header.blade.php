<div>
    <header class="navbar navbar-expand-md navbar-light d-print-none">
        <div class="container-xl">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
          </button>
          <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href="{{ route('user.home')}}">
              <img src="{{ asset('images/logo.png') }}" width="110" height="32" alt="Tabler" class="navbar-brand-image">
            </a>
          </h1>
          <div class="navbar-nav flex-row order-md-last">
            <a href="{{ route('user.home') }}" class="nav-link px-0" tabindex="-1">
                <!-- Download SVG icon from http://tabler-icons.io/i/bell -->
                    <i class="fas fa-home"></i>     
            </a>
            {{-- Show mail icon everywhere except on Admin Inventory pages --}}
            @if(! request()->routeIs('admin-panel.IM')
                && ! request()->routeIs('admin-panel.IMCreateProperty')
                && ! request()->routeIs('admin-panel.InventoryManagementArticle')
                && ! request()->routeIs('admin-panel.inventoryPrint')
                && ! request()->routeIs('admin-panel.inventoryPrintPage'))
            <div class="nav-item dropdown ">
              <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show notifications">
                <i class="fas fa-envelope"></i>
                @if ($incomingCount != 0 || $incomingCountFM !=0)
                  <span class="badge bg-red"></span>
                @endif
              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-card" wire:ignore>
                <div class="card">
                  <div class="card-body">
                    @can('viewMail', App\Models\FinancialManagement\voucher::class)
                    <div class="header">
                      <a href="{{ route('mail.FMMail')}}">
                        <h6>Financial Management  
                          @if ($incomingCountFM != 0)
                          <span class="badge bg-red" wire:poll.visible>  {{ $incomingCountFM }} </span>
                          @endif
                        </h6>
                      </a>
                    </div>
                    <div class="dropdown-divider"></div>
                    @endcan
                    <div class="header">
                      <a href="{{ route('mail.userMail')}}">
                        <h6>Document Tracking  
                          @if ($incomingCount != 0)
                          <span class="badge bg-red mx-2" wire:poll.visible>  {{ $incomingCount }} </span>
                          @endif
                        </h6>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endif
            <div class="nav-item dropdown">
              <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                <span class="avatar avatar-sm" style="background-image: url({{ asset('/images/user.png')}})"></span>
                <div class="d-none d-xl-block ps-2">
                  <div>{{ $User->username }}</div>
                  <div class="mt-1 small text-muted">{{ $employee->position }}</div>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                {{-- <a href="#" class="dropdown-item">Set status</a> --}}
                <a href="{{ route('user.profile') }}" class="dropdown-item">My Profile</a>
                {{-- <a href="#" class="dropdown-item">Feedback</a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">Settings</a> --}}
                <a href="{{ route('user.logout')}}" class="dropdown-item" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                <form action="{{ route('user.logout') }}" id="logout-form" method="POST"> @csrf </form>
              </div>
            </div>
          </div>
        </div>
      </header>
</div>
