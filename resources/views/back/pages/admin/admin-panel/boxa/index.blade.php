@extends('back.layouts.admin-pages-layout')

@section ('pageTitle',isset($pageTitle) ? $pageTitle : 'Financial Management BOX A Signatories')


@section ('pageSubTitle')



<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
             BOX A Signatories
          </h2>
        </div>
      </div>
    </div>
  </div>



@endsection



@section ('pageHeader')

@include('back.pages.admin.admin-panel.inc.header')

@endsection

@section ('content')

@livewire('admin.financial-management.boxa.index')

@endsection


@push('scripts')

<script>



    window.addEventListener('hideSignatoryModal', function(e) {
      $('#add_signatory').modal('hide');
    });
    
    window.addEventListener('showUpdateModal', function(e) {
      $('#add_signatory').modal('show');
    });

  
    // window.addEventListener('hideDeleteOfficeModal', function(e) {
    //   $('#delete_office').modal('hide');
    // });
    

    // window.addEventListener('showDeleteModal', function(e) {
    //   $('#delete_office').modal('show');
    // });

    $('#add_signatory').on('hidden.bs.modal', function(e) {
      Livewire.emit('resetModalForm');
    }); 


</script>
  
    
@endpush


