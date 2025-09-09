@extends('back.layouts.admin-pages-layout')

@section ('pageTitle',isset($pageTitle) ? $pageTitle : 'Employee Management System')


@section ('pageSubTitle')



<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            Employee Management System
          </h2>
        </div>
      </div>
    </div>
  </div>



@endsection



@section ('pageHeader')

@include('back.pages.admin.EMS.inc.header')

@endsection

@section ('content')

@livewire('admin.e-m-s.employees')

@endsection


@push('scripts')

<script>
  

  window.addEventListener('hideEmployeeModal', function(e) {
    $('#add_employee').modal('hide');
  });
  window.addEventListener('showUpdateModal', function(e) {
    $('#add_employee').modal('show');
  });

  window.addEventListener('hideDeleteEmployeeModal', function(e) {
    $('#delete_employee').modal('hide');
  });
  

  window.addEventListener('showDeleteModal', function(e) {
    $('#delete_employee').modal('show');
  });

  $('#add_employee').on('hidden.bs.modal', function(e) {  
    Livewire.emit('resetModalForm');
  }); 


  

</script>
    
@endpush


