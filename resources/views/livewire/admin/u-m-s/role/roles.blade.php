<div>
    <div class="row row-cards"> 
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_role">
                    Add New User Role
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
                            <th class="text-center">User Role ID</th> 
                            <th class="text-center">User Name</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Role Name</th>
                            <th class="text-center">Can View</th>
                            <th class="text-center">Can Add</th>
                            <th class="text-center">Can Edit</th>
                            <th class="text-center">Can Delete</th>
                            <th class="text-center">Can Accept</th>
                            <th class="text-center">Can Process</th>
                            <th class="text-center">Can Route</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($UserRoles as  $Role)
                        <tr>  
                            <td class="text-center">{{ $Role->id }}</td>
                            <td class="text-center">{{ $Role->User->username }}</td>
                            <td class="text-center">{{ $Role->User->email }}</td>
                            <td class="text-center">{{ $Role->Role->rolename }}</td>
                            {{-- <td class="text-center">{{ $Role->Role->rolename }}</td> --}}
                            <td class="text-center">
                                @if($Role->can_view) 
                                <label class="form-switch">
                                    <input class="form-check-input" type="checkbox"  checked disabled>
                                  </label>
                                @else
                                <label class="form-switch">
                                    <input class="form-check-input" type="checkbox" disabled>
                                  </label>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($Role->can_add) 
                                <label class="form-switch">
                                    <input class="form-check-input" type="checkbox"  checked disabled>
                                  </label>
                                @else
                                <label class="form-switch">
                                    <input class="form-check-input" type="checkbox" disabled>
                                  </label>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($Role->can_edit) 
                                <label class="form-switch">
                                    <input class="form-check-input" type="checkbox"  checked disabled>
                                  </label>
                                @else
                                <label class="form-switch">
                                    <input class="form-check-input" type="checkbox" disabled>
                                  </label>
                                @endif
                            </td>

                            <td class="text-center">
                                @if($Role->can_delete) 
                                <label class="form-switch">
                                    <input class="form-check-input" type="checkbox"  checked disabled>
                                  </label>
                                @else
                                <label class="form-switch">
                                    <input class="form-check-input" type="checkbox" disabled>
                                  </label>
                                @endif
                            </td>

                            <td class="text-center">
                                @if($Role->can_accept) 
                                <label class="form-switch">
                                    <input class="form-check-input" type="checkbox"  checked disabled>
                                  </label>
                                @else
                                <label class="form-switch">
                                    <input class="form-check-input" type="checkbox" disabled>
                                  </label>
                                @endif
                            </td>

                            <td class="text-center">
                                @if($Role->can_process) 
                                <label class="form-switch">
                                    <input class="form-check-input" type="checkbox"  checked disabled>
                                  </label>
                                @else
                                <label class="form-switch">
                                    <input class="form-check-input" type="checkbox" disabled>
                                  </label>
                                @endif
                            </td>

                            <td class="text-center">
                                @if($Role->can_route) 
                                <label class="form-switch">
                                    <input class="form-check-input" type="checkbox"  checked disabled>
                                  </label>
                                @else
                                <label class="form-switch">
                                    <input class="form-check-input" type="checkbox" disabled>
                                  </label>
                                @endif
                            </td>
                            <td class="text-center">
                              
                                    <div class="btn-group">
                                        <a href="" class="btn btn-sm btn-primary" wire:click.prevent="editRole({{$Role->id}})">Edit</a> &nbsp;
                                        <a href="" class="btn btn-sm btn-danger" wire:click.prevent="deleteRole({{$Role->id}})">Delete</a>
                                    </div>
                              
                            </td> 
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center">
                                <span class="text-center text-danger">
                                   No User found.
                               </span> 
                           </td>
                        </tr>
                        @endforelse 
                    
                        
                    </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex align-items-center">
                    {{ $UserRoles->links('livewire::bootstrap') }}
                </div>
            </div>
        </div>
    </div>

    
    <div wire:ignore.self class="modal modal-blur fade" id="add_role" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <form class="modal-content" method="POST" @if($updateRole)
            wire:submit.prevent='updateRole()'
            @else
                wire:submit.prevent="addRole()"
            @endif
            >
                <div class="modal-header">
                    <h5 class="modal-title"> {{ $updateRole ? 'Update Role ' : 'Add Role'}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>


                <div class="modal-body">
                    <label class="form-label">User Information</label>
                    <div class="dropdown-divider"></div>

                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <select class="form-select" wire:model="userid"@if($updateRole)
                            disabled
                            @else
                               
                            @endif>
                                <option value="" selected>--- Choose Email ---</option>                              
                                @forelse ($Users as $User)
                                <option value="{{ $User->id }}">{{ $User->email }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <span class="text-danger"> 
                            @error('userid')
                                {{ $message }}   
                            @enderror
                        </span> 
                    </div>

                    
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <select class="form-select" wire:model="roleid" @if($updateRole)
                           disabled
                        @else
                           
                        @endif>
                                <option value="" selected>--- Choose Role ---</option>                              
                                @forelse ($Roles as $Role)
                                <option value="{{ $Role->id }}">{{ $Role->rolename }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <span class="text-danger"> 
                            @error('roleid')
                                {{ $message }}   
                            @enderror
                        </span> 
                    </div>
                </div>



                <div class="modal-body">
                    <label class="form-label"> General Access Level</label>
                    <div class="dropdown-divider"></div>

                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="" id="" wire:model="can_view" checked>
                            <span class="form-check-label">Can View</span>
                            </label>
                        </div>
                        <span class="text-danger"> 
                            @error('can_view')
                                {{ $message }}   
                            @enderror
                        </span>
                    </div>

                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="" id="" wire:model="can_add" checked>
                            <span class="form-check-label">Can Add</span>
                            </label>
                        </div>
                        <span class="text-danger"> 
                            @error('can_add')
                                {{ $message }}   
                            @enderror
                        </span>
                    </div>

                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="" id="" wire:model="can_edit" checked>
                            <span class="form-check-label">Can Edit</span>
                            </label>
                        </div>
                        <span class="text-danger"> 
                            @error('can_edit')
                                {{ $message }}   
                            @enderror
                        </span>
                    </div>
    
                    
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="" id="" wire:model="can_delete" checked>
                            <span class="form-check-label">Can Delete</span>
                            </label>
                        </div>
                        <span class="text-danger"> 
                            @error('can_delete')
                                {{ $message }}   
                            @enderror
                        </span>
                    </div>

                    <label class="form-label"> Mailing - Access Level</label>
                    <div class="dropdown-divider"></div>

                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="" id="" wire:model="can_accept">
                            <span class="form-check-label">Can Accept</span>
                            </label>
                        </div>
                        <span class="text-danger"> 
                            @error('can_accept')
                                {{ $message }}   
                            @enderror
                        </span>
                    </div>

                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="" id="" wire:model="can_process">
                            <span class="form-check-label">Can Process</span>
                            </label>
                        </div>
                        <span class="text-danger"> 
                            @error('can_process')
                                {{ $message }}   
                            @enderror
                        </span>
                    </div>

                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="" id="" wire:model="can_route">
                            <span class="form-check-label">Can Route</span>
                            </label>
                        </div>
                        <span class="text-danger"> 
                            @error('can_route')
                                {{ $message }}   
                            @enderror
                        </span>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">{{ $updateRole ? 'Update' : 'Save'}}</button>
                </div>
            </form>
        </div>
    </div> 

    <div wire:ignore.self class="modal modal-blur fade" id="delete_role" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
          <form class="modal-content" method="POST"     wire:submit.prevent='destroyRole()'>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-danger"></div>
            <div class="modal-body text-center py-4">
              <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v2m0 4v.01" /><path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" /></svg>
              <h3>Are you sure?</h3>
              <div class="text-muted">Do you really want to delete this User Role.</div>
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
