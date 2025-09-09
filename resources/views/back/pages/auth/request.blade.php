@extends('back.layouts.auth-layout')

@section ('pageTitle',isset($pageTitle) ? $pageTitle : 'Request an Account')

@section ('content')

<div class="page page-center">
    <div class="container-tight py-4">
   
      <form class="card card-md" action="." method="get">
        <div class="card-body">
            <div class="text-center mb-4">
                <a href="." class="navbar-brand navbar-brand-autodark"><img src="./images/logo.png" height="36" alt=""></a>
                <h5>DENR Database Management System</h5>
              </div>
              <div class="dropdown-divider"></div>
          <h2 class="card-title text-center mb-4">Request an Account</h2>
          <p class="text-muted mb-4">Enter your Account Details and request will be sent to the Management Services Division for Verification.</p>
          <div class="mb-3">
            <label class="form-label">Email address</label>
            <input type="email" class="form-control" placeholder="Enter email">
          </div>
          <div class="mb-3">
            <label class="form-label">Employee Name</label>
            <input type="employee_name" class="form-control" placeholder="Enter Employee Name">
          </div>
          <div class="mb-3">
            <label class="form-label">Office / Unit Assigned</label>
            <input type="office_id" class="form-control" placeholder="Enter Office / Unit Assigned">
          </div>
          <div class="mb-3">
            <label class="form-label">Phone Number</label>
            <input type="number" class="form-control" placeholder="Enter Phone Number">
          </div>
          <div class="form-footer">
            <a href="#" class="btn btn-primary w-100">
              <!-- Download SVG icon from http://tabler-icons.io/i/mail -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="3" y="5" width="18" height="14" rx="2"></rect><polyline points="3 7 12 13 21 7"></polyline></svg>
              Request an Account
            </a>
          </div>
        </div>
      </form>
      <div class="text-center text-muted mt-3">
        Forget it, <a href="{{ route('user.login')}}">send me back</a> to the sign in screen.
      </div>
    </div>
  </div>

@endsection