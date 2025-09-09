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
                                    <a href="" class="btn btn-sm btn-primary" wire:click.prevent="editEmployee({{$Employee->id}})">Edit</a> &nbsp;
                                    <a href="" class="btn btn-sm btn-danger" wire:click.prevent="deleteEmployee({{$Employee->id}})">Delete</a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center">
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
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <form class="modal-content" method="POST" @if($updateEmployee)
                    wire:submit.prevent='updateEmployee()'
                @else
                    wire:submit.prevent="addEmployee()"
                @endif>
                <div class="modal-header">
                    <h5 class="modal-title"> {{ $updateEmployee ? 'Update Employee ' : 'Add Employee'}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <label class="form-label">Personal Information</label>
                    <div class="dropdown-divider"></div>

                    <div class="row">

                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control" name="firstname" placeholder="Enter First Name" wire:model="firstname">
                            </div>
                            <span class="text-danger"> 
                                @error('firstname')
                                    {{ $message }}   
                                @enderror
                            </span>
                        </div>

                        
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Middle Name</label>
                                <input type="text" class="form-control" name="middlename" placeholder="Enter Middle Name" wire:model="middlename">
                            </div>
                            <span class="text-danger"> 
                                @error('middlename')
                                    {{ $message }}   
                                @enderror
                            </span>
                        </div>

                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="lastname" placeholder="Enter Last Name" wire:model="lastname">
                            </div>
                            <span class="text-danger"> 
                                @error('lastname')
                                    {{ $message }}   
                                @enderror
                            </span>
                        </div>


                    </div>

                    <div class="row">

                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Birth Date</label>
                                <input type="date" class="form-control" wire:model="birthdate">
                            </div>
                            <span class="text-danger"> 
                                @error('birthdate')
                                    {{ $message }}   
                                @enderror
                            </span>
                        </div>

                        
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Contact Number </label>
                                <input type="number" class="form-control" name="contactnumber" placeholder="Enter Contact Number" wire:model="contactnumber">
                            </div>
                            <span class="text-danger"> 
                                @error('contactnumber')
                                    {{ $message }}   
                                @enderror
                            </span>
                        </div>

                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="email" class="form-control" name="email" placeholder="Enter Email Address" wire:model="email" @if ($updateEmployee) disabled @endif>
                            </div>
                            <span class="text-danger"> 
                                @error('email')
                                    {{ $message }}   
                                @enderror
                            </span>
                        </div>


                    </div>
                    <div class="col-lg-12">
                        <div>
                        <label class="form-label">Address</label>
                        <textarea class="form-control" rows="3" wire:model="address"></textarea>
                        </div>
                        <span class="text-danger"> 
                            @error('address')
                                {{ $message }}   
                            @enderror
                        </span>
                    </div>
                </div>

                <div class="modal-body">
                    <label class="form-label">Employment Information</label>
                    <div class="dropdown-divider"></div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_retired" id="is_retired" wire:model="is_retired">
                            <span class="form-check-label">Is Retired / Resigned</span>
                            </label>
                        </div>
                        <span class="text-danger"> 
                            @error('is_retired')
                                {{ $message }}   
                            @enderror
                        </span>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Employee Status</label>
                                <select class="form-select" wire:model="empstatus">
                                    @if($updateEmployee)
                                        <option value="CASUAL">Casual</option>
                                        <option value="CONTRACTUAL">Contractual</option>
                                        <option value="PERMANENT">Permanent</option>
                                        <option value="TRAINEE">Trainee</option>
                                    @else
                                        <option value="">--- Choose Employee Status ---</option>
                                        <option value="CASUAL">Casual</option>
                                        <option value="CONTRACTUAL">Contractual</option>
                                        <option value="PERMANENT">Permanent</option>
                                        <option value="TRAINEE">Trainee</option>
                                    @endif
                                  
                                </select>
                            </div>
                            <span class="text-danger"> 
                                @error('empstatus')
                                    {{ $message }}   
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Employee ID</label>
                        <input type="text" class="form-control" name="employeeid" placeholder="Enter Employee ID" wire:model="employeeid">
                    </div>
                    <span class="text-danger"> 
                        @error('employeeid')
                            {{ $message }}   
                        @enderror
                    </span>   

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Date Hired</label>
                                <input type="date" class="form-control" wire:model="datehired">
                            </div>
                            <span class="text-danger"> 
                                @error('datehired')
                                    {{ $message }}   
                                @enderror
                            </span>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Position</label>
                                <input type="text" class="form-control" name="position" placeholder="Enter Position" wire:model="position">
                            </div>
                            <span class="text-danger"> 
                                @error('position')
                                    {{ $message }}   
                                @enderror
                            </span>
                        </div>
                    </div>
                 
                    <div class="mb-3">
                        <label class="form-label">Office Assigned</label>
                        <select class="form-select" wire:model="selectedOffice">
                                <option value="" selected>--- Choose Office ---</option>

                                @forelse ($officeids as $Office)
                                    <option value="{{ $Office->id }}">{{ $Office->office}}</option>
                                @empty
                                    
                                @endforelse
                    
                        </select>
                    </div>
                    <span class="text-danger"> 
                        @error('selectedOffice')
                            {{ $message }}   
                        @enderror
                    </span> 

                    @if(!is_null($selectedOffice))
                        <div class="mb-3">
                            <label class="form-label">Division Assigned</label>
                            <select class="form-select" wire:model="selectedDivision">
                                <option value="" selected>--- Choose Division ---</option>

                                
                                @forelse ($DivisionFinal as $Final)
                                @forelse ($divisionids as $Division)
                                @if($Final->id == $Division->Division->id)
                                     <option value="{{ $Division->Division->id }}">{{ $Division->Division->division }}</option>
                                     @break;
                                     @endif
                                @empty
    
                                @endforelse
                          @empty
                              
                          @endforelse
                            </select>
                        </div>
                        <span class="text-danger"> 
                            @error('selectedDivision')
                                {{ $message }}   
                            @enderror
                        </span> 
                        
                    @endif
                
                    @if (!is_null($selectedDivision))
                        <div class="mb-3">
                            <label class="form-label">Unit Assigned</label>
                            <select class="form-select" wire:model="selectedUnit">
                                <option value="" selected>--- Choose Unit ---</option>
                            @forelse ($unitids as $Unit)
                            <option value="{{ $Unit->unit_id }}">{{ $Unit->unit->unit}}</option>
                            @empty
                                
                            @endforelse
                            </select>
                        </div>
                        <span class="text-danger"> 
                            @error('selectedUnit')
                                {{ $message }}   
                            @enderror
                        </span> 
                    @endif
                    
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">{{ $updateEmployee ? 'Update' : 'Save'}}</button>
                </div>
            </form>
        </div>
    </div> 

   <div wire:ignore.self class="modal modal-blur fade" id="delete_employee" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
          <form class="modal-content" method="POST"     wire:submit.prevent='destroyEmployee()'>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-danger"></div>
            <div class="modal-body text-center py-4">
              <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v2m0 4v.01" /><path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" /></svg>
              <h3>Are you sure?</h3>
              <div class="text-muted">Do you really want to delete this Employee.</div>
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
