@extends('back.layouts.pages-layout')

@section ('pageTitle',isset($pageTitle) ? $pageTitle : 'Task Management System')


@section ('pageSubTitle')



<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            Task Management System
          </h2>
        </div>
      </div>
    </div>
  </div>



@endsection


@section ('content')


      @livewire('user.task.index')


@endsection


@push('scripts')



  <script>
        
        
    window.addEventListener('updateComment', function(e) {
    Livewire.emit('updateCommentLists');
   });
  

   window.addEventListener('updateCreateCount', function(e) {
    Livewire.emit('updateCountCreate');
   });


    window.addEventListener('showAcceptTask', function(e) {
    $('#accept_task').modal('show');
    });

    window.addEventListener('showRejectTask', function(e) {
    $('#reject_task').modal('show');
    });


    window.addEventListener('showUpdateTask', function(e) {
    $('#update_task').modal('show');
    });

    
    window.addEventListener('hideUpdateModal', function(e) {
    $('#update_task').modal('hide');
    });
    
    window.addEventListener('hideAcceptModal', function(e) {
    $('#accept_task').modal('hide');
    });

    window.addEventListener('hideTaskModal', function(e) {
    $('#add_task').modal('hide');
    });
    
    window.addEventListener('hideRejectModal', function(e) {
    $('#reject_task').modal('hide');
    });

    window.addEventListener('showAddComment', function(e) {
    $('#add_comment').modal('show');
    });
    
    


  </script>
    
@endpush



