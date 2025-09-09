
<!doctype html>

<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Database Management System</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <!-- CSS files -->
    <link rel="stylesheet" href=" {{ asset('dist/css/tabler.min.css') }}">
    <link rel="stylesheet" href=" {{ asset('dist/css/tabler-flags.min.css') }}">
    <link rel="stylesheet" href=" {{ asset('dist/css/tabler-payments.min.css') }}">
    <link rel="stylesheet" href=" {{ asset('dist/css/tabler-vendors.min.css') }}">

  </head>
  <body >
    <div class="wrapper">
      <header class="navbar navbar-expand-md navbar-light d-print-none">
        <div class="container-xl">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
          </button>
          <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href=".">
              <img src="{{ asset('images/logo.png') }}" width="110" height="32" alt="Tabler" class="navbar-brand-image">
            </a>
          </h1>
          <div class="navbar-nav flex-row order-md-last">
            <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show notifications">
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
                        <h6>Document Tracking      <span class="badge bg-red">1</span></h6> 
                  
                     </div> 
                  </div>
                </div>
              </div>
            </div>
            <div class="nav-item dropdown">
              <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                <span class="avatar avatar-sm" style="background-image: url(./images/user.png)"></span>
                <div class="d-none d-xl-block ps-2">
                  <div>Kristoffer Kney</div>
                  <div class="mt-1 small text-muted">Developer</div>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <a href="#" class="dropdown-item">Set status</a>
                <a href="#" class="dropdown-item">Profile & account</a>
                <a href="#" class="dropdown-item">Feedback</a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">Settings</a>
                <a href="#" class="dropdown-item">Logout</a>
              </div>
            </div>
          </div>
        </div>
      </header>
      {{-- <div class="navbar-expand-md">
        <div class="collapse navbar-collapse" id="navbar-menu">
          <div class="navbar navbar-light">
            <div class="container-xl">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" href="./index.html" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                 
                    </span>
                    <span class="nav-link-title">
                      Home
                    </span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div> --}}
      <div class="page-wrapper">
        <div class="container-xl">
          <!-- Page title -->
          <div class="page-header d-print-none">
            <div class="row align-items-center">
              <div class="col">
                <h2 class="page-title">
                  Main Menu
                </h2>
              </div>
            </div>
          </div>
        </div>
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                  <div class="col-sm-6 col-lg-4">
                    <div class="card card-sm">
                
                      <div class="card-body">
                        <div class="d-flex align-items-center">
                          <span class="avatar me-3 rounded" style="background-image: url(./images/users.png)"></span>
                          <div>
                            <div><h4>     <a href="#" class="text-muted">
                                Employee Management </a></h4></div>
                            <div class="text-muted"><i><h6>List of All Employees</h6></i></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
           
                <div class="col-sm-6 col-lg-4">
                    <div class="card card-sm">

                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                <span class="avatar me-3 rounded" style="background-image: url(./images/users.png)"></span>
                                <div>
                                    <div>
                                        <h4>
                                            <a href="#" class="text-muted">
                                            User Management 
                                            </a>
                                        </h4>
                                    </div>
                                    <div class="text-muted"><i><h6>List of All Users </h6></i></div>
                                </div>
                                </div>
                            </div>

                    </div>
                </div>
            


                  
                  <div class="col-sm-6 col-lg-4">
                    <div class="card card-sm">
                
                      <div class="card-body">
                        <div class="d-flex align-items-center">
                          <span class="avatar me-3 rounded" style="background-image: url(./images/document.png)"></span>
                          <div>
                            <div><h4>     <a href="#" class="text-muted">
                                Document Tracking </a></h4></div>
                            <div class="text-muted"><i><h6>List of All Documents (EDATS)</h6></i></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-6 col-lg-4">
                    <div class="card card-sm">
                
                      <div class="card-body">
                        <div class="d-flex align-items-center">
                          <span class="avatar me-3 rounded" style="background-image: url(./images/financial.png)"></span>
                          <div>
                            <div><h4>     <a href="#" class="text-muted">
                                Financial Management </a></h4></div>
                            <div class="text-muted"><i><h6>List of All Vouchers</h6></i></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-6 col-lg-4">
                    <div class="card card-sm">
                
                      <div class="card-body">
                        <div class="d-flex align-items-center">
                          <span class="avatar me-3 rounded" style="background-image: url(./images/leave.png)"></span>
                          <div>
                            <div><h4>     <a href="#" class="text-muted">
                                Leave Management </a></h4></div>
                            <div class="text-muted"><i><h6>List of all Available Leave</h6></i></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-6 col-lg-4">
                    <div class="card card-sm">
                
                      <div class="card-body">
                        <div class="d-flex align-items-center">
                          <span class="avatar me-3 rounded" style="background-image: url(./images/dtr.png)"></span>
                          <div>
                            <div><h4>     <a href="#" class="text-muted">
                                Daily Time Record </a></h4></div>
                            <div class="text-muted"><i><h6>DTR Details</h6></i></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-6 col-lg-4">
                    <div class="card card-sm">
                
                      <div class="card-body">
                        <div class="d-flex align-items-center">
                          <span class="avatar me-3 rounded" style="background-image: url(./images/event.png)"></span>
                          <div>
                            <div><h4>     <a href="#" class="text-muted">
                                Event Management </a></h4></div>
                            <div class="text-muted"><i><h6>Events</h6></i></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-6 col-lg-4">
                    <div class="card card-sm">
                
                      <div class="card-body">
                        <div class="d-flex align-items-center">
                          <span class="avatar me-3 rounded" style="background-image: url(./images/admin.png)"></span>
                          <div>
                            <div><h4>     <a href="#" class="text-muted">
                                Admin Panel </a></h4></div>
                            <div class="text-muted"><i><h6>Administrative Role Only</h6></i></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>


                </div>
              </div>

              

            </div>
        </div>
        <footer class="footer footer-transparent d-print-none">
          <div class="container-xl">
            <div class="row text-center align-items-center flex-row-reverse">
              <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                <ul class="list-inline list-inline-dots mb-0">
                  <li class="list-inline-item">
                    Copyright &copy; 2022
                    <a href="#" class="link-secondary">YourCompany</a>.
                    All rights reserved.
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->

    <!-- SweetAlert2 -->
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('dist/js/tabler.min.js') }}"></script>
    <script src="{{ asset('/dist/js/demo.min.js') }}"></script>
  </body>
</html>