@extends('back.layouts.pages-layout')

@section ('pageTitle',isset($pageTitle) ? $pageTitle : 'Memorandum Creator')


@section ('pageSubTitle')



<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            Memorandum Creator
          </h2>
        </div>
      </div>
    </div>
  </div>



@endsection


@section ('content')


      @livewire('user.memo-creator.index')


@endsection


@push('scripts')



  <script>
    window.addEventListener('hideAddModal', function(e) {
    $('#add_memo').modal('hide');
    });
        
    window.addEventListener('ResetModalForm', function(e) {
    
    Livewire.emit('ResetModalForm');
    });

//     window.addEventListener('showAcceptTask', function(e) {
//     $('#accept_task').modal('show');
//     });

//     window.addEventListener('showRejectTask', function(e) {
//     $('#reject_task').modal('show');
//     });


    // window.addEventListener('showUpdateModal', function(e) {
    // $('#add_announcement').modal('show');
    // });

    // window.addEventListener('showDeleteModal', function(e) {
    // $('#delete_announcement').modal('show');
    // });
    // window.addEventListener('hideUpdateModal', function(e) {
    // $('#add_announcement').modal('hide');
    // });

    // window.addEventListener('hideDeleteModal', function(e) {
    // $('#delete_announcement').modal('hide');
    // });
    
//     window.addEventListener('hideAcceptModal', function(e) {
//     $('#accept_task').modal('hide');
//     });

//     window.addEventListener('hideTaskModal', function(e) {
//     $('#add_task').modal('hide');
//     });
    
//     window.addEventListener('hideRejectModal', function(e) {
//     $('#reject_task').modal('hide');
//     });

    
    


  </script>
    
@endpush



