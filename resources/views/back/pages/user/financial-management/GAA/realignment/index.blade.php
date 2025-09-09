@extends('back.layouts.pages-layout')

@section ('pageTitle',isset($pageTitle) ? $pageTitle : 'Financial Management System')


@section ('pageSubTitle')



<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            UACS Realignment History
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


     @livewire('user.financial-management.allocation.u-a-c-s.realignment.index')


@endsection


@push('scripts')

    
@endpush