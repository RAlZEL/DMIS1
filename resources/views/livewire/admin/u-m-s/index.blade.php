<div>
    <div class="row row-cards"> 
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_user">
                    Add New User
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
                            <th class="text-center">User ID</th> 
                            <th class="text-center">Username</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Office</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($Users as  $User)
                        <tr>  
                            <td class="text-center">{{ $User->id }}</td>
                            <td class="text-center">{{ $User->username }}</td>
                            <td class="text-center">{{ $User->email }}</td>
                            <td class="text-center">active</td>
                            <td class="text-center"></td>
                            <td class="text-end">
                                <span class="dropdown">
                                  <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                                  <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="" wire:click.prevent="editUsername({{$User->id}})">
                                        Edit Username
                                    </a>
                                    <a class="dropdown-item" href="" wire:click.prevent="changePassword({{$User->id}})">
                                        Change Password
                                    </a>
                                    <a class="dropdown-item" href="" wire:click.prevent="editStatus({{$User->id}})">
                                        Update Status 
                                    </a>
                                  </div>
                                </span>
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
                    {{ $Users->links('livewire::bootstrap') }}
                </div>
            </div>
        </div>
    </div>

    
    <div wire:ignore.self class="modal modal-blur fade" id="edit_status" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <form class="modal-content" method="POST" wire:submit.prevent="updateStatus()">
                <div class="modal-header">
                    <h5 class="modal-title">Update Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <label class="form-label">User Information</label>
                    <div class="dropdown-divider"></div>

                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_retired" id="is_retired" wire:model="is_enable">
                            <span class="form-check-label">Is Enable</span>
                            </label>
                        </div>
                        <span class="text-danger"> 
                            @error('is_enable')
                                {{ $message }}   
                            @enderror
                        </span>
                    </div>

                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_retired" id="is_retired" wire:model="is_verified">
                            <span class="form-check-label">Is Verified</span>
                            </label>
                        </div>
                        <span class="text-danger"> 
                            @error('is_enable')
                                {{ $message }}   
                            @enderror
                        </span>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div> 



    <div wire:ignore.self class="modal modal-blur fade" id="edit_username" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <form class="modal-content" method="POST" wire:submit.prevent="updateUsername()">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Username</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <label class="form-label">User Information</label>
                    <div class="dropdown-divider"></div>

                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name="employeeid" placeholder="Enter Username" wire:model="username">
                    </div>
                    <span class="text-danger"> 
                        @error('username')
                            {{ $message }}   
                        @enderror
                    </span>   
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div> 

    <div wire:ignore.self class="modal modal-blur fade" id="changePassword" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <form class="modal-content" method="POST" wire:submit.prevent="updatePassword()">
                <div class="modal-header">
                    <h5 class="modal-title">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <label class="form-label">User Information</label>
                    <div class="dropdown-divider"></div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">New Password</label>
                                <input type="password" class="form-control" name="current" placeholder="Enter Password"  wire:model="password">
                                <span class="text-danger">
                                    @error('new_password')
                                            {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Cofirm Password</label>
                                <input type="password" class="form-control" name="current" placeholder="Confirm Password" wire:model="confirm_password">
                                <span class="text-danger">
                                    @error('confirm_password')
                                            {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div> 

    <div wire:ignore.self class="modal modal-blur fade" id="add_user" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <form class="modal-content" method="POST" wire:submit.prevent="addUser()">
                <div class="modal-header">
                    <h5 class="modal-title">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <label class="form-label">User Information</label>
                    <div class="dropdown-divider"></div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Employee Email</label>
                                <select class="form-select" wire:model="email">
                                    <option value="" selected>--- Choose Email ---</option>
                                    @forelse ($Employees as $Employee)
                                        <option value="{{ $Employee->email }}">{{ $Employee->email}}</option>
                                    @empty
                                        
                                    @endforelse
                                  
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
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name="employeeid" placeholder="Enter Username" wire:model="username">
                    </div>
                    <span class="text-danger"> 
                        @error('username')
                            {{ $message }}   
                        @enderror
                    </span>   
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">New Password</label>
                                <input type="password" class="form-control" name="current" placeholder="Enter Password"  wire:model="password">
                                <span class="text-danger">
                                    @error('new_password')
                                            {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Cofirm Password</label>
                                <input type="password" class="form-control" name="current" placeholder="Confirm Password" wire:model="confirm_password">
                                <span class="text-danger">
                                    @error('confirm_password')
                                            {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
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
