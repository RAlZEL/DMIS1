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


      @livewire('user.mail.processing')


@endsection


@push('scripts')


<script>


window.addEventListener('updateProcessingCount', function(e) {
  
  Livewire.emit('updateProcessing');
  });
  window.addEventListener('hideAddRouteModal', function(e) {
    $('#add_route').modal('hide');
  });
  
 
  window.addEventListener('updateIncomingCount', function(e) {
    Livewire.emit('updateIncomingMail');
  });


  window.addEventListener('showCloseAllModal', function(e) {
      $('#close_documents').modal('show');
    });

    window.addEventListener('hideCloseAllModal', function(e) {
      $('#close_documents').modal('hide');
    });
    

    
  window.addEventListener('showAddTaskModal', function(e) {
      $('#add_tasks').modal('show');
    });

    window.addEventListener('hideTaskAllModal', function(e) {
      $('#add_tasks').modal('hide');
    });

    

</script>
    
@endpush


