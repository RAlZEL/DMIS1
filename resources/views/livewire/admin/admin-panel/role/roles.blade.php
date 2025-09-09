<div>
    <div>
        <div class="row row-cards"> 
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_role">
                        Create New Role
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
                                <th class="text-center">Role ID</th>
                                <th class="text-center">Role Name</th>
                                <th class="text-center w-1">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($Roles as $Index => $Role)
                            <tr>
                                <td class="text-center">{{ $Role->id }}</td>
                                <td class="text-center">{{ $Role->rolename }}</td>
                        
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="" class="btn btn-sm btn-primary" wire:click.prevent="editRole({{$Role->id}})">Edit</a> &nbsp;
                                     
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">
                                    <span class="text-center text-danger">
                                    No Office found.
                                </span> 
                            </td>
                            </tr>
                            @endforelse
                        
                            
                        </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex align-items-center">
                        {{ $Roles->links('livewire::bootstrap') }}
                    </div>
                </div>
            </div>
        </div>

    <div wire:ignore.self class="modal modal-blur fade" id="add_role" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <form class="modal-content" method="POST" 
                @if($updateRole)
                wire:submit.prevent='updateRole()'
                @else
                    wire:submit.prevent='addRole()'
                @endif>
                <div class="modal-header">
                <h5 class="modal-title">{{ $updateRole ? 'Update Role' : 'Add Role'}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Role Name</label>
                        <input type="text" class="form-control" name="rolename" placeholder="Enter Role Name" wire:model="rolename">
                    </div>  
                    <span class="text-danger"> 
                        @error('rolename')
                        {{ $message }}  
                        @enderror
                    </span>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">{{ $updateRole ? 'Update' : 'Save'}}</button>
                </div>
            </form>
        </div>
    </div>
    
</div>
