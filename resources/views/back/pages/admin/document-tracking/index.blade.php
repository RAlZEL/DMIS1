@extends('back.layouts.admin-pages-layout')

@section ('pageTitle',isset($pageTitle) ? $pageTitle : 'Document Tracking System')


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


@section ('content')

@livewire('admin.document-tracking.index')

@endsection


@push('scripts')

<script>
  
  
window.addEventListener('showAddRouteModal', function(e) {
    $('#add_route').modal('show');
  });

  
  window.addEventListener('hideAddRouteModal', function(e) {
    $('#add_route').modal('hide');
  });

  window.addEventListener('showDeleteModal', function(e) {
    $('#delete_document').modal('show');
  });

  window.addEventListener('hideDeleteDocumentModal', function(e) {
    $('#delete_document').modal('hide');
  });
  
  
  document.getElementById('viewDocument').addEventListener('click', function() {
      alert('You clicked the button!');
    });

  // window.addEventListener('hideDeleteEmployeeModal', function(e) {
  //   $('#delete_employee').modal('hide');
  // });
  

  // window.addEventListener('showDeleteModal', function(e) {
  //   $('#delete_employee').modal('show');
  // });

  // $('#add_employee').on('hidden.bs.modal', function(e) {  
  //   Livewire.emit('resetModalForm');
  // }); 


  

</script>
    
@endpush


