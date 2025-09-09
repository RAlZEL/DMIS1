@extends('back.layouts.pages-layout')

@section ('pageTitle',isset($pageTitle) ? $pageTitle : 'Inventory Management System | Article')


@section ('pageSubTitle')



<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            Article
          </h2>
        </div>
      </div>
    </div>
  </div>



@endsection



@section ('pageHeader')

@include('back.pages.user.inventory-management.inc.header')

@endsection

@section ('content')


     @livewire('user.inventory-management.article.index')


@endsection


@push('scripts')

<script>

  window.addEventListener('hideAddModal', function(e) {
      $('#add_article').modal('hide');
    });
    

  window.addEventListener('showUpdateModal', function(e) {
      $('#add_article').modal('show');
    });
    
    
      
    window.addEventListener('hideUpdateModal', function(e) {
      $('#add_article').modal('hide');
    });
    
    window.addEventListener('hideAddArticleModal', function(e) {
      $('#add_article_description').modal('hide');
    });
    
      $('#add_article_description').on('hidden.bs.modal', function(e) {  
      Livewire.emit('resetModalForm');
    }); 
    $('#add_article').on('hidden.bs.modal', function(e) {  
      Livewire.emit('resetModalForm');
    }); 
    
    window.addEventListener('showUpdateArticleDescriptionModal', function(e) {
      $('#add_article_description').modal('show');
    });
    
    window.addEventListener('hideUpdateArticleDescriptionModal', function(e) {
      $('#add_article_description').modal('hide');
    });

    window.addEventListener('showDeleteArticleDescriptionModal', function(e) {
      $('#add_article_delete').modal('show');
    });
    
    window.addEventListener('hideDeleteArticleDescriptionModal', function(e) {
      $('#add_article_delete').modal('hide');
    });
    
    

  
  
  </script>
    
@endpush