
@can('viewany', App\Models\User::class)

  @extends('back.layouts.admin-pages-layout')

  @section ('pageTitle',isset($pageTitle) ? $pageTitle : 'Financial Management System')


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
  
  @include('back.pages.admin.financial-management.inc.header')

  @endsection

  @section ('content')

  @livewire('admin.financial-management.index')

  @endsection


  @push('scripts')

  @endpush

@endcan
