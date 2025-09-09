@extends('back.layouts.pages-layout')

@section ('pageTitle',isset($pageTitle) ? $pageTitle : 'Financial Management System | View Voucher')


@section ('pageSubTitle')



<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            Financial Management System
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

      @livewire('user.financial-management.voucher.view', ['id' => $id])


@endsection


@push('scripts')

<script>
  

//   window.addEventListener('hideAddAttachmentModal', function(e) {
//     $('#add_attachment').modal('hide');
 
//   });

  
//   window.addEventListener('hideUpdateDocumentModal', function(e) {
//     $('#edit_document').modal('hide');
 
//   });

  window.addEventListener('hideAddRouteModal', function(e) {
    $('#add_route').modal('hide');
  });

  window.addEventListener('updateVoucher', function(e) {
    Livewire.emit('updateVoucher', 'updateRouteList');
  });
  window.addEventListener('hideAccept', function(e) {
    $('#accept_voucher').modal('hide');
  });
  
  window.addEventListener('hideReject', function(e) {
    $('#reject_voucher').modal('hide');
  });


  
//   window.addEventListener('hideCloseModal', function(e) {
//     $('#close_document').modal('hide');
//   });

//   window.addEventListener('hideAcceptModal', function(e) {
//     $('#accept_document').modal('hide');
//   });

//   window.addEventListener('hideRejectModal', function(e) {
//     $('#reject_document').modal('hide');
//   });
  

window.addEventListener('showDeleteORSModal', function(e) {
    $('#delete_ors_details').modal('show');
  });

  window.addEventListener('hideDeleteORSModal', function(e) {
    $('#delete_ors_details').modal('hide');
  });
  
  // window.addEventListener('updateIncomingCount', function(e) {
  //   Livewire.emit('updateIncomingMail');
  // });
  window.addEventListener('hideDeleteSAAChargingModal', function(e) {
    $('#delete_charging_saa').modal('hide');
  });

  window.addEventListener('hideApproveModal', function(e) {
    $('#approve_voucher').modal('hide');
  });


  window.addEventListener('hideDVModal', function(e) {
    $('#add_dv_number').modal('hide');
  });

  

  window.addEventListener('showdeleteADAModal', function(e) {
    $('#delete_ada').modal('show');
  });

  window.addEventListener('hidedeleteADAModal', function(e) {
    $('#delete_ada').modal('hide');
  });
  window.addEventListener('showDisburse', function(e) {
    $('#disburse').modal('show');
  });

  window.addEventListener('hideDisubrse', function(e) {
    $('#disburse').modal('hide');
  });
  


  window.addEventListener('showCheckAdaModal', function(e) {
    $('#add_checkada').modal('show');
  });

  window.addEventListener('hideCheckAdaMOdal', function(e) {
    $('#add_checkada').modal('hide');
  });
  


  window.addEventListener('showDVModal', function(e) {
    $('#add_dv_number').modal('show');
  });

  window.addEventListener('showAccountingEntryModal', function(e) {
    $('#add_accounting_entry').modal('show');
  });

  window.addEventListener('hideAccountingEntryModal', function(e) {
    $('#add_accounting_entry').modal('hide');
  });

  

  window.addEventListener('showdeleteAccountingEntryModal', function(e) {
    $('#delete_accounting_entry').modal('show');
  });

  window.addEventListener('hidedeleteAccountingEntryModal', function(e) {
    $('#delete_accounting_entry').modal('hide');
  });

  
  
  window.addEventListener('showdeleteReviewModal', function(e) {
    $('#delete_review').modal('show');
  });

  window.addEventListener('hidedeleteReviewModal', function(e) {
    $('#delete_review').modal('hide');
  });
  
  
  window.addEventListener('hideBoxDSignatory', function(e) {
    $('#add_boxd').modal('hide');
  });

  window.addEventListener('showBoxDSignatory', function(e) {
    $('#add_boxd').modal('show');
  });

  window.addEventListener('showReviewModal', function(e) {
    $('#add_review').modal('show');
  });

  window.addEventListener('hideReviewModal', function(e) {
    $('#add_review').modal('hide');
  });
  

  window.addEventListener('showDeleteSAAChargingModal', function(e) {
    $('#delete_charging_saa').modal('show');
  });

  
  window.addEventListener('hideAddORSModal', function(e) {
    $('#add_ors_details').modal('hide');
  });

  window.addEventListener('hideDeleteActivityChargingModal', function(e) {
    $('#delete_charging_activity').modal('hide');
  });
  window.addEventListener('showDeleteActivityChargingModal', function(e) {
    $('#delete_charging_activity').modal('show');
  });
  
  window.addEventListener('updateORSDetails', function(e) {
    Livewire.emit('updateORSDetails');

  });

  window.addEventListener('hideDeleteDVModal', function(e) {
    $('#delete_dv_number').modal('hide');
  });

  window.addEventListener('showDeleteDVModal', function(e) {
    $('#delete_dv_number').modal('show');
  });


  
  window.addEventListener('updateRoute', function(e) {
    Livewire.emit('updateRouteList', 'updateIncoming');

  });

  window.addEventListener('hideDeleteUACSChargingModal', function(e) {
    $('#delete_charging_uacs').modal('hide');
  });
  window.addEventListener('showDeleteUACSChargingModal', function(e) {
    $('#delete_charging_uacs').modal('show');
  });

  


//   window.addEventListener('updateAttachment', function(e) {
//     Livewire.emit('updateAttachmentList');
 
//   });
//   $('#add_attachment').on('hidden.bs.modal', function(e) {  
//     Livewire.emit('resetModalFormAttachment');
//   }); 

//     window.addEventListener('hideDeleteAttachmentModal', function(e) {
//       $('#delete_attachment').modal('hide');
//     });
    

//     window.addEventListener('showDeleteModal', function(e) {
//       $('#delete_attachment').modal('show');
//     });

  
</script>
    
@endpush


