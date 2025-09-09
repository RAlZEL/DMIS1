@extends('back.layouts.auth-layout')

@section ('pageTitle',isset($pageTitle) ? $pageTitle : 'Login')

@section ('content')
<div class="page page-center">
    <div class="container-tight py-2">

      @livewire('admin.admin-login-form')
    </div>
  </div>
@endsection