@extends('back.layouts.admin-pages-layout')

@section ('pageTitle',isset($pageTitle) ? $pageTitle : 'Unit Category')


@section ('pageSubTitle')



<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            Unit Category
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

@livewire('admin.admin-panel.category.units')

@endsection


@push('scripts')

  <script>
    window.addEventListener('hideUnitModal', function(e) {
      $('#add_unit').modal('hide');
    });
    window.addEventListener('showUpdateModal', function(e) {
      $('#add_unit').modal('show');
    });

    window.addEventListener('hideDeleteUnitModal', function(e) {
      $('#delete_unit').modal('hide');
    });
    

    window.addEventListener('showDeleteModal', function(e) {
      $('#delete_unit').modal('show');
    });

    $('#add_unit').on('hidden.bs.modal', function(e) {
      Livewire.emit('resetModalForm');
    }); 

  </script>
    
@endpush


