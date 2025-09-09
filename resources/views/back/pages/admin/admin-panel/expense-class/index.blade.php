@extends('back.layouts.admin-pages-layout')

@section ('pageTitle',isset($pageTitle) ? $pageTitle : 'Expense Class')


@section ('pageSubTitle')



<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            Expense Class
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

@livewire('admin.admin-panel.expense-class.index')

@endsection


@push('scripts')

  <script>
    window.addEventListener('hideAddModal', function(e) {
      $('#add_expense_class').modal('hide');
    });

    window.addEventListener('showUpdateModal', function(e) {
      $('#add_expense_class').modal('show');
    });

    window.addEventListener('hideUpdateeModal', function(e) {
      $('#add_expense_class').modal('hide');
    });
    

    $('#add_expense_class').on('hidden.bs.modal', function(e) {
      Livewire.emit('resetModalForm');
    }); 

  </script>
    
@endpush


