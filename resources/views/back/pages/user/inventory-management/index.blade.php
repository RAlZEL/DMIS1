@extends('back.layouts.pages-layout')

@section ('pageTitle',isset($pageTitle) ? $pageTitle : 'Inventory Management System')


@section ('pageSubTitle')

<div style="margin: 0; padding: 0; width: 100%;">
    <!-- Page title -->
    <div class="page-header d-print-none" style="padding: 0.4rem 0.75rem; margin: 0; background: #f8f9fa;">
      <div class="row align-items-center" style="margin: 0;">
        <div class="col" style="padding: 0;">
          <h2 class="page-title" style="font-size: 1.2rem; font-weight: 700; margin: 0; overflow: visible; white-space: nowrap; color: #212529;">
            Inventory Management System
          </h2>
        </div>
      </div>
    </div>
  </div>
  @endsection

@section ('content')

<style>
  /* Override container for Inventory Management System - NO PADDING */
  body .page-body > .container-xl {
    max-width: 100% !important;
    padding-left: 0 !important;
    padding-right: 0 !important;
    margin: 0 !important;
  }
  
  /* Ensure page body has no overflow */
  body .page-body {
    overflow-x: hidden !important;
    padding: 0 !important;
  }
</style>
</style>

      @livewire('user.inventory-management.index')


@endsection


@push('scripts')

<script>

  window.addEventListener('hideAddModal', function(e) {
    $('#add_article').modal('hide');
  });

  window.addEventListener('showUpdateModal', function(e) {
    $('#add_article').modal('show');
  });

  // Reset form before modal is shown
  $('#add_article').on('show.bs.modal', function(e) {
    // Only reset if it's not from an edit button (check if triggered by button with data-bs-toggle)
    if (e.relatedTarget && e.relatedTarget.hasAttribute('data-bs-toggle')) {
      Livewire.emit('resetModalForm');
    }
  });

  $('#add_article').on('hidden.bs.modal', function(e) {  
    Livewire.emit('resetModalForm');
  });

  // Article Description Modal Events
  window.addEventListener('showDeleteModal', function(e) {
    $('#delete_description').modal('show');
  });

  $('#add_article_description').on('hidden.bs.modal', function(e) {  
    Livewire.emit('resetModalForm');
  });

  $('#delete_description').on('hidden.bs.modal', function(e) {  
    Livewire.emit('resetDeleteForm');
  });

  // Toast Notifications
  window.addEventListener('showToastr', function(e) {
    const { type, message } = e.detail;
    const toastHtml = `
      <div class="toast align-items-center text-white bg-${type === 'success' ? 'success' : 'danger'} border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
          <div class="toast-body">${message}</div>
          <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
      </div>
    `;
    
    let toastContainer = document.getElementById('toast-container');
    if (!toastContainer) {
      toastContainer = document.createElement('div');
      toastContainer.id = 'toast-container';
      toastContainer.className = 'position-fixed top-0 end-0 p-3';
      toastContainer.style.zIndex = '9999';
      document.body.appendChild(toastContainer);
    }
    
    const toastWrapper = document.createElement('div');
    toastWrapper.innerHTML = toastHtml;
    toastContainer.appendChild(toastWrapper.firstElementChild);
    
    const toastEl = toastContainer.lastElementChild;
    const toast = new bootstrap.Toast(toastEl, { delay: 3000 });
    toast.show();
    
    toastEl.addEventListener('hidden.bs.toast', function() {
      this.remove();
    });
  });

</script>

    
@endpush


