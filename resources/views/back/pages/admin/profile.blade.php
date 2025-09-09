@extends('back.layouts.admin-pages-layout')

@section ('pageTitle',isset($pageTitle) ? $pageTitle : 'Profile')

@section ('content')

    @livewire('admin.profile-header')

  <hr>
    <div class="row">
        <div class="card">
            <ul class="nav nav-tabs" data-bs-toggle="tabs">
            <li class="nav-item">
                <a href="#tabs-details" class="nav-link active" data-bs-toggle="tab">Personal Details</a>
            </li>
            <li class="nav-item">
                <a href="#tabs-password" class="nav-link" data-bs-toggle="tab">Change Password</a>
            </li>
            </ul>
            <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane active show" id="tabs-details">
                    <div>
                        
                        @livewire('admin.profile')

                    </div>
                </div>
                <div class="tab-pane" id="tabs-password">
                    <div>
                        @livewire('admin.change-password')
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>

</div>


@endsection



