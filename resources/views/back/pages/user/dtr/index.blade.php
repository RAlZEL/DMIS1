@extends('back.layouts.pages-layout')

@section ('pageTitle',isset($pageTitle) ? $pageTitle : 'Daily Time Record')


@section ('pageSubTitle')



<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            Daily Time Record
          </h2>
        </div>
      </div>
    </div>
  </div>



@endsection



@section ('pageHeader')

{{-- @include('back.pages.user.dtr.inc.header') --}}
  @livewire('user.dtr.header')

@endsection

@section ('content')


      @livewire('user.dtr.index')


@endsection


@push('scripts')

<script>


window.addEventListener('showDeleteModal', function(e) {
    $('#delete_dtr').modal('show');
  });
  
  window.addEventListener('hideDeleteModal', function(e) {
    $('#delete_dtr').modal('hide');
  });

  window.addEventListener('showUpdateModal', function(e) {
    $('#update_dtr').modal('show');
  });
  
  window.addEventListener('hideUpdateModal', function(e) {
    $('#update_dtr').modal('hide');
  });


</script>

    
@endpush 


