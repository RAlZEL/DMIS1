@extends('back.layouts.pages-layout')

@section ('pageTitle',isset($pageTitle) ? $pageTitle : 'Mail Management System - Document Tracking System')


@section ('pageSubTitle')



<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            Mail Management System - Document Tracking System
          </h2>
        </div>
      </div>
    </div>
  </div>



@endsection


@section ('content')


      @livewire('user.mail.index')


@endsection


@push('scripts')


<script>


window.addEventListener('updateIncomingCount', function(e) {
  
  Livewire.emit('updateIncoming');
  });

  window.addEventListener('showAcceptAllModal', function(e) {
      $('#accept_documents').modal('show');
    });

    window.addEventListener('hideAcceptAllModal', function(e) {
      $('#accept_documents').modal('hide');
    });
    
    window.addEventListener('showRejectAllModal', function(e) {
      $('#reject_documents').modal('show');
    });

    window.addEventListener('hideRejectAllModal', function(e) {
      $('#reject_documents').modal('hide');
    });
    
</script>
    
@endpush


