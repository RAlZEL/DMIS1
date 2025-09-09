<div>
    <div class="row row-cards"> 
        <div class="col-12">
            <div class="card">
                @can ('create',App\Models\Admin\AdminPanel\ExpenseClass\ExpenseClass::class)
                
                <div class="card-header">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_expense_class">
                    Add New Expense Class
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
                    <table class="table card-table table-vcenter text-nowrap datatable">
                    <thead>
                        <tr>
                            <th class="text-center">Id</th>
                            <th class="text-center">Expense Class</th>
                            <th class="text-center w-1">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($ExpenseClasses as $Index => $ExpenseClass)
                        <tr>
                            <td class="text-center">{{ $ExpenseClass->id }}</td>
                            <td class="text-center">{{ $ExpenseClass->expense_class }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    @can ('update', $ExpenseClass)
                                    <a href="" class="btn btn-sm btn-primary" wire:click.prevent="editExpenseClass({{$ExpenseClass->id}})">Edit</a> &nbsp;
                                    @endcan
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
                        @endforelse
                    
                        
                    </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex align-items-center">
                    {{ $ExpenseClasses->links('livewire::bootstrap') }}
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal modal-blur fade" id="add_expense_class" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <form class="modal-content" method="POST"
                @if($updateExpense)
                    wire:submit.prevent='updateExpenseClass()'
                @else
                    wire:submit.prevent="addExpenseClass()"
                @endif
            >
            <div class="modal-header">
              <h5 class="modal-title"> {{ $updateExpense ? 'Update Expense Class ' : 'Add Expense Class'}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
    
                <div class="mb-3">
                    <label class="form-label">Expense Class</label>
                    <input type="text" class="form-control" name="expense_class" placeholder="Enter Expense Class" wire:model="expense_class">
                    <span class="text-danger"> @error('expense_class')
                        {{ $message }}
                        
                      @enderror</span>   
    
                </div>  
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">{{ $updateExpense ? 'Update' : 'Save'}}</button>
            </div>
        </form>
        </div>
    </div>


</div>
