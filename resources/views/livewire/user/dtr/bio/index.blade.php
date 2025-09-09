<div>
    <div class="row row-cards"> 
        <div class="col-12">
            <div class="card">
                @can('Biometric', App\Models\DTR::class)
                <div class="card-header">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_emp">
                    Add Employee
                    </button>
                    <button class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#add_device">
                    New Device
                    </button>
                </div>

                
                @endcan
        
                <div class="card-body border-bottom py-3">
                    <div class="d-flex">
                    <div class="text-muted">

                        Show
                        <div class="mx-2 d-inline-block">
                            <select class="form-select" wire:model="perPage">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
         
                        entries
                    </div>
                    <div class="ms-auto text-muted">
                        Search:
                        <div class="ms-2 d-inline-block">
                        <input type="text" class="form-control form-control-sm" aria-label="Search" wire:model='Search'>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-vcenter table-mobile-md card-table">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th> 
                            <th class="text-center">Employee Name</th>
                            <th class="text-center">Device Name</th>
                            <th class="text-center">Biometric Id</th>
                            <th class="w-1 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($BioEmps as $Bio)
                        <tr>
                            <td class="text-center" data-label="ID">{{ $Bio->id }}</td>
                            <td class="text-center" data-label="Employee Name">{{ $Bio->Employee->firstname . ' ' .  $Bio->Employee->lastname }}</td>
                            <td class="text-center" data-label="Device Name" >{{ $Bio->Device->device }}</td>
                            <td class="text-center" data-label="Biometric Id">{{ $Bio->bio_id }}</td>
                            <td class="text-center">
                                @can('Biometric', App\Models\DTR::class)  
                                <div class="btn-group">
                                  
                                    <a href="" class="btn btn-sm btn-danger" wire:click.prevent="deleteBio({{$Bio->id}})">Delete</a>
                         
                                </div>
                                @endcan
                            </td>
                            
                            
                        </tr>
                        @empty
                        <td colspan="10" class="text-center">
                            <span class="text-center text-danger">
                               No Bio Record found.
                           </span> 
                       </td>
                        @endforelse

                        
                    </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex align-items-center">
                    {{ $BioEmps->links('livewire::bootstrap') }}
                </div>
            </div>
        </div>
    </div>


    <div wire:ignore.self class="modal modal-blur fade" id="add_device" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
            <form class="modal-content" method="POST"     wire:submit.prevent='addDevice()'>
                <div class="modal-header">
                    <h5 class="modal-title"> Add Biometric Device</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                
                        
                    <div class="mb-3">
                        <label class="form-label">Device Name</label>
                        <input type="text" class="form-control" wire:model="device">
                        <span class="text-danger"> 
                            @error('device')
                                {{ $message }}   
                            @enderror
                        </span>
                    </div>
                                    
                </div>
                    
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
          </div>
        </div>
    </div> 


    
    <div wire:ignore.self class="modal modal-blur fade" id="add_emp" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
            <form class="modal-content" method="POST" wire:submit.prevent='addEmployee()'>
                <div class="modal-header">
                    <h5 class="modal-title"> Add Employee to Biometric Device</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                
                        
                    <div class="mb-3">
                        <label class="form-label">Device Name</label>
                        <select class="form-select" wire:model="selectedDevice">
                            <option value="" selected>--- Choose Device ---</option>

                            @forelse ($DTRDevices as $Device)
                            <option value="{{ $Device->id }}">
                                {{ $Device->device }}
                            </option>
                            @empty

                            @endforelse

                        </select>
                        <span class="text-danger">
                            @error('selectedDevice')
                            {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Employee Name</label>
                        <select class="form-select" wire:model="selectedEmployee">
                            <option value="" selected>--- Choose Employee Name ---</option>

                            @forelse ($Employees as $Employee)
                            <option value="{{ $Employee->id }}">
                                {{ $Employee->firstname . ' ' . $Employee->middlename . ' ' . $Employee->lastname}}
                            </option>
                            @empty

                            @endforelse

                        </select>
                        <span class="text-danger">
                            @error('selectedEmployee')
                            {{ $message }}
                            @enderror
                        </span>
                    </div>

                            
                    <div class="mb-3">
                        <label class="form-label">Biometric ID</label>
                        <input type="text" class="form-control" wire:model="bioid">
                        <span class="text-danger"> 
                            @error('bioid')
                                {{ $message }}   
                            @enderror
                        </span>
                    </div>


                                    
                </div>
                    
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
          </div>
        </div>
    </div> 


    <div wire:ignore.self class="modal modal-blur fade" id="delete_bio" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
          <form class="modal-content" method="POST"     wire:submit.prevent='destroyBio()'>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-danger"></div>
            <div class="modal-body text-center py-4">
              <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v2m0 4v.01" /><path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" /></svg>
              <h3>Are you sure?</h3>
              <div class="text-muted">Do you really want to delete this Biometric Entry.</div>
            </div>
            <div class="modal-footer">
              <div class="w-100">
                <div class="row">
                  <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                      Cancel
                    </a></div>
                  <div class="col"> 
                    <button type="submit" class="btn btn-danger w-100">Delete</button>  
                   </div>
                </div>
              </div>
            </div>
        </form>
        </div>
      </div>


</div>
