@extends('back.layouts.admin-pages-layout')

@section ('pageTitle',isset($pageTitle) ? $pageTitle : 'Inventory Management System')


@section ('pageSubTitle')
  @endsection

@section ('content')

<style>
  :root {
    --ims-space-2: 0.75rem;
    --ims-space-3: 1rem;
    --ims-border: #e2e8f0;
    --ims-text: #1e293b;
  }

  /* HIDE GLOBAL NAVBAR - LOCAL NAVBAR ONLY FOR THIS PAGE */
  .navbar {
    display: none !important;
  }

  /* Custom Local Navbar */
  .inventory-local-navbar {
    background: white;
    border-bottom: 1px solid var(--ims-border);
    padding: 0.6rem 1.5rem;
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
    color: var(--ims-text);
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

  @media (max-width: 992px) {
    .inventory-local-navbar {
      padding: 0.5rem 0.9rem;
    }

    .inventory-local-navbar-content {
      gap: 0.75rem;
      flex-wrap: wrap;
    }

    .inventory-navbar-right {
      width: 100%;
      justify-content: space-between;
      gap: 0.75rem;
    }

    .inventory-user-info {
      padding-left: 0.5rem;
    }
  }

  /* Override container for Inventory Management System - NO PADDING */
  body .page-body > .container-xl {
    max-width: 100% !important;
    padding-left: 0 !important;
    padding-right: 0 !important;
    margin: 0 !important;
  }
  
  /* IMS workspace lock: keep screen fixed and move scrolling to inner table only */
  html,
  body {
    height: 100%;
  }

  body {
    overflow: hidden !important;
  }

  body .wrapper {
    height: 100vh;
    min-height: 100vh;
    overflow: hidden;
  }

  body .wrapper > .page-wrapper {
    height: 100vh;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    margin: 0 !important;
    padding: 0 !important;
  }

  body .page-wrapper .page-body {
    flex: 1 1 auto;
    min-height: 0;
    overflow: hidden !important;
    margin: 0 !important;
    padding: 0 !important;
  }

  body .page-wrapper .page-body > .container-xl {
    height: 100%;
    min-height: 0;
    display: flex;
    flex-direction: column;
    overflow: hidden !important;
  }

  .inventory-ims-workspace {
    flex: 1 1 auto;
    min-height: 0;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    margin: 0 !important;
    padding: 0 !important;
  }

  .inventory-ims-workspace > [wire\\:id] {
    flex: 1 1 auto;
    min-height: 0;
    display: flex;
    flex-direction: column;
  }

  /* Hide shared layout footer only on IMS page */
  body .wrapper > footer.footer,
  body .wrapper footer.footer,
  body .page-wrapper + footer.footer,
  body footer.footer.footer-transparent.d-print-none {
    display: none !important;
  }

  /* Ensure page body has no horizontal overflow */
  body .page-body {
    overflow-x: hidden !important;
    margin: 0 !important;
    padding: 0 !important;
  }

  /* IMS navbar refinement */
  .inventory-local-navbar {
    padding: 0.5rem 1rem;
    background: linear-gradient(180deg, rgba(255, 255, 255, 0.98) 0%, rgba(248, 250, 252, 0.96) 100%);
    backdrop-filter: blur(10px);
    box-shadow: 0 10px 24px rgba(15, 23, 42, 0.06);
  }

  .inventory-local-navbar-content {
    gap: 1rem;
  }

  .inventory-navbar-left {
    gap: 0.7rem;
  }

  .inventory-navbar-left img {
    height: 30px;
    width: 30px;
  }

  .inventory-navbar-title {
    font-size: 0.98rem;
    font-weight: 700;
    letter-spacing: 0.01em;
  }

  .inventory-navbar-right {
    gap: 1rem;
  }

  .inventory-home-link {
    width: 2.15rem;
    height: 2.15rem;
    border-radius: 999px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #f8fafc;
    border: 1px solid #dbe4ee;
    color: #475569 !important;
    transition: background-color 0.18s ease, border-color 0.18s ease, color 0.18s ease, box-shadow 0.18s ease;
  }

  .inventory-home-link:hover {
    background: #eff6ff;
    border-color: #bfdbfe;
    color: #1d4ed8 !important;
    box-shadow: 0 10px 18px rgba(59, 130, 246, 0.16);
  }

  .inventory-user-info {
    min-height: 2.5rem;
    padding-left: 0.85rem;
    padding-right: 0.15rem;
    border-radius: 0.95rem;
  }

  .inventory-user-dropdown .dropdown-menu {
    border-radius: 0.95rem;
    border: 1px solid #dbe4ee;
    box-shadow: 0 18px 35px rgba(15, 23, 42, 0.12);
    padding: 0.35rem;
  }

  .inventory-user-dropdown .dropdown-item {
    border-radius: 0.7rem;
  }

  .inventory-user-name {
    letter-spacing: 0.01em;
  }

  .inventory-user-role {
    letter-spacing: 0.02em;
    text-transform: uppercase;
  }
  /* IMS shell final polish */
  .inventory-local-navbar {
    position: sticky;
  }

  .inventory-local-navbar::after {
    content: '';
    position: absolute;
    left: 0;
    right: 0;
    bottom: 0;
    height: 1px;
    background: linear-gradient(90deg, rgba(37, 99, 235, 0) 0%, rgba(37, 99, 235, 0.18) 22%, rgba(22, 163, 74, 0.16) 78%, rgba(22, 163, 74, 0) 100%);
    pointer-events: none;
  }

  .inventory-home-link {
    box-shadow: 0 8px 18px rgba(15, 23, 42, 0.06);
  }

  .inventory-user-info {
    background: rgba(255, 255, 255, 0.58);
    padding-top: 0.2rem;
    padding-bottom: 0.2rem;
  }

  .inventory-user-avatar {
    border: 2px solid #ffffff;
    box-shadow: 0 8px 16px rgba(15, 23, 42, 0.08);
  }

  .inventory-user-dropdown .dropdown-item {
    font-weight: 600;
  }

  .inventory-user-dropdown .dropdown-item:hover {
    background: #eff6ff;
    color: #16324f;
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
        <a href="{{ route('user.home') }}" class="inventory-home-link" title="Home">
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

<div class="inventory-ims-workspace">
  @livewire('admin.inventory-management.index')
</div>


@endsection


@push('scripts')

<script>
  // Toast notifications used across IMS actions
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

