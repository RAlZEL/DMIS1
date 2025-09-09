
<!doctype html>

<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <link rel="icon" href="{{asset('images/logo.png')}}" />
    <title>Database Management System | Print Daily Time Record</title>



  {{-- <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> --}}
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href=" {{ asset('dist/css/adminlte.min.css') }}">
</head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-12 text-center p-0"> 
        <img src="{{ asset('images/logo.png') }}" class="brand-image img-circle elevation-3 " style="height: 50px">
        <div>Republic of the Philippines
            </div> 
            <div>
                Department of Environment and Natural Resources
            </div>
            <div>
                <strong> {{ $EmployeeName->Office->office }}</strong>
            </div>
      </div>
    </div>
    <div class="row">
        <div class="col-12 text-center p-0 bx-solid"> 
               <div>
                  <h4><strong>DAILY TIME RECORD</strong></h4>
                
              </div>
        </div>
      </div>
      {{-- <div class="col-9 text-center">
        <h6 class="page-header">
             Republic of the Philippines

      
        </h6>
      </div> --}}
      <!-- /.col -->
    </div>

    
    {{-- <div class="card-footer">
      Prepared By: <span> {{ $User->firstname . ' ' . $User->middlename . ' ' . $User->lastname}}</span>
    <span class="float-right"> Date : {{$Date}}</span>
    </div> --}}
    <div class="dropdown-divider"></div>
    <!-- /.row -->

    <div class="row">

        <div class=col-6>
            <div class="row invoice-info mb-2">
                <div class="col-sm-3 invoice-col text-sm">
                <strong class="text-sm"> Employee No : </strong>
                </div>
                <div class="col-sm-9 invoice-col text-sm">
                {{ $EmployeeName->employeeid }}
                </div>
            </div>
            <div class="row invoice-info mb-2">
                <div class="col-sm-3 invoice-col text-sm">
                <strong class="text-sm"> Employee Name : </strong>
                </div>
                <div class="col-sm-9 invoice-col text-sm">
                {{ $EmployeeName->firstname . ' ' . $EmployeeName->middlename . ' ' . $EmployeeName->lastname}}
                </div>
            </div>
            <div class="row invoice-info mb-2">
                <div class="col-sm-3 invoice-col text-sm">
                <strong class="text-sm"> Date Range : </strong>
                </div>
                <div class="col-sm-9 invoice-col text-sm">
                    {{ $startdate . ' - ' . $enddate }}
                </div>
            </div>
        </div>

        <div class=col-6>
            <div class="row invoice-info mb-2">
                <div class="col-sm-3 invoice-col text-sm">
                <strong class="text-sm"> Status : </strong>
                </div>
                <div class="col-sm-9 invoice-col text-sm">
                {{ $EmployeeName->empstatus }}
                </div>
            </div>
            <div class="row invoice-info mb-2">
                <div class="col-sm-3 invoice-col text-sm">
                <strong class="text-sm"> Office : </strong>
                </div>
                <div class="col-sm-9 invoice-col text-sm">
                {{ $EmployeeName->Office->office }}
                </div>
            </div>
            <div class="row invoice-info mb-2">
                <div class="col-sm-3 invoice-col text-sm">
                <strong class="text-sm"> Schedule : </strong>
                </div>
                <div class="col-sm-9 invoice-col text-sm">
                    FLEXIBLE TIME
                </div>
            </div>
        </div>

    </div>

    <div class="dropdown-divider"></div>
    <div class="row mt-4">
        <div class="col-12 table-responsive">
     
          <table class="table table-bordered">
            <thead>

     
                    <tr> 
                        <th class="text-center text-xs p-1"  rowspan="2" style="vertical-align : middle;text-align:center; width: 80px;border:2px solid #000">DATE</th>
                        <th class="text-center text-xs p-1"  rowspan="2" style="vertical-align : middle;text-align:center; width: 80px;border:2px solid #000">DAY</th>
                        <th class="text-center text-xs p-1" colspan="2" style="border:2px solid #000">MORNING</th>
                        <th class="text-center text-xs p-1" colspan="2" style="border:2px solid #000">AFTERNOON</th>
                        <th class="text-center text-xs p-1" rowspan="2" style="vertical-align : middle;text-align:center;width: 80px;border:2px solid #000">LT</th>
                        <th class="text-center text-xs p-1" rowspan="2" style="vertical-align : middle;text-align:center;width: 80px;border:2px solid #000">UT</th>
                        <th class="text-center text-xs p-1" rowspan="2" style="vertical-align : middle;text-align:center;border:2px solid #000">REMARKS</th>
                    </tr>
                    <tr>
                  
                        <th class="text-center text-xs p-1" style="width: 80px;border:2px solid #000">In</th>
                        <th class="text-center text-xs p-1" style="width: 80px;border:2px solid #000">Out</th>
                        <th class="text-center text-xs p-1" style="width: 80px;border:2px solid #000">In</th>
                        <th class="text-center text-xs p-1" style="width: 80px;border:2px solid #000">Out</th>
                 
                    </tr>
           
            </thead>
            <tbody>
              @foreach($all_dtr as $DTR)
                <tr>
                    <td class="text-center text-xs p-1" style="border:2px solid #000"> {{$DTR[0] }}</td>
                    <td class="text-center text-xs p-1" style="border:2px solid #000"> {{$DTR[8] }}</td>
                    <td class="text-center text-xs p-1" style="border:2px solid #000"> {{$DTR[1] }}</td>
                    <td class="text-center text-xs p-1" style="border:2px solid #000"> {{$DTR[2] }}</td>
                    <td class="text-center text-xs p-1" style="border:2px solid #000"> {{$DTR[3] }}</td>
                    <td class="text-center text-xs p-1" style="border:2px solid #000"> {{$DTR[4] }}</td>
                    <td class="text-center text-xs p-1" style="border:2px solid #000"> {{$DTR[5] }}</td>
                    <td class="text-center text-xs p-1" style="border:2px solid #000"> {{$DTR[6] }}</td>
                    <td class="text-center text-xs p-1" style="border:2px solid #000"> {{$DTR[7] }}</td>
                </tr>
              
              @endforeach
              <tr>
                <td colspan="6" class="text-xs p-1 text-right pr-2" style="border:2px solid #000"> <strong>Total</strong>  </td>
                <td class="text-center text-xs p-1" style="border:2px solid #000"> {{$LatePublish }}</td>
                <td class="text-center text-xs p-1" style="border:2px solid #000"> {{$UndertimePublish }}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>

      <div class="row">
        <div class="col-5">
            <i class="text-xs"> I certify that the entries on this record which where made by myself daily at the time of arrival and departure from office are true and correct.</i>
            <div class=" text-center mt-4">
                <div>
                <strong class="text-center">_______________________________________________  </strong>   
                </div>            
                <div>
                    <strong class="text-xs text-cete"> {{ $EmployeeName->firstname . ' ' . $EmployeeName->middlename . ' ' . $EmployeeName->lastname}}</strong>
                </div>
                <div class="mt-1 text-xs p-1 m-0">
                    Employee
                </div>
            </div>

        </div>
        <div class="col-2"></div>
        <div class="col-5">
            <div>
                <i class="text-xs"> Verified as to the prescribed office hours.</i>
            </div>
            &nbsp;
            &nbsp;    
         
            <div class=" text-center mt-4">
                <div>
                <strong class="text-center">_______________________________________________  </strong>   
                </div> 
                
                   
                 @if($EmployeeName->Office->id == 1 && $EmployeeName->id == 28) 
                 <div>
                    <strong class="text-xs text-cete"> FELIX S. MIRASOL JR., CESO IV</strong>
                </div>
                 
                 @endif
                 
                    @if($EmployeeName->Office->id == 1 && $EmployeeName->id == 19) 
                 <div>
                    <strong class="text-xs text-cete"> ERNESTO E. TANADA</strong>
                </div>
                 
                 @endif

                 @if($EmployeeName->Office->id == 1 && $EmployeeName->id == 1) 
                 <div>
                    <strong class="text-xs text-cete"> ERNESTO E. TANADA</strong>
                </div>
                 
                 @endif
                   
                      @if($EmployeeName->Office->id == 1 && $EmployeeName->id == 9) 
                 <div>
                    <strong class="text-xs text-cete"> ERNESTO E. TANADA</strong>
                </div>
                 
                 @endif
                 
                    @if($EmployeeName->Office->id == 1 && $EmployeeName->id == 16) 
                 <div>
                    <strong class="text-xs text-cete"> ERNESTO E. TANADA</strong>
                </div>
                 
                 @endif
                   
                   
                @if($EmployeeName->Office->id == 1 && $EmployeeName->id != 28 && $EmployeeName->id != 19 && $EmployeeName->id != 9 && $EmployeeName->id != 16)           
                <div>
                    <strong class="text-xs text-cete"> ABE R. FRANCISCO</strong>
                </div>
                @elseif($EmployeeName->Office->id == 2)
                <div>
                  <strong class="text-xs text-cete"> FOR. ANASTACIO A. SANTOS </strong>
              </div>
              @endif

                @if($EmployeeName->Office->id == 1 && $EmployeeName->id == 28) 
                   <div class="mt-1 text-xs p-1 m-0">
                    Regional Executive Director
                </div>
                 
                 @endif
                 
                      @if($EmployeeName->Office->id == 1 && $EmployeeName->id == 19) 
               <div class="mt-1 text-xs p-1 m-0">
                    OIC, PENR Officer
                </div>
                 
                 @endif
                        @if($EmployeeName->Office->id == 1 && $EmployeeName->id == 9) 
               <div class="mt-1 text-xs p-1 m-0">
                    OIC, PENR Officer
                </div>
                 
                 @endif
                
                     @if($EmployeeName->Office->id == 1 && $EmployeeName->id == 16) 
                 <div class="mt-1 text-xs p-1 m-0">
                      OIC, PENR Officer
                  </div>
                   
                   @endif
                 
              @if($EmployeeName->Office->id == 1 && $EmployeeName->id != 28  && $EmployeeName->id != 19 && $EmployeeName->id != 9 && $EmployeeName->id != 16)  
                <div class="mt-1 text-xs p-1 m-0">
                    Chief, Management Services Division
                </div>
                @elseif($EmployeeName->Office->id == 2)
                <div class="mt-1 text-xs p-1 m-0">
                   CENR Officer
              </div>
                @endif
            </div>

        </div>

      </div>

      <div class="mt-4">
        <i class="text-xs"><strong>REMINDER :</strong> Please return within 5 days together with the required supporting documents. (i.e. Special Order, Travel Orders, Notice of Meeting, etc.) </i>
      </div>
<!-- Page specific script -->

<script>
  window.addEventListener("load", window.print());

</script>


</body>
</html>
