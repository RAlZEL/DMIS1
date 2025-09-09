<div>
    <div class="row row-cards"> 
        <div class="col-12">
            <div class="card">
                {{-- @can ('create',App\Models\Admin\AdminPanel\FinancialManagement\Office::class) --}}
                
                <div class="card-header">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_employee">
                    Add Employee
                    </button>
                </div>

                {{-- @endcan  --}}
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
                            <th class="text-center">Id</th>
                            <th class="text-center">Employee ID</th>
                            <th class="text-center w-1">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        {{-- @forelse ($Offices as $Index => $Office)
                        <tr>
                            <td class="text-center">{{ $Office->id }}</td>
                            <td class="text-center">{{ $Office->office }}</td>
                            <td class="text-center">{{ $Office->address }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                            
                                    <a href="" class="btn btn-sm btn-primary" wire:click.prevent="editOffice({{$Office->id}})">Edit</a> &nbsp;
                           
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                <span class="text-center text-danger">
                                   No Expense Class found.
                               </span> 
                           </td>
                        </tr>
                        @endforelse --}}
                    
                        
                    </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex align-items-center">
                    {{-- {{ $Offices->links('livewire::bootstrap') }} --}}
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal modal-blur fade" id="add_employee" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <form class="modal-content" method="POST" wire:submit.prevent="addOffice()" >
            <div class="modal-header">
              <h5 class="modal-title"> Add Employee </h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
    
                <div class="mb-3">
                    <label class="form-label">Employee Name</label>
                  
    
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
