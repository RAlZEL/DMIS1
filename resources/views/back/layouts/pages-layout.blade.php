
<!doctype html>

<html lang="en">
  <head>

    <meta name="theme-color" content="#6777ef"/>
  <link rel="apple-touch-icon" href="{{asset('images/logo.png')}}">
  <link rel="manifest" href="{{ asset('/manifest.json') }}">

    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <link rel="icon" href="{{asset('images/logo.png')}}" />
    <title>Database Management System | @yield('pageTitle')</title>


    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Font Awesome Kit -->
    <script src="https://kit.fontawesome.com/6710dd5e53.js" crossorigin="anonymous"></script>
    
    <base href="/">
    <!-- SweetAlert2 -->
    {{-- <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}"> --}}
    <!-- CSS files -->
    <link rel="stylesheet" href=" {{ asset('dist/css/tabler.min.css') }}">
    <link rel="stylesheet" href=" {{ asset('dist/css/tabler-flags.min.css') }}">
    <link rel="stylesheet" href=" {{ asset('dist/css/tabler-payments.min.css') }}">
    <link rel="stylesheet" href=" {{ asset('dist/css/tabler-vendors.min.css') }}">
    <link rel="stylesheet" href=" {{ asset('dist/libs/ijabo/ijabo.min.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
   


    @stack('stylesheets')
    @livewireStyles

  </head>
  <body >
    <div class="wrapper">

      @include('back.layouts.inc.header')

        <div class="page-wrapper">
         
          @yield('pageHeader')
          @yield('pageSubTitle')
            <div class="container-xl m-2">
          <!-- Page title -->
     
            </div>
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

    <!-- SweetAlert2 -->
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset ('dist/libs/ijabo/ijabo.min.js') }}"></script>
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
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
       <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('69f9aeb4fad8621cf5bd', {
          cluster: 'ap1'
        });

        var channel = pusher.subscribe('user-login');
        channel.bind('login-user', function(data) {
          // toastr.success(event.detail.message); 
          // Livewire.emit('resetModalForm');
          toastr.success(data.username + ' has joined our website.');
          // alert(JSON.stringify(data));
        });
      </script>

    <script src="{{ asset('/dist/js/demo.min.js') }}"></script>
    <script src="{{ asset('/sw.js') }}"></script>
    <script>
    if (!navigator.serviceWorker.controller) {
        navigator.serviceWorker.register("/sw.js").then(function (reg) {
            console.log("Service worker has been registered for scope: " + reg.scope);
        });
    }
    </script>

  </body>
</html>