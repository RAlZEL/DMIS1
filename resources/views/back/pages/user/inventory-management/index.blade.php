@extends('back.layouts.pages-layout')

@section ('pageTitle',isset($pageTitle) ? $pageTitle : 'Inventory Management System')


@section ('pageSubTitle')

<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            Inventory Management System
          </h2>
        </div>
      </div>
    </div>
  </div>
  @endsection



@section ('pageHeader')

@include('back.pages.user.inventory-management.inc.header')

@endsection

@section ('content')




      @livewire('user.inventory-management.index')


@endsection


@push('scripts')

<script>

  window.addEventListener('show-edit-property-modal', function(e) {
    $('#edit_property').modal('show');
  });

  window.addEventListener('hide-edit-property-modal', function(e) {
    $('#edit_property').modal('hide');
  });

  $('#edit_property').on('hidden.bs.modal', function(e) {  
    Livewire.emit('resetModalForm');
  }); 
    
//   window.addEventListener('hideEmployeeModal', function(e) {
//     $('#add_employee').modal('hide');
//   });
//   window.addEventListener('showUpdateModal', function(e) {
//     $('#add_employee').modal('show');
//   });

//   window.addEventListener('hideDeleteEmployeeModal', function(e) {
//     $('#delete_employee').modal('hide');
//   });
  

//   window.addEventListener('showDeleteModal', function(e) {
//     $('#delete_employee').modal('show');
//   });

//   $('#add_employee').on('hidden.bs.modal', function(e) {  
//     Livewire.emit('resetModalForm');
//   }); 




</script>

    
@endpush


