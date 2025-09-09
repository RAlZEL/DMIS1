<div class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
      <div class="navbar navbar-light">
        <div class="container-xl">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('user.FM')}}">
                <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="5 12 3 12 12 3 21 12 19 12"></polyline><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path></svg>
                </span>
                <span class="nav-link-title">
                  Home
                </span>
              </a>
            </li>
            @can ('create',App\Models\FinancialManagement\voucher::class)
            <li class="nav-item">
              
              <a class="nav-link" href="{{ route('user.FMCreateVoucher')}}">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M12 5l0 14"></path>
                  <path d="M5 12l14 0"></path>
               </svg>&nbsp;
                <span class="nav-link-title">
                  Add New Voucher
                </span>
              </a>
            </li>
            @endcan
            @can ('addAccountingTitle',App\Models\FinancialManagement\voucher::class)
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/star -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-category" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M4 4h6v6h-6z"></path>
                    <path d="M14 4h6v6h-6z"></path>
                    <path d="M4 14h6v6h-6z"></path>
                    <path d="M17 17m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                 </svg>                  </span>
                <span class="nav-link-title">
                  Accounting Entry
                </span>
              </a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('user.AccountingTitle') }}" >
                  Account Title
                </a>
                <a class="dropdown-item" href="{{ route('user.AccountingUACS') }}" >
                  UACS
                </a>
              </div>
            </li>
            @endcan
            @can ('createAllocation',App\Models\FinancialManagement\voucher::class)
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="true">
                <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="12 3 20 7.5 20 16.5 12 21 4 16.5 4 7.5 12 3"></polyline><line x1="12" y1="12" x2="20" y2="7.5"></line><line x1="12" y1="12" x2="12" y2="21"></line><line x1="12" y1="12" x2="4" y2="7.5"></line><line x1="16" y1="5.25" x2="8" y2="9.75"></line></svg>
                </span>
                <span class="nav-link-title">
                  Allocation
                </span>
              </a>
              <div class="dropdown-menu" data-bs-popper="none">
                <div class="dropdown-menu-columns">
                  <div class="dropdown-menu-column">
                    <div class="dropend">
                      <a class="dropdown-item dropdown-toggle" href="#sidebar-authentication" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                        GAA
                      </a>
                      <div class="dropdown-menu">
                        <a href="{{ route('user.allocationPAP')}}" class="dropdown-item">PAP</a>
                        <a href="{{ route('user.allocationActivity')}}" class="dropdown-item">Activity</a>
                        <a href="{{ route('user.allocationUACS')}}" class="dropdown-item">UACS</a>
                        <a href="{{ route('user.realignmentUACS')}}" class="dropdown-item">UACS Realignment</a>
                      </div>
                    </div>
                    <div class="dropend">
                      <a class="dropdown-item" href="{{ route('user.saaAllocation') }}" >
                        SAA
                      </a>

                      {{-- <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('admin-panel.box-a') }}" >
                          BOX A 
                        </a>
                        <a class="dropdown-item" href="" >
                          BOX D
                        </a>
                      </div> --}}
                      {{-- <div class="dropdown-menu">
                        <a href="./sign-in.html" class="dropdown-item">PAP / Activity</a>
                        <a href="./forgot-password.html" class="dropdown-item">UACS</a>
                      </div> --}}
                    </div>
                  </div>
                </div>
              </div>
            </li>
              @endcan

              
              @can ('viewAny',App\Models\FinancialManagement\account\accountname::class)
              <li class="nav-item">
                
                <a class="nav-link" href="{{ route('user.FinancialManagementAccount')}}">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                    <path d="M16 19h6"></path>
                    <path d="M19 16v6"></path>
                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4"></path>
                 </svg> &nbsp;
                  <span class="nav-link-title">
                    Add New Account
                  </span>
                </a>
              </li>
              @endcan

              @can ('viewFinancialReport',App\Models\FinancialManagement\voucher::class)
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/star -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-report" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M17 17m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                      <path d="M17 13v4h4"></path>
                      <path d="M12 3v4a1 1 0 0 0 1 1h4"></path>
                      <path d="M11.5 21h-6.5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v2m0 3v4"></path>
                   </svg>                 </span>
                  <span class="nav-link-title">
                    Report
                  </span>
                </a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{ route('user.FinancialPerActivityReport') }}" >
                    Per Activity Report
                  </a>
                  <a class="dropdown-item" href="{{ route('user.AccountingTitle') }}" >
                    Per Payee Report
                  </a>
                  <a class="dropdown-item" href="{{ route('user.FinancialPerPAPReport') }}" >
                    Per PAP Report
                  </a>
                  <a class="dropdown-item" href="{{ route('user.FinancialPerUACSReport') }}" >
                    Per UACS Report
                  </a>
                  <a class="dropdown-item" href="{{ route('user.AccountingTitle') }}" >
                    Financial Tracking Report
                  </a>
                  <a class="dropdown-item" href="{{ route('user.FinancialPerRealignmentReport') }}" >
                    Realignment Report
                  </a>
                  <a class="dropdown-item" href="{{ route('user.AccountingTitle') }}" >
                    FAR-1
                  </a>
                  
                </div>
              </li>
              @endcan
           



          </ul>
        </div>
      </div>
    </div>
  </div>