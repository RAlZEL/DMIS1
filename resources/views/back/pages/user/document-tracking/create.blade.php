@extends('back.layouts.pages-layout')

@section ('pageTitle',isset($pageTitle) ? $pageTitle : 'Create')


@section ('pageSubTitle')



<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            Add new Document
          </h2>
        </div>
      </div>
    </div>
  </div>



@endsection



@section ('pageHeader')

@include('back.pages.user.document-tracking.inc.header')

@endsection

@section ('content')

@livewire('user.document-tracking.create')



@endsection


@push('scripts')

<script>
  

  window.addEventListener('viewDocument', function(e) {
    $('#view_document').modal('show');
  });
  
  $('#view_document').on('hidden.bs.modal', function(e) {  
      Livewire.emit('resetModalForm');
    }); 
</script>
    
@endpush


