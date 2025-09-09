@extends('back.layouts.pages-layout')

@section ('pageTitle',isset($pageTitle) ? $pageTitle : 'Profile')

@section ('content')

    @livewire('user.profile-header')

  <hr>
    <div class="row">
        <div class="card">
            <ul class="nav nav-tabs" data-bs-toggle="tabs">
            <li class="nav-item">
                <a href="#tabs-personal" class="nav-link active" data-bs-toggle="tab">Personal Details</a>
            </li>
            <li class="nav-item">
                <a href="#tabs-details" class="nav-link" data-bs-toggle="tab">Log-in Details</a>
            </li>
            <li class="nav-item">
                <a href="#tabs-password" class="nav-link" data-bs-toggle="tab">Change Password</a>
            </li>
            </ul>
            <div class="card-body">
            <div class="tab-content">

                <div class="tab-pane active show" id="tabs-personal">
                    <div>
                        
                        @livewire('user.personal')

                    </div>
                </div>

                <div class="tab-pane" id="tabs-details">
                    <div>
                        
                        @livewire('user.profile')

                    </div>
                </div>
                <div class="tab-pane" id="tabs-password">
                    <div>
                        @livewire('user.change-password')
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>

</div>


@endsection



