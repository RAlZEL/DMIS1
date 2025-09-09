@extends('back.layouts.pages-layout')

@section ('pageTitle',isset($pageTitle) ? $pageTitle : 'Financial Management System')


@section ('pageSubTitle')



<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            P/A/P (Programs / Activities / Projects)
          </h2>
        </div>
      </div>
    </div>
  </div>



@endsection



@section ('pageHeader')

@include('back.pages.user.financial-management.inc.header')

@endsection

@section ('content')


      @livewire('user.financial-management.allocation.pap.index')


@endsection


@push('scripts')

<script>




  window.addEventListener('hideAddModal', function(e) {
    $('#add_pap').modal('hide');
    $('#add_allocation').modal('hide');
  });
  
  window.addEventListener('hideUpdateModal', function(e) {
    $('#add_pap').modal('hide');
  });
  
  window.addEventListener('showUpdateModal', function(e) {
    $('#add_pap').modal('show');
  });


  window.addEventListener('showUpdateAllocationModal', function(e) {
    $('#add_allocation').modal('show');
  });

  window.addEventListener('hideUpdateAllocationModal', function(e) {
    $('#add_allocation').modal('hide');
  });
  

  window.addEventListener('hideDeleteModal', function(e) {
    $('#delete_pap').modal('hide');
  });
  
  
  window.addEventListener('showDeleteAllocationModal', function(e) {
    $('#delete_allocation').modal('show');
  });

  window.addEventListener('hideDeleteAllocationModal', function(e) {
    $('#delete_allocation').modal('hide');
  });
  

  window.addEventListener('showDeleteModal', function(e) {
    $('#delete_pap').modal('show');
  });

  $('#add_allocation').on('hidden.bs.modal', function(e) {  
    Livewire.emit('resetModalForm');
  }); 




</script>

    
@endpush