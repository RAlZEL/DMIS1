@extends('back.layouts.pages-layout')

@section ('pageTitle',isset($pageTitle) ? $pageTitle : 'Event Management System')


@section ('pageSubTitle')



<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            Event Management System
          </h2>
        </div>
      </div>
    </div>
  </div>



@endsection


@section ('content')


      @livewire('user.event.index')


@endsection


@push('scripts')

  <script>
    
    $('#add_event').on('hidden.bs.modal', function(e) {
      Livewire.emit('resetModalForm');
    }); 

    window.addEventListener('showUpdateModal', function(e) {
    $('#add_event').modal('show');
    });

    window.addEventListener('hideAddModal', function(e) {
    $('#add_event').modal('hide');
    });

    window.addEventListener('showDeleteModal', function(e) {
    $('#delete_event').modal('show');
    });

    window.addEventListener('hideDeleteModal', function(e) {
    $('#delete_event').modal('hide');
    });

  </script>
    
@endpush



