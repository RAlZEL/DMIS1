
@can('viewany', App\Models\User::class)

  @extends('back.layouts.admin-pages-layout')

  @section ('pageTitle',isset($pageTitle) ? $pageTitle : 'Role')


  @section ('pageSubTitle')



  <div class="container-xl">
      <!-- Page title -->
      <div class="page-header d-print-none">
        <div class="row align-items-center">
          <div class="col">
            <h2 class="page-title">
              Roles
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

  @livewire('admin.u-m-s.role.roles')

  @endsection


  @push('scripts')

    <script>
    

    window.addEventListener('hideAddModal', function(e) {
      $('#add_role').modal('hide');
    });
    window.addEventListener('showUpdateModal', function(e) {
      $('#add_role').modal('show');
    });

    window.addEventListener('hideDeleteModal', function(e) {
      $('#delete_role').modal('hide');
    });
    

    window.addEventListener('showDeleteModal', function(e) {
      $('#delete_role').modal('show');
    });

    $('#add_role').on('hidden.bs.modal', function(e) {  
      Livewire.emit('resetModalForm');
    }); 


    

  </script>

  @endpush

@endcan
