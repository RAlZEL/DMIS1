<div>
    <div class="row row-cards"> 
        <div class="col-12">
            <div class="card">

            @can('createAllocation', App\Models\FinancialManagement\voucher::class)
                <div class="card-header">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_allocation">
                    Add New Allocation
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
                            <th class="text-center">Id</th>
                            <th class="text-center">Year</th>
                            <th class="text-center">Expense Class</th>
                            <th class="text-center">Office</th>
                            <th class="text-center">P/A/P</th>
                            <th class="text-center">Amount</th>
                            <th class="text-center">Remaining Balance (UACS)</th>
                            <th class="text-center">Remaining Balance (Activity)</th>
                            <th class="text-center w-1">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($Allocations as $Index => $Allocation)
                        <tr>
                            <td class="text-center" data-label="Id">{{ $Allocation->id }}</td>
                            <td class="text-center" data-label="Year">{{ $Allocation->year }}</td>
                            <td class="text-center" data-label="Expense Class">{{ $Allocation->ExpenseClass->expense_class }}</td>
                            <td class="text-center" data-label="Office">{{ $Allocation->Office->office }}</td>
                            <td class="text-center" data-label="P/A/P">{{ $Allocation->PAP->pap }}</td>
                            <td class="text-center" data-label="Amount"><strong> {{ number_format($Allocation->amount,2,'.',',') }}</strong></td>
                            <td class="text-center" data-label="Remaining Balance (UACS)">{{ number_format($Allocation->rem_bal_uacs,2,'.',',') }}</td>
                        
                            <td class="text-center" data-label="Remaining Balance (Activity)">{{number_format($Allocation->rem_bal_activity,2,'.',',') }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    @can('updateAllocation', App\Models\FinancialManagement\voucher::class)
                                    <a href="" class="btn btn-sm btn-warning" wire:click.prevent="editPAP({{$Allocation->id}})">Edit</a>&nbsp;
                                    <a href="" class="btn btn-sm btn-danger" wire:click.prevent="deletePAP({{$Allocation->id}})">Delete</a>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">
                                <span class="text-center text-danger">
                                   No Allocation found.
                               </span> 
                           </td>
                        </tr>
                        @endforelse
                    
                        
                    </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex align-items-center">
                    {{ $Allocations->links('livewire::bootstrap') }}
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal modal-blur fade" id="add_allocation" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <form class="modal-content" method="POST"
                @if($updatePAP)
                    wire:submit.prevent='updateAllocation()'
                @else
                    wire:submit.prevent="addAllocation()"
                @endif
            >
            <div class="modal-header">
              <h5 class="modal-title"> {{ $updatePAP ? 'Update Allocation ' : 'Add Allocation'}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
    
                <div class="mb-3">
                    <label class="form-label">Office </label>
                    <select class="form-select" wire:model="office">

                        @if($updatePAP) 

                        <option value="{{ $office }}" selected>{{ $office }}</option>


                        @else
                        <option value="" selected>--- Choose Office ---</option>

                        @forelse ($Offices as $Office)
                            <option value="{{ $Office->id }}">{{ $Office->office }}</option>
                        @empty
                            
                        @endforelse
            
                        @endif
                           
                    </select>
                    <span class="text-danger"> @error('Office')
                        {{ $message }}
                          
                      @enderror</span> 
                </div>

                <div class="mb-3">
                    <label class="form-label">Expense Class </label>
                    <select class="form-select" wire:model="expense_class">
               

                            @if($updatePAP) 

                            <option value="{{ $expense_class }}" selected>{{ $expense_class }}</option>
                            @else
                            <option value="" selected>--- Choose Expense Class ---</option>
                            @forelse ($ExpenseClasses as $ExpenseClass)
                            <option value="{{ $ExpenseClass->id }}">{{ $ExpenseClass->expense_class}}</option>
                            @empty
                                
                            @endforelse
                            @endif

                             
                
                    </select>

                    <span class="text-danger"> @error('expense_class')
                        {{ $message }}
                          
                      @enderror</span>
                </div>

                


                <div class="mb-3">
                    <label class="form-label">P/A/P </label>
                    <select class="form-select" wire:model="papid">
                       
                            @if($updatePAP) 
                            <option value="{{ $papid }}" selected>{{ $papid }}</option>
                            @else
                            <option value="" selected>--- Choose PAP ---</option>
                            @forelse ($PAPs as $PAP)

                            <option value="{{ $PAP->id }}">{{ $PAP->pap }}</option>
                        @empty
                            
                        @endforelse

                            @endif
                          
                
                    </select>
                    <span class="text-danger"> @error('papid')
                        {{ $message }}
                          
                      @enderror</span> 
                </div>

                <div class="mb-3">
                    <label class="form-label">Year</label>
                    @if($updatePAP) 

                    <input type="number" class="form-control" name="year" placeholder="Enter Year" wire:model="year" readonly>
                    @else
                    <input type="number" class="form-control" name="year" placeholder="Enter Year" wire:model="year">
                    @endif
                    <span class="text-danger"> @error('year')
                        {{ $message }}
                          
                      @enderror</span> 
                </div>  
                 
                <div class="mb-3">
                    <label class="form-label">Amount</label>
                    <input type="number" class="form-control" name="amount" placeholder="Enter Allocation Amount" wire:model="amount">
                    <span class="text-danger"> @error('amount')
                        {{ $message }}
                          
                      @enderror</span> 
                </div>  
                 
                 

            </div>
            <div class="modal-footer">
              <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">{{ $updatePAP ? 'Update' : 'Save'}}</button>
            </div>
        </form>
        </div>
    </div>

    <div wire:ignore.self class="modal modal-blur fade" id="delete_allocation" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
          <form class="modal-content" method="POST"     wire:submit.prevent='destroyAllocation()'>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-danger"></div>
            <div class="modal-body text-center py-4">
              <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v2m0 4v.01" /><path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" /></svg>
              <h3>Are you sure?</h3>
              <div class="text-muted">Do you really want to delete this Allocation.</div>
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
