<div>
    <div class="navbar-expand-md">
        <div class="collapse navbar-collapse" id="navbar-menu">
          <div class="navbar navbar-light">
            <div class="container-xl">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('user.dtrHome')}}">
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="5 12 3 12 12 3 21 12 19 12"></polyline><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path></svg>
                    </span>
                    <span class="nav-link-title">
                      Home
                    </span>
                  </a>
                </li>
          
                @can('print', App\Models\DTR::class)
                <li class="nav-item">
                  
                  <a class="nav-link" href="{{ route('user.dtrPrint')}}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path>
                        <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
                        <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z"></path>
                     </svg>
                    <span class="nav-link-title">
                      Print DTR
                    </span>
                  </a>
                </li>
                @endcan

                
                @can('upload', App\Models\DTR::class)
                <li class="nav-item">
                  
                  <a class="nav-link" href="{{ route('user.uploadDTR')}}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-upload" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"></path>
                      <path d="M7 9l5 -5l5 5"></path>
                      <path d="M12 4l0 12"></path>
                   </svg>
                    <span class="nav-link-title">
                      Upload DTR
                    </span>
                  </a>
                </li>
                @endcan

                @can('Biometric', App\Models\DTR::class)
                <li class="nav-item">
                    
                  <a class="nav-link" href="{{ route('user.UserBio')}}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-hourglass-empty" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M6 20v-2a6 6 0 1 1 12 0v2a1 1 0 0 1 -1 1h-10a1 1 0 0 1 -1 -1z"></path>
                      <path d="M6 4v2a6 6 0 1 0 12 0v-2a1 1 0 0 0 -1 -1h-10a1 1 0 0 0 -1 1z"></path>
                   </svg>
                    <span class="nav-link-title">
                      Biometric Setup
                    </span>
                  </a>
                </li>
                @endcan


              </ul>
            </div>
          </div>
        </div>
      </div>
    
      
      {{-- <div wire:ignore.self class="modal modal-blur fade" id="printDTR" tabindex="-1" role="dialog" aria-hidden="true"
      data-bs-backdrop="static" data-bs-keyboard="false">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <form class="modal-content" method="POST" wire:submit.prevent='PrintDTR()'>
              <div class="modal-header">
                  <h5 class="modal-title"> DTR Details</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Employee Name</label>
                    <select class="form-select" wire:model="selectedEmployee">
                            <option value="" selected>--- Choose Employee ---</option>

                            @forelse ($Employees as $Employee)
                                <option value="{{ $Employee->id }}">{{ $Employee->firstname . ' ' . $Employee->middlename . ' ' . $Employee->lastname}}</option>
                            @empty
                                
                            @endforelse
                
                    </select>
                    <span class="text-danger"> 
                        @error('selectedEmployee')
                            {{ $message }}   
                        @enderror
                    </span>
                </div>
                 
                  <div class="dropdown-divider"></div>  
    
                  <div class="mb-3">
                    <label class="form-label">Start Date :<span class="text-danger">*</span></label>
                    <input type="date" class="form-control" wire:model="startdate">
                    <span class="text-danger"> 
                        @error('startdate')
                            {{ $message }}   
                        @enderror
                    </span>
                </div>
    
                <div class="mb-3">
                    <label class="form-label">Start Date :<span class="text-danger">*</span></label>
                    <input type="date" class="form-control" wire:model="enddate">
                    <span class="text-danger"> 
                        @error('enddate')
                            {{ $message }}   
                        @enderror
                    </span>
                </div>
               
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
    
                  <button type="submit" class="btn btn-primary">Print</button>
     
              </div>
          </form>
      </div>
    </div> --}}
    
    
</div>
