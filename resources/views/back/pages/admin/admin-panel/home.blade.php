@extends('back.layouts.admin-pages-layout')

@section ('pageTitle',isset($pageTitle) ? $pageTitle : 'Admin Panel')

@section ('content')


<div class="row row-cards">
    
</div>


@endsection

@section ('pageTitle')

<div class="page-header d-print-none">
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title">
                Admin Panel
            </h2>
        </div>
    </div>
</div>

@endsection


@section ('pageHeader')

@include('back.pages.admin.admin-panel.inc.header')

@endsection
