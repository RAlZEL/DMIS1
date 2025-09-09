@extends('back.layouts.pages-layout')

@section ('pageTitle',isset($pageTitle) ? $pageTitle : 'Financial Management Accounting Entry')


@section ('pageSubTitle')



<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            Financial Management Accounting Entry
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

@livewire('user.financial-management.fm-accounting.accountingentry')

@endsection


@push('scripts')

  <script>
     window.addEventListener('hideAddeModal', function(e) {
      $('#add_entry').modal('hide');
    });
    window.addEventListener('showUpdateModal', function(e) {
      $('#add_entry').modal('show');
    });
    

  </script>
    
@endpush


