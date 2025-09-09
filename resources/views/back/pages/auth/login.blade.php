@extends('back.layouts.auth-layout')

@section ('pageTitle',isset($pageTitle) ? $pageTitle : 'Login')

@section ('content')
<div class="page page-center">
    <div class="container-tight py-2">

      @livewire('user.user-login-form')
      <div class="text-center text-muted mt-3">
        Don't have account yet? <a href="{{ route('user.request-account') }}" tabindex="-1">Request an Account</a>
      </div>
    </div>
  </div>
@endsection