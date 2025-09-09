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
                Admin Panel > Office 
            </h2>
        </div>
    </div>
</div>

@endsection


@section ('pageHeader')

<div class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
      <div class="navbar navbar-light">
        <div class="container-xl">
          <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-primary" href="{{ route('admin-panel.home') }}" >
                     Admin Panel
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="./docs/index.html">
                  <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/file-text -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M14 3v4a1 1 0 0 0 1 1h4"></path><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path><line x1="9" y1="9" x2="10" y2="9"></line><line x1="9" y1="13" x2="15" y2="13"></line><line x1="9" y1="17" x2="15" y2="17"></line></svg>
                  </span>
                  <span class="nav-link-title">
                    Office
                  </span>
                </a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/star -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" /></svg>
                  </span>
                  <span class="nav-link-title">
                    Categories
                  </span>
                </a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{ route('admin-panel.officecategory') }}">
                    Office
                  </a>
                  <a class="dropdown-item" href="./gallery.html" >
                    Section
                  </a>
                  <a class="dropdown-item" href="./gallery.html" >
                    Unit
                  </a>
                </div>
              </li>

            </ul>
        </div>
      </div>
    </div>
  </div>

@endsection

