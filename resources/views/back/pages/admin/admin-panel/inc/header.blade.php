<div class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
      <div class="navbar navbar-light">
        <div class="container-xl">
          <ul class="navbar-nav">
            {{-- <li class="nav-item">
                <a class="nav-link text-primary" href="{{ route('admin-panel.home') }}" >
                     Admin Panel
                </a>
            </li> --}}
            
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin-panel.createoffice') }}">
                  <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/file-text -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M3 21l18 0"></path>
                      <path d="M9 8l1 0"></path>
                      <path d="M9 12l1 0"></path>
                      <path d="M9 16l1 0"></path>
                      <path d="M14 8l1 0"></path>
                      <path d="M14 12l1 0"></path>
                      <path d="M14 16l1 0"></path>
                      <path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16"></path>
                   </svg>                  </span>
                  <span class="nav-link-title">
                      Create Office
                  </span>
                </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin-panel.OIC') }}">
                <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/file-text -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-share" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                    <path d="M6 21v-2a4 4 0 0 1 4 -4h3"></path>
                    <path d="M16 22l5 -5"></path>
                    <path d="M21 21.5v-4.5h-4.5"></path>
                 </svg>              </span>
                <span class="nav-link-title">
                    O.I.C.
                </span>
              </a>
          </li>


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
                    Categories
                  </span>
                </a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{ route('admin-panel.officecategory') }}" >
                    Office
                  </a>
                  <a class="dropdown-item" href="{{ route('admin-panel.divisioncategory') }}" >
                    Division
                  </a>
                  <a class="dropdown-item" href="{{ route('admin-panel.unitcategory') }}" >
                    Unit
                  </a>
                </div>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="{{ route('admin-panel.role') }}">
                  <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/file-text -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                      <path d="M6 21v-2a4 4 0 0 1 4 -4h4"></path>
                      <path d="M15 19l2 2l4 -4"></path>
                   </svg>                  </span>
                  <span class="nav-link-title">
                      Roles
                  </span>
                </a>
            </li>

     

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="true">
                <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-coins" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M9 14c0 1.657 2.686 3 6 3s6 -1.343 6 -3s-2.686 -3 -6 -3s-6 1.343 -6 3z"></path>
                    <path d="M9 14v4c0 1.656 2.686 3 6 3s6 -1.344 6 -3v-4"></path>
                    <path d="M3 6c0 1.072 1.144 2.062 3 2.598s4.144 .536 6 0c1.856 -.536 3 -1.526 3 -2.598c0 -1.072 -1.144 -2.062 -3 -2.598s-4.144 -.536 -6 0c-1.856 .536 -3 1.526 -3 2.598z"></path>
                    <path d="M3 6v10c0 .888 .772 1.45 2 2"></path>
                    <path d="M3 11c0 .888 .772 1.45 2 2"></path>
                  </svg>                 </span>
                <span class="nav-link-title">
                  Financial Management
                </span>
              </a>
              <div class="dropdown-menu" data-bs-popper="none">
                <div class="dropdown-menu-columns">
                  <div class="dropdown-menu-column">
                    <div class="dropend">
                      <a class="dropdown-item" href="{{ route('admin-panel.expenseClass') }}" >
                        Expense Class
                      </a>
                    </div>
                    <div class="dropend">
                      <a class="dropdown-item dropdown-toggle" href="#sidebar-error" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                        Office
                      </a>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('admin-panel.fmOffice') }}" >
                          Office 
                        </a>
                        <a class="dropdown-item" href="{{ route('admin-panel.routingOffice') }}" >
                          Routing Office
                        </a>
                      </div>
                    </div>
                    <div class="dropend">
                      <a class="dropdown-item dropdown-toggle" href="#sidebar-error" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                        Signatories
                      </a>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('admin-panel.box-a') }}" >
                          BOX A 
                        </a>
                        <a class="dropdown-item" href="" >
                          BOX D
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            </ul>
        </div>
      </div>
    </div>
  </div>