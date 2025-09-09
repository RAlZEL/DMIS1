@extends('back.layouts.pages-layout')

@section ('pageTitle',isset($pageTitle) ? $pageTitle : 'Financial Management System')


@section ('pageSubTitle')



<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            UACS
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


     @livewire('user.financial-management.allocation.u-a-c-s.index')


@endsection


@push('scripts')

<script>



window.addEventListener('hideAddModal', function(e) {
    $('#add_uacs').modal('hide');
    $('#add_allocation').modal('hide');
  });
  
  window.addEventListener('hideUpdateModal', function(e) {
    $('#add_uacs').modal('hide');
  });
  

  window.addEventListener('showUpdateModal', function(e) {
    $('#add_uacs').modal('show');
  });
    
  window.addEventListener('showRealignModal', function(e) {
    $('#uacs_realign').modal('show');
  });

  window.addEventListener('showConfirmModal', function(e) {
    $('#uacs_add_confirm').modal('show');
  });


  window.addEventListener('hideConfirmModal', function(e) {
    $('#uacs_add_confirm').modal('hide');
  });
  
  window.addEventListener('hideRealignModal', function(e) {
    $('#uacs_realign').modal('hide');
  });

  $('#add_allocation').on('hidden.bs.modal', function(e) {  
    Livewire.emit('resetModalForm');
  }); 

  
  $('#uacs_realign').on('hidden.bs.modal', function(e) {  
    Livewire.emit('resetModalForm');
  }); 


  


</script>

    
@endpush