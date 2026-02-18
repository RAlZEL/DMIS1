@extends('back.layouts.admin-pages-layout')

@section ('pageTitle',isset($pageTitle) ? $pageTitle : 'Inventory Management System')


@section ('pageSubTitle')
  @endsection

@section ('content')

<style>
  /* HIDE GLOBAL NAVBAR - LOCAL NAVBAR ONLY FOR THIS PAGE */
  .navbar {
    display: none !important;
  }

  /* Custom Local Navbar */
  .inventory-local-navbar {
    background: white;
    border-bottom: 1px solid #e5e7eb;
    padding: 0.75rem 1.5rem;
    position: sticky;
    top: 0;
    z-index: 1000;
    box-shadow: 0 2px 4px rgba(0,0,0,0.06);
  }

  .inventory-local-navbar-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    max-width: 100%;
  }

  .inventory-navbar-left {
    display: flex;
    align-items: center;
    gap: 0.75rem;
  }

  .inventory-navbar-left img {
    height: 32px;
    width: 32px;
  }

  .inventory-navbar-title {
    font-size: 1rem;
    font-weight: 600;
    color: #2c3e50;
    margin: 0;
  }

  .inventory-navbar-right {
    display: flex;
    align-items: center;
    gap: 1.5rem;
  }

  .inventory-navbar-icons {
    display: flex;
    align-items: center;
    gap: 1rem;
  }

  .inventory-navbar-icons a {
    color: #6b7280;
    text-decoration: none;
    font-size: 1.1rem;
    transition: all 0.2s ease;
  }

  .inventory-navbar-icons a:hover {
    color: #3b82f6;
  }

  .inventory-user-info {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding-left: 1rem;
    border-left: 1px solid #e5e7eb;
    cursor: pointer;
    transition: all 0.2s ease;
  }

  .inventory-user-info:hover {
    background: #f8f9fa;
    /* border-radius: 8px;
    padding: 0.35rem 0.75rem; */
  }

  .inventory-user-dropdown {
    position: relative;
  }

  .inventory-user-dropdown .dropdown-menu {
    min-width: 180px;
  }

  .inventory-user-dropdown .dropdown-item {
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
    color: #1e293b;
    transition: all 0.2s ease;
  }

  .inventory-user-dropdown .dropdown-item:hover {
    background: #f1f5f9;
    color: #3b82f6;
  }

  .inventory-user-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background-size: cover;
    background-position: center;
  }

  .inventory-user-details {
    display: flex;
    flex-direction: column;
  }

  .inventory-user-name {
    font-size: 0.85rem;
    font-weight: 600;
    color: #1e293b;
    line-height: 1.2;
  }

  .inventory-user-role {
    font-size: 0.7rem;
    color: #6b7280;
    line-height: 1;
  }

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

<!-- CUSTOM LOCAL NAVBAR FOR INVENTORY MANAGEMENT -->
<div class="inventory-local-navbar">
  <div class="inventory-local-navbar-content">
    <!-- Left Side: Logo + Title -->
    <div class="inventory-navbar-left">
      <img src="{{ asset('images/logo.png') }}" alt="Logo">
      <h1 class="inventory-navbar-title">Inventory Management System</h1>
    </div>

    <!-- Right Side: Icons + User Info -->
    <div class="inventory-navbar-right">
      <div class="inventory-navbar-icons">
        <a href="{{ route('admin.home') }}" title="Home">
          <i class="fas fa-home"></i>
        </a>
      </div>
      <!-- User Dropdown -->
      <div class="inventory-user-dropdown dropdown">
        <a href="#" class="inventory-user-info d-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
          <div class="inventory-user-avatar" style="background-image: url({{ asset('/images/user.png')}})"></div>
          <div class="inventory-user-details">
            <span class="inventory-user-name">{{ auth('web')->user()->username }}</span>
            <span class="inventory-user-role">Administrator</span>
          </div>
        </a>
        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
          <a href="{{ route('admin.profile') }}" class="dropdown-item">Profile</a>
          <a href="{{ route('admin.logout')}}" class="dropdown-item" onclick="event.preventDefault();document.getElementById('logout-form-inventory').submit();">Logout</a>
          <form action="{{ route('admin.logout') }}" id="logout-form-inventory" method="POST" style="display: none;"> @csrf </form>
        </div>
      </div>
    </div>
  </div>
</div>

      @livewire('admin.inventory-management.index')


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


