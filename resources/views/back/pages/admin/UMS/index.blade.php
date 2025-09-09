
@can('viewany', App\Models\User::class)

  @extends('back.layouts.admin-pages-layout')

  @section ('pageTitle',isset($pageTitle) ? $pageTitle : 'User Management System')


  @section ('pageSubTitle')



  <div class="container-xl">
      <!-- Page title -->
      <div class="page-header d-print-none">
        <div class="row align-items-center">
          <div class="col">
            <h2 class="page-title">
              User Management System
            </h2>
          </div>
        </div>
      </div>
    </div>
  @endsection



  @section ('pageHeader')
  
  @include('back.pages.admin.UMS.inc.header')

  @endsection

  @section ('content')

  @livewire('admin.u-m-s.index')

  @endsection


  @push('scripts')

    <script>
    

    window.addEventListener('hideUserModal', function(e) {
      $('#add_user').modal('hide');
    });
    window.addEventListener('showUpdateModal', function(e) {
      $('#add_user').modal('show');
    });
    window.addEventListener('showEditUsernameModal', function(e) {
      $('#edit_username').modal('show');
    });
    
    window.addEventListener('hideEditUserModal', function(e) {
      $('#edit_username').modal('hide');
    });

    window.addEventListener('showChangePasswordModal', function(e) {
      $('#changePassword').modal('show');
    });
    
    window.addEventListener('hideChangePasswordModal', function(e) {
      $('#changePassword').modal('hide');
    });

    window.addEventListener('showUpdateStatusModal', function(e) {
      $('#edit_status').modal('show');
    });

    window.addEventListener('hideUpdateStatusModal', function(e) {
      $('#edit_status').modal('hide');
    });

    $('#add_user').on('hidden.bs.modal', function(e) {  
      Livewire.emit('resetModalForm');
    }); 

    $('#changePassword').on('hidden.bs.modal', function(e) {  
      Livewire.emit('resetModalForm');
    }); 


    

  </script>

  @endpush

@endcan
