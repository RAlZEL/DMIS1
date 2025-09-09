@extends('back.layouts.pages-layout')

@section ('pageTitle',isset($pageTitle) ? $pageTitle : 'Daily Time Record')


@section ('pageSubTitle')



<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            Upload DTR
          </h2>
        </div>
      </div>
    </div>
  </div>



@endsection



@section ('pageHeader')

@livewire('user.dtr.header')


@endsection

@section ('content')

    
      @livewire('user.dtr.upload.index')


@endsection

@push('scripts')

<script>

  window.addEventListener('hideUploadModal', function(e) {
    $('#upload').modal('hide');
  });

  window.addEventListener('hideSaveModal', function(e) {
    $('#save').modal('hide');
  });
</script>

    
@endpush