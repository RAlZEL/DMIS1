@extends('back.layouts.pages-layout')

@section ('pageTitle',isset($pageTitle) ? $pageTitle : 'Financial Management System')


@section ('pageSubTitle')



<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            SAA Allocation
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


     @livewire('user.financial-management.allocation.saa.index')


@endsection


@push('scripts')

<script>



window.addEventListener('hideAddModal', function(e) {
    $('#add_allocation').modal('hide');
  });
  

  window.addEventListener('showUpdateModal', function(e) {
    $('#add_allocation').modal('show');
  });


//   window.addEventListener('hideUpdateModal', function(e) {
//     $('#add_activity').modal('hide');
//   });
  


    
//   window.addEventListener('showDeleteModal', function(e) {
//     $('#delete_activity').modal('show');
//   });
 
//   window.addEventListener('hideDeleteModal', function(e) {
//     $('#delete_activity').modal('hide');
//   });
 

  $('#add_allocation').on('hidden.bs.modal', function(e) {  
    Livewire.emit('resetModalForm');
  }); 


//   window.addEventListener('showConfirmModal', function(e) {
//     $('#activity_add_confirm').modal('show');
//   });

  

//   window.addEventListener('hideConfirmModal', function(e) {
//     $('#activity_add_confirm').modal('hide');
//   });


</script>

    
@endpush