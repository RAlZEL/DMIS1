@extends('back.layouts.pages-layout')

@push('stylesheets')
{{-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet"> --}}
    
@endpush

@section ('pageTitle',isset($pageTitle) ? $pageTitle : 'Create')


@section ('pageSubTitle')



{{-- <div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            Update Memorandum
          </h2>
        </div>
      </div>
    </div>
  </div> --}}



@endsection


@section ('content')

@livewire('user.memo-creator.create')



@endsection


@push('scripts')
{{-- <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
  $(document).ready(function() {
      $("#memo_body").summernote({
        height: 250,

        toolbar: [
          ['undo'],
            ['redo'],
            ['font', ['bold', 'underline', 'clear']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
          ],
          codeviewFilter: false,
          codeviewIframeFilter: true,
          
      });
      $('.dropdown-toggle').dropdown();
      

  });
</script> --}}
<script>
  

//   window.addEventListener('viewDocument', function(e) {
//     $('#view_document').modal('show');
//   });
  
//   $('#view_document').on('hidden.bs.modal', function(e) {  
//       Livewire.emit('resetModalForm');
//     }); 
</script>

    
@endpush


