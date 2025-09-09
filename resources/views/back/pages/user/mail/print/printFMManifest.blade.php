
<!doctype html>

<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <link rel="icon" href="{{asset('images/logo.png')}}" />
    <title>Database Management System | Print Document Traciking Slip</title>



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
                <strong>PENRO - Occidental Mindoro</strong>
            </div>
      </div>
    </div>
    <div class="row">
        <div class="col-12 text-center p-0 bx-solid"> 
               <div>
                  <h4><strong>FINANCIAL MANAGEMENT</strong></h4>
                  <h6><strong>TURN OVER</strong></h6>
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


    <div class="row mt-2">
      <div class="col-12 table-responsive">
        {{-- <div class ="text-center bg-light color-palette">
            <h5>ROUTING AND ACTION INFORMATION</h5>

        </div> --}}
        <table class="table table-stripped">
          <thead>
          <tr class ="">
            <th style="width: 50px;border-bottom: 1px solid black; border-top: 1px solid black;" class="text-center">#</th>
            <th style="width: 200px;border-bottom: 1px solid black; border-top: 1px solid black;">Sequence ID</th>
            <th style="width: 500px;border-bottom: 1px solid black; border-top: 1px solid black;"> Particulars</th>
            <th style="width: 500px;border-bottom: 1px solid black; border-top: 1px solid black;"> Amount</th>
            <th style="width: 500px;border-bottom: 1px solid black; border-top: 1px solid black;"> To</th>
            <th style="width: 200px;border-bottom: 1px solid black; border-top: 1px solid black;">Received By / Date</th>
          </tr>
          </thead>
          <tbody>
            @foreach ($incomingLists as $index => $List)
            <tr>
              <td class="text-center" style="border-bottom: 1px solid black;">{{ $index + 1 }}</td>
              <td style="border-bottom: 1px solid black;">{{ $List[0]}}</td>
              <td style="border-bottom: 1px solid black;">{{ $List[1]}}</td>
              <td style="border-bottom: 1px solid black;">{{ number_format( $List[2],2,'.',',') }}</td>
              <td style="border-bottom: 1px solid black;">{{ $List[3] . ' - ' . $List[4] . ' - ' . $List[5]}}</td>
              <td style="border-bottom: 1px solid black;"></td>
            </tr>
            
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
 
    <div class="card-footer">
      Prepared By: <span> {{ $User->firstname . ' ' . $User->middlename . ' ' . $User->lastname}}</span>
    <span class="float-right"> Date : {{$Date}}</span>
    </div>
    <div class="dropdown-divider"></div>
    <!-- /.row -->
<!-- Page specific script -->
<script>
  window.addEventListener("load", window.print());
</script>
</body>
</html>
