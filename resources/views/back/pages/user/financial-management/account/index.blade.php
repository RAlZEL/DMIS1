@extends('back.layouts.pages-layout')

@section ('pageTitle',isset($pageTitle) ? $pageTitle : 'Financial Management System | Account')


@section ('pageSubTitle')



<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            Account
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


     @livewire('user.financial-management.account.index')


@endsection


@push('scripts')

<script>

  window.addEventListener('hideAddModal', function(e) {
      $('#add_account').modal('hide');
    });
    

  window.addEventListener('showUpdateModal', function(e) {
      $('#add_account').modal('show');
    });
    
    
      
    window.addEventListener('hideUpdateModal', function(e) {
      $('#add_account').modal('hide');
    });
    
    window.addEventListener('hideAddAccountModal', function(e) {
      $('#add_account_number').modal('hide');
    });
    
      $('#add_account_number').on('hidden.bs.modal', function(e) {  
      Livewire.emit('resetModalForm');
    }); 
    $('#add_account').on('hidden.bs.modal', function(e) {  
      Livewire.emit('resetModalForm');
    }); 
    
    window.addEventListener('showUpdateAccountNumberModal', function(e) {
      $('#add_account_number').modal('show');
    });
    
    window.addEventListener('hideUpdatAccountNumbereModal', function(e) {
      $('#add_account_number').modal('hide');
    });
    
    

  
  
  </script>
    
@endpush