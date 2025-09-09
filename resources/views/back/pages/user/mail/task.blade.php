@extends('back.layouts.pages-layout')

@section ('pageTitle',isset($pageTitle) ? $pageTitle : 'Mail Management System')


@section ('pageSubTitle')



<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            Mail Management System
          </h2>
        </div>
      </div>
    </div>
  </div>



@endsection


@section ('content')


      @livewire('user.mail.task')


@endsection


@push('scripts')


<script>


// window.addEventListener('updateRejectedCount', function(e) {
  
//   Livewire.emit('updateRejected');
//   });
//   window.addEventListener('hideAddRouteModal', function(e) {
//     $('#add_route').modal('hide');
//   });
  
 
//   window.addEventListener('updateIncomingCount', function(e) {
//     Livewire.emit('updateIncomingMail');
//   });


</script>
    
@endpush


