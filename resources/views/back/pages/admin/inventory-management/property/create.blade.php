@extends('back.layouts.pages-layout')

@section ('pageTitle',isset($pageTitle) ? $pageTitle : 'Inventory Management System | New Property')


@section ('pageSubTitle')



<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            New Property
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


     @livewire('user.inventory-management.property.index')


@endsection


@push('scripts')

<script>

    window.addEventListener('viewProperty', function(e) {
        $('#view_property').modal('show');
    });
  

  $('#view_property').on('hidden.bs.modal', function(e) {  
      Livewire.emit('resetModalForm');
    }); 

//   window.addEventListener('showUpdateModal', function(e) {
//       $('#add_account').modal('show');
//     });
    
    
      
//     window.addEventListener('hideUpdateModal', function(e) {
//       $('#add_account').modal('hide');
//     });
    
//     window.addEventListener('hideAddAccountModal', function(e) {
//       $('#add_account_number').modal('hide');
//     });
    
//       $('#add_account_number').on('hidden.bs.modal', function(e) {  
//       Livewire.emit('resetModalForm');
//     }); 
//     $('#add_account').on('hidden.bs.modal', function(e) {  
//       Livewire.emit('resetModalForm');
//     }); 
    
//     window.addEventListener('showUpdateAccountNumberModal', function(e) {
//       $('#add_account_number').modal('show');
//     });
    
//     window.addEventListener('hideUpdatAccountNumbereModal', function(e) {
//       $('#add_account_number').modal('hide');
//     });
    
    

  
  
  </script>
    
@endpush