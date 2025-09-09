@extends('back.layouts.admin-pages-layout')

@section ('pageTitle',isset($pageTitle) ? $pageTitle : 'Home')

@section ('content')


<div class="row row-cards">
    <div class="col-sm-6 col-lg-4">
        <div class="card card-sm">

            <div class="card-body">
                <div class="d-flex align-items-center">
                    <span class="avatar me-3 rounded" style="background-image: url(./images/users.png)"></span>
                    <div>
                        <div>
                            <h4> <a href="{{ route('admin.EMS')}}" class="text-muted">
                                    Employee Management </a></h4>
                        </div>
                        <div class="text-muted"><i>
                                <h6>List of All Employees</h6>
                            </i></div>
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
                                <h4> <a href="{{ route('admin.UMS')}}" class="text-muted">
                                    User Management
                                </a>
                            </h4>
                        </div>
                        <div class="text-muted"><i>
                                <h6>List of All Users </h6>
                            </i></div>
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
                        <div>
                            <h4> <a href="{{ route('admin.documentTracking')}}" class="text-muted">
                                    Document Tracking </a></h4>
                        </div>
                        <div class="text-muted"><i>
                                <h6>List of All Documents (EDATS)</h6>
                            </i></div>
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
                        <div>
                            <h4> <a href="{{ route('admin.financialManagement')}}" class="text-muted">
                                    Financial Management </a></h4>
                        </div>
                        <div class="text-muted"><i>
                                <h6>List of All Vouchers</h6>
                            </i></div>
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
                        <div>
                            <h4> <a href="#" class="text-muted">
                                    Leave Management </a></h4>
                        </div>
                        <div class="text-muted"><i>
                                <h6>List of all Available Leave</h6>
                            </i></div>
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
                        <div>
                            <h4> <a href="{{ route('user.dtrHome')}}" class="text-muted">
                                    Daily Time Record </a></h4>
                        </div>
                        <div class="text-muted"><i>
                                <h6>DTR Details</h6>
                            </i></div>
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
                        <div>
                            <h4> <a href="{{ route('user.Event')}}" class="text-muted">
                                    Event Management </a></h4>
                        </div>
                        <div class="text-muted"><i>
                                <h6>Events</h6>
                            </i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-sm-6 col-lg-4">
        <div class="card card-sm">

            <div class="card-body">
                <div class="d-flex align-items-center">
                    <span class="avatar me-3 rounded" style="background-image: url(./images/mail.png)"></span>
                    <div>
                        <div>
                            <h4> <a href="#" class="text-muted">
                                    My Mail </a></h4>
                        </div>
                        <div class="text-muted"><i>
                                <h6>Request(s)</h6>
                            </i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-4">
        <div class="card card-sm">

            <div class="card-body">
                <div class="d-flex align-items-center">
                    <span class="avatar me-3 rounded" style="background-image: url(./images/service_request.png)"></span>
                    <div>
                        <div>
                            <h4> <a href="#" class="text-muted">
                                    Service Request(s) </a></h4>
                        </div>
                        <div class="text-muted"><i>
                                <h6>Request(s) for Techincal Service</h6>
                            </i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    
    <div class="col-sm-6 col-lg-4">
        <div class="card card-sm">

            <div class="card-body">
                <div class="d-flex align-items-center">
                    <span class="avatar me-3 rounded" style="background-image: url(./images/inventory_request.png)"></span>
                    <div>
                        <div>
                            <h4> <a href="#" class="text-muted">
                                    Inventory Request(s) </a></h4>
                        </div>
                        <div class="text-muted"><i>
                                <h6>Request(s) for Inventory</h6>
                            </i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-4">
        <div class="card card-sm">

            <div class="card-body">
                <div class="d-flex align-items-center">
                    <span class="avatar me-3 rounded" style="background-image: url(./images/inventory.png)"></span>
                    <div>
                        <div>
                            <h4> <a href="#" class="text-muted">
                                    Inventory Management </a></h4>
                        </div>
                        <div class="text-muted"><i>
                                <h6>List of All Inventory and Request(s)</h6>
                            </i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-4">
        <div class="card card-sm">

            <div class="card-body">
                <div class="d-flex align-items-center">
                    <span class="avatar me-3 rounded" style="background-image: url(./images/maintenance.png)"></span>
                    <div>
                        <div>
                            <h4> <a href="#" class="text-muted">
                                    Service Manamagement </a></h4>
                        </div>
                        <div class="text-muted"><i>
                                <h6>List of all Service Request(s)</h6>
                            </i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    
    <div class="col-sm-6 col-lg-4">
        <div class="card card-sm">

            <div class="card-body">
                <div class="d-flex align-items-center">
                    <span class="avatar me-3 rounded" style="background-image: url(./images/mr.png)"></span>
                    <div>
                        <div>
                            <h4> <a href="#" class="text-muted">
                                    My MR </a></h4>
                        </div>
                        <div class="text-muted"><i>
                                <h6>My Property</h6>
                            </i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-sm-6 col-lg-4">
        <div class="card card-sm">

            <div class="card-body">
                <div class="d-flex align-items-center">
                    <span class="avatar me-3 rounded" style="background-image: url(./images/mr.png)"></span>
                    <div>
                        <div>
                            <h4> <a href="#" class="text-muted">
                                    MR Management </a></h4>
                        </div>
                        <div class="text-muted"><i>
                                <h6>Lkst of All Property</h6>
                            </i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="dropdown-divider mt-4"></div>
    <label class="form-label">Settings</label>

    <div class="col-sm-6 col-lg-4">
        <div class="card card-sm">

            <div class="card-body">
                <div class="d-flex align-items-center">
                    <span class="avatar me-3 rounded" style="background-image: url(./images/admin.png)"></span>
                    <div>
                        <div>
                            <h4> <a href="{{ route('admin-panel.home') }}" class="text-muted">
                                    Admin Panel </a></h4>
                        </div>
                        <div class="text-muted"><i>
                                <h6>Administrative Role Only</h6>
                            </i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>


@endsection


