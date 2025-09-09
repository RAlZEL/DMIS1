@extends('back.layouts.pages-layout')

@section ('pageTitle',isset($pageTitle) ? $pageTitle : 'View')


@section ('pageSubTitle')



<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            Document Tracking System
          </h2>
        </div>
      </div>
    </div>
  </div>



@endsection



@section ('pageHeader')

@include('back.pages.user.document-tracking.inc.header')

@endsection

@section ('content')

      @livewire('user.document-tracking.view', ['id' => $id])


@endsection


@push('scripts')

<script>
  

  window.addEventListener('hideAddAttachmentModal', function(e) {
    $('#add_attachment').modal('hide');
 
  });

  
  window.addEventListener('hideUpdateDocumentModal', function(e) {
    $('#edit_document').modal('hide');
 
  });

  window.addEventListener('hideAddRouteModal', function(e) {
    $('#add_route').modal('hide');
  });

  window.addEventListener('hideCloseModal', function(e) {
    $('#close_document').modal('hide');
  });

  window.addEventListener('hideAcceptModal', function(e) {
    $('#accept_document').modal('hide');
  });

  window.addEventListener('hideRejectModal', function(e) {
    $('#reject_document').modal('hide');
  });
  
  window.addEventListener('hideTaskModal', function(e) {
    $('#add_task').modal('hide');
  });
  


 
  window.addEventListener('updateIncomingCount', function(e) {
    Livewire.emit('updateIncomingMail');
  });

  
  window.addEventListener('updateRoute', function(e) {
    Livewire.emit('updateRouteList');
  });

  window.addEventListener('updateComment', function(e) {
    Livewire.emit('updateCommentLists');
  });
  

  window.addEventListener('updateAttachment', function(e) {
    Livewire.emit('updateAttachmentList');
 
  });
  $('#add_attachment').on('hidden.bs.modal', function(e) {  
    Livewire.emit('resetModalFormAttachment');
  }); 

    window.addEventListener('hideDeleteAttachmentModal', function(e) {
      $('#delete_attachment').modal('hide');
    });
    
    window.addEventListener('hideCommentModal', function(e) {
      $('#add_comment').modal('hide');
    });
    

    window.addEventListener('showDeleteModal', function(e) {
      $('#delete_attachment').modal('show');
    });
    window.addEventListener('showCommentModal', function(e) {
      $('#add_comment').modal('show');
    });
    

  
</script>
    
@endpush


