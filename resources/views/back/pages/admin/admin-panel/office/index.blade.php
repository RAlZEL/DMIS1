@extends('back.layouts.admin-pages-layout')

@section ('pageTitle',isset($pageTitle) ? $pageTitle : 'Create Office')


@section ('pageSubTitle')



<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            Create Office
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

@livewire('admin.admin-panel.office.offices')

@endsection


@push('scripts')

  <script>
    window.addEventListener('hideOfficeModal', function(e) {
      $('#add_office').modal('hide');
    });
    window.addEventListener('showUpdateModal', function(e) {
      $('#add_office').modal('show');
    });

    window.addEventListener('hideDeleteOfficeModal', function(e) {
      $('#delete_office').modal('hide');
    });
    

    window.addEventListener('showDeleteModal', function(e) {
      $('#delete_office').modal('show');
    });

    $('#add_office').on('hidden.bs.modal', function(e) {
      Livewire.emit('resetModalForm');
    }); 

  </script>
    
@endpush


