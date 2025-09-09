@extends('back.layouts.pages-layout')

@section ('pageTitle',isset($pageTitle) ? $pageTitle : 'Home')

@section ('content')

@if (!is_null($Announcements || $Announcements->count() != 0))

<div class="cards">
    <div class="col-sm-12 col-lg-12 mb-2">
        <div class="card card-sm">
          
                <div class="card-header bg-danger">
                    <h5 class="card-title text-white ">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pinned" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M9 4v6l-2 4v2h10v-2l-2 -4v-6"></path>
                            <path d="M12 16l0 5"></path>
                            <path d="M8 4l8 0"></path>
                         </svg> Announcement </h5>
                </div>
                <div class="list-group list-group-flush list-group-hoverable">

                    @forelse ($Announcements as $Announcement)
                    
                        @if($Announcement->office_id == $Employee->officeid || $Announcement->office_id == 0)
                        <div class="list-group-item">
                            
                            <div class="row align-items-center">
                            <!--<div class="col-auto"><span class="badge bg-green"></span></div>-->
                            <div class="col">
                                <small class="d-block text-muted mt-n1">To : <strong> {{ $Announcement->announce_to }}</strong>
                               
                                 <span class="badge bg-success text-xs">  New </span>
                                 
                                 @if($Announcement->id == 4 || $Announcement->id == 5) 
                                    <span class="badge bg-danger text-xs">  Important </span>
                                 @endif
                                 
                                 </small>
                                <small class="d-block text-muted mt-n1">Subject : <strong>{{ $Announcement->subject }}</strong></small>
                                <small class="d-block text-muted mt-n1">Remarks : <strong>{{ $Announcement->remarks }}</strong></small>
                                <small class="d-block text-muted mt-n1 text-sm">Created by : <strong> {{ $Announcement->User->Employee->firstname . ' ' . $Announcement->User->Employee->lastname}}</strong>         <sub class="text-muted"> {{$Announcement->start_date }}</sub> </small>
                       
                            </div>
                            
                            </div>
                        </div>
                        @elseif ($Announcements->count() == 1) 
                        <div class="list-group-item">
                            <div class="row align-items-center">
                              <div class="col-auto"><small class="text-muted text-center"> No Availabe Announcement for the moment.</small></div>
        
                            </div>
                          </div>

                        @endif

                    @empty 
                    <div class="list-group-item">
                        <div class="row align-items-center">
                          <div class="col-auto"><small class="text-muted text-center"> No Availabe Announcement for the moment.</small></div>
    
                        </div>
                      </div>
                    @endforelse
                 
      
                  </div>
            
        </div>
    </div>

</div>
@endif
<div class="row row-cards">



    @can ('viewAny',App\Models\Task\Task::class)
    <div class="col-sm-6 col-lg-4">
        <div class="card card-sm">

            <div class="card-body">
                <div class="d-flex align-items-center">
                    <span class="avatar me-3 rounded" style="background-image: url(./images/task.png)"></span>
                    <div>
                        <div>
                             <a href="{{ route('user.Task')}}" class="text-muted">
                                         <h4> My Task       
                                            @if ($myTaskCount != 0) 
                                            <span class="badge bg-red mx-1 text-xs">  {{ $myTaskCount }} </span>
                                            @endif
                                            @if ($myTaskCountProcessing !=0) 
                                            <span class="badge bg-warning text-xs">  {{ $myTaskCountProcessing }} </span>
                                            @endif</h4></a> </span></h4></a>
                        </div>
                        <div class="text-muted"><i>
                                <h6>List of All My Task(s)</h6>
                            </i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endcan


    <div class="col-sm-6 col-lg-4">
        <div class="card card-sm">

            <div class="card-body">
                <div class="d-flex align-items-center">
                    <span class="avatar me-3 rounded" style="background-image: url(./images/document.png)"></span>
                    <div>
                        <div>
                            <h4> <a href="{{ route('user.MemoCreator')}}" class="text-muted">
                                    Memorandum Creator
                                   <span class="badge bg-warning mx-1 text-xs">  On Going Process </span></a></h4>
                        </div>
                        <div class="text-muted"><i>
                                <h6>-</h6>
                            </i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    @can ('viewAny',App\Models\DocumentTracking\Document::class)
    <div class="col-sm-6 col-lg-4">
        <div class="card card-sm">

            <div class="card-body">
                <div class="d-flex align-items-center">
                    <span class="avatar me-3 rounded" style="background-image: url(./images/document_deliverY.png)"></span>
                    <div>
                        <div>
                            <h4> <a href="{{ route('document-tracking.userhome')}}" class="text-muted">
                                    Document Tracking 
                                    <span class="badge bg-success mx-1 text-xs">  Online </span></a></h4>
                        </div>
                        <div class="text-muted"><i>
                                <h6>List of All Documents (EDATS)</h6>
                            </i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endcan

    @can ('viewAny',App\Models\Admin\EMS\Employee::class)
    <div class="col-sm-6 col-lg-4">
        <div class="card card-sm">

            <div class="card-body">
                <div class="d-flex align-items-center">
                    <span class="avatar me-3 rounded" style="background-image: url(./images/users.png)"></span>
                    <div>
                        <div>
                            <h4> <a href="{{ route('user.EMS')}}" class="text-muted">
                                    Employee Management System 
                                    <span class="badge bg-success mx-1 text-xs">  Online </span></a></h4>
                        </div>
                        <div class="text-muted"><i>
                                <h6>Manage Employees</h6>
                            </i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endcan

   

    @can ('viewAny', App\Models\FinancialManagement\voucher::class)
    <div class="col-sm-6 col-lg-4">
        <div class="card card-sm">

            <div class="card-body">
                <div class="d-flex align-items-center">
                    <span class="avatar me-3 rounded" style="background-image: url(./images/financial.png)"></span>
                    <div>
                        <div>
                            <h4> <a href="{{ route('user.FM')}}" class="text-muted">
                                    Financial Management System
                                    <span class="badge bg-warning mx-1 text-xs">  Trial Version </span></a></h4>
                        </div>
                        <div class="text-muted"><i>
                                <h6>Manage Vouchers</h6>
                            </i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endcan

    {{-- <div class="col-sm-6 col-lg-4">
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
    </div> --}}
    @can('create', App\Models\DTR::class)
    <div class="col-sm-6 col-lg-4">
        <div class="card card-sm">

            <div class="card-body">
                <div class="d-flex align-items-center">
                    <span class="avatar me-3 rounded" style="background-image: url(./images/dtr.png)"></span>
                    <div>
                        <div>
                            <h4> <a href="{{ route('user.dtrHome')}}" class="text-muted">
                                    Daily Time Record Management 
                                    <span class="badge bg-success mx-1 text-xs">  Online </span> </a></h4>
                        </div>
                        <div class="text-muted"><i>
                                <h6>Manage DTR of Employees</h6>
                            </i></div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    @endcan

    @can('viewMyDTR', App\Models\DTR::class)
    <div class="col-sm-6 col-lg-4">
        <div class="card card-sm">

            <div class="card-body">
                <div class="d-flex align-items-center">
                    <span class="avatar me-3 rounded" style="background-image: url(./images/dtr.png)"></span>
                    <div>
                        <div>
                            <h4> <a href="{{ route('user.mydtrHome')}}" class="text-muted">
                                    My Time Record 
                                    <span class="badge bg-success mx-1 text-xs">  Online </span> </a></h4>
                        </div>
                        <div class="text-muted"><i>
                                <h6>List of My Time Record</h6>
                            </i></div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    @endcan

    @can('viewAny', App\Models\Event::class)
    <div class="col-sm-6 col-lg-4">
        <div class="card card-sm">

            <div class="card-body">
                <div class="d-flex align-items-center">
                    <span class="avatar me-3 rounded" style="background-image: url(./images/event.png)"></span>
                    <div>
                        <div>
                            <h4> <a href="{{ route('user.Event')}}" class="text-muted">
                                    Event Management 
                                    <span class="badge bg-success mx-1 text-xs">  Online </span></a></h4>
                        </div>
                        <div class="text-muted"><i>
                                <h6>Events</h6>
                            </i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endcan


    @can('viewAny', App\Models\Announcement::class)
    <div class="col-sm-6 col-lg-4">
        <div class="card card-sm">

            <div class="card-body">
                <div class="d-flex align-items-center">
                    <span class="avatar me-3 rounded" style="background-image: url(./images/megaphone.png)"></span>
                    <div>
                        <div>
                             <a href="{{ route('user.Announcement')}}" class="text-muted">
                                         <h4> Announcements
                                            <span class="badge bg-success mx-1 text-xs">  Online </span></h4></a>
                        </div>
                        <div class="text-muted"><i>
                                <h6>Create and Manage Announcement(s)</h6>
                            </i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endcan
    {{-- <div class="col-sm-6 col-lg-4">
        <div class="card card-sm">

            <div class="card-body">
                <div class="d-flex align-items-center">
                    <span class="avatar me-3 rounded" style="background-image: url(./images/event.png)"></span>
                    <div>
                        <div>
                            <h4> <a href="#" class="text-muted">
                                    Event Management </a></h4>
                        </div>
                        <div class="text-muted"><i>
                                <h6>Events</h6>
                            </i></div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}


    <div class="col-sm-6 col-lg-4">
        <div class="card card-sm">

            <div class="card-body">
                <div class="d-flex align-items-center">
                    <span class="avatar me-3 rounded" style="background-image: url(./images/leave.png)"></span>
                    <div>
                        <div>
                            <h4> <a href="{{ route('user.home') }}" class="text-muted">
                                    My Leave Management 
                                    <span class="badge bg-danger mx-1 text-xs">  Offline </span></a></h4>
                        </div>
                        <div class="text-muted"><i>
                                <h6>List of all My Available Leave</h6>
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
                    <span class="avatar me-3 rounded" style="background-image: url(./images/travelorder.png)"></span>
                    <div>
                        <div>
                            <h4> <a href="{{ route('user.home') }}" class="text-muted">
                                     My Travel Order 
                                     <span class="badge bg-danger mx-1 text-xs">  Offline </span></a></h4>
                        </div>
                        <div class="text-muted"><i>
                                <h6>List of all My Travels</h6>
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
                    <span class="avatar me-3 rounded" style="background-image: url(./images/travelorder.png)"></span>
                    <div>
                        <div>
                            <h4> <a href="" class="text-muted">
                                      Travel Order Management
                                      <span class="badge bg-danger mx-1 text-xs">  Offline </span></a></h4>
                        </div>
                        <div class="text-muted"><i>
                                <h6>Manage Travels of All Employees</h6>
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
                    <span class="avatar me-3 rounded" style="background-image: url(./images/payslip.png)"></span>
                    <div>
                        <div>
                            <h4> <a href="" class="text-muted">
                                      My Payslip
                                      <span class="badge bg-danger mx-1 text-xs">  Offline </span></a></h4>
                        </div>
                        <div class="text-muted"><i>
                                <h6>My Payslip</h6>
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
                            <h4> <a href="{{ route('user.home') }}" class="text-muted">
                                    Service Request(s)
                                    <span class="badge bg-danger mx-1 text-xs">  Offline </span> </a></h4>
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
                            <h4> <a href="{{ route('user.IM') }}" class="text-muted">
                                    Inventory Management System
                                    <span class="badge bg-danger mx-1 text-xs">Offline</span></a></h4>
                        </div>
                        <div class="text-muted"><i>
                                <h6>Inventory Management</h6>
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
                            <h4> <a href="{{ route('user.home') }}" class="text-muted">
                                    My Property
                                    <span class="badge bg-danger mx-1 text-xs">  Offline </span> </a></h4>
                        </div>
                        <div class="text-muted"><i>
                                <h6>List of all my Property</h6>
                            </i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @can ('viewAny',App\Models\DocumentTracking\Document::class)
    <div class="col-sm-6 col-lg-4">
        <div class="card card-sm">

            <div class="card-body">
                <div class="d-flex align-items-center">
                    <span class="avatar me-3 rounded" style="background-image: url(./images/mail.png)"></span>
                    <div>
                        <div>
                            <h4> <a href="{{ route('mail.userMail')}}" class="text-muted">
                                    My Mail </a></h4>
                        </div>
                        <div class="text-muted"><i>
                                <h6>All Messages</h6>
                            </i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endcan
    {{-- <div class="col-sm-6 col-lg-4">
        <div class="card card-sm">

            <div class="card-body">
                <div class="d-flex align-items-center">
                    <span class="avatar me-3 rounded" style="background-image: url(./images/admin.png)"></span>
                    <div>
                        <div>
                            <h4> <a href="#" class="text-muted">
                                    Admin Panel </a></h4>
                        </div>
                        <div class="text-muted"><i>
                                <h6>Administrative Role Only</h6>
                            </i></div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</div>


@endsection


@section ('pageTitle')

<div class="page-header d-print-none">
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title">
                Main Menu
            </h2>
        </div>
    </div>
</div>

@endsection
