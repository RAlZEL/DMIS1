@extends('back.layouts.pages-layout')

@section ('pageTitle',isset($pageTitle) ? $pageTitle : 'Announcement')


@section ('pageSubTitle')



<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            Announcement
          </h2>
        </div>
      </div>
    </div>
  </div>



@endsection


@section ('content')


      @livewire('user.announcement.index')


@endsection


@push('scripts')



  <script>
        
    window.addEventListener('showUpdateModal', function(e) {
    $('#add_announcement').modal('show');
    });

    window.addEventListener('showDeleteModal', function(e) {
    $('#delete_announcement').modal('show');
    });
    window.addEventListener('hideUpdateModal', function(e) {
    $('#add_announcement').modal('hide');
    });

    window.addEventListener('hideDeleteModal', function(e) {
    $('#delete_announcement').modal('hide');
    });

  </script>
    
@endpush



