<div>
    <div class="row row-cards"> 
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_employee">
                    Add New Employee
                    </button>
                </div>
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
                    <table class="table card-table table-vcenter text-nowrap datatable">
                    <thead>
                        <tr>
                            <th class="text-center">Employee ID</th> 
                            <th class="text-center">First Name</th>
                            <th class="text-center">Middle Name</th>
                            <th class="text-center">Last Name</th>
                            <th class="text-center">Birth Date</th>
                            <th class="text-center">Assigned Office</th>
                            <th class="text-center">Position</th>
                            <th class="text-center">Status</th>
                            <th class="text-center"></th>
                            <th class="text-center w-1">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($Employees as  $Employee)
                        <tr>  
                            <td class="text-center">{{ $Employee->employeeid }}</td>
                            <td class="text-center">{{ $Employee->firstname }}</td>
                            <td class="text-center">{{ $Employee->middlename }}</td>
                            <td class="text-center">{{ $Employee->lastname }}</td>
                            <td class="text-center">{{ $Employee->birthdate }}</td>
                            <td class="text-center">{{ $Employee->office->office }}</td>
                            <td class="text-center">{{ $Employee->position }}</td>
                            <td class="text-center">{{ $Employee->empstatus }}</td>
                            @if($Employee->is_retired == true) 
                                <td class="text-center">
                                   <span class="btn btn-sm btn-danger ">
                                    Retired</span> 
                                </td>   
                                                            
                            @else
                                
                            <td class="text-center">
                                <span class="btn btn-sm btn-success ">
                                Active</span> 
                            </td>                 
                            @endif
                         
                            <td class="text-center">
                                <div class="btn-group">
                                    {{-- <a href="" class="btn btn-sm btn-primary" wire:click.prevent="editOffice({{$Employee->id}})">Edit</a> &nbsp; --}}
                                    {{-- <a href="" class="btn btn-sm btn-danger" wire:click.prevent="deleteOffice({{$Employee->id}})">Delete</a> --}}
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                <span class="text-center text-danger">
                                   No Employee found.
                               </span> 
                           </td>
                        </tr>
                        @endforelse
                    
                        
                    </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex align-items-center">
                    {{ $Employees->links('livewire::bootstrap') }}
                </div>
            </div>
        </div>
    </div>


  <div wire:ignore.self class="modal modal-blur fade" id="add_employee" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <form class="modal-content" method="POST"
                @if($updateEmployee)
                    {{-- wire:submit.prevent='updateEmployee()' --}}
                @else
                    {{-- wire:submit.prevent="addEmployee()" --}}
                @endif
            >
            <div class="modal-header">
              <h5 class="modal-title"> {{ $updateEmployee ? 'Update Employee ' : 'Add Employee'}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="mb-3">
                    <label class="form-label">Employee ID</label>
                    <input type="text" class="form-control" name="employeeid" placeholder="Enter Employee ID" wire:model="employeeid">
                </div>  
                <span class="text-danger"> 
                    @error('employeeid')
                    {{ $message }}  
                    @enderror
                </span> 
                
            </div>
            <div class="modal-footer">
              <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">{{ $updateEmployee ? 'Update' : 'Save'}}</button>
            </div>
        </form>
        </div>
    </div>
   
   {{-- <div wire:ignore.self class="modal modal-blur fade" id="delete_office" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
          <form class="modal-content" method="POST"     wire:submit.prevent='destroyOffice()'>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-danger"></div>
            <div class="modal-body text-center py-4">
              <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v2m0 4v.01" /><path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" /></svg>
              <h3>Are you sure?</h3>
              <div class="text-muted">Do you really want to delete this office.</div>
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
      </div> --}}

</div>
