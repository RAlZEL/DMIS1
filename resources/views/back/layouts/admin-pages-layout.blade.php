
<!doctype html>

<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <link rel="icon" href="{{asset('images/logo.png')}}" />
    <title>Database Management System | @yield('pageTitle')</title>


    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <base href="/">
    {{-- <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Toastr -->
    
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}"> --}}
    <!-- CSS files -->
    <link rel="stylesheet" href=" {{ asset('dist/css/tabler.min.css') }}">
    <link rel="stylesheet" href=" {{ asset('dist/css/tabler-flags.min.css') }}">
    <link rel="stylesheet" href=" {{ asset('dist/css/tabler-payments.min.css') }}">
    <link rel="stylesheet" href=" {{ asset('dist/css/tabler-vendors.min.css') }}">
    <link rel="stylesheet" href=" {{ asset('dist/libs/ijabo/ijabo.min.css') }}">
    @stack('stylesheets')
    @stack('styles')
    @livewireStyles

  </head>
  <body >
    <div class="wrapper">
    
        @include('back.layouts.inc.admin.header')

        <div class="page-wrapper">
         
          @yield('pageHeader')
          @yield('pageSubTitle')
            <div class="page-body">
                <div class="container-xl">

                @yield('content')

                </div>
            </div>
        </div>
        @include('back.layouts.inc.footer')
      </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <!-- jQuery -->

    <script src="{{ asset ('dist/libs/jquery/jquery-3.6.0.min.js') }}"></script>

    <script src="{{ asset ('dist/libs/ijabo/ijabo.min.js') }}"></script>

    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/js/tabler.min.js') }}"></script>
    @stack('scripts')
    @livewireScripts
    <script>
      window.addEventListener('showToastr', function(){
        if(event.detail.type === 'info') {
          toastr.info(event.detail.message);
        }else if(event.detail.type === 'success') {
          toastr.success(event.detail.message); 
        }else if(event.detail.type === 'error') {
          toastr.error(event.detail.message); 
        }else if(event.detail.type === 'warning') {
          toastr.warning(event.detail.message); 
        }else {
          return false;
        }

      });
    </script>
    <script src="{{ asset('/dist/js/demo.min.js') }}"></script>
  </body>
</html>
