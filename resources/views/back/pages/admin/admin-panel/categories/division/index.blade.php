@extends('back.layouts.admin-pages-layout')

@section ('pageTitle',isset($pageTitle) ? $pageTitle : 'Division Category')


@section ('pageSubTitle')



<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            Division Category
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

@livewire('admin.admin-panel.category.divisions')

@endsection


@push('scripts')

  <script>
    window.addEventListener('hideDivisionModal', function(e) {
      $('#add_division').modal('hide');
    });
    window.addEventListener('showUpdateModal', function(e) {
      $('#add_division').modal('show');
    });

    window.addEventListener('hideDeleteDivisionModal', function(e) {
      $('#delete_division').modal('hide');
    });
    

    window.addEventListener('showDeleteModal', function(e) {
      $('#delete_division').modal('show');
    });

    $('#add_division').on('hidden.bs.modal', function(e) {
      Livewire.emit('resetModalForm');
    }); 

  </script>
    
@endpush


