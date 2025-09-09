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
                            <th class="text-center">ID</th>
                            <th class="text-center">Year</th>
                            <th class="text-center">SAA Number</th>
                            <th class="text-center">P/A/P</th>
                            <th class="text-center">Expense Class</th>
                            <th class="text-center">Office</th>
                            <th class="text-center">UACS</th>
                            <th class="text-center">Purpose</th>
                            <th class="text-center">Amount</th>
                            <th class="text-center">Remaining Balance</th>
                            <th class="text-center w-1">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($Allocations as $Index => $Allocation)
                        <tr>
                            <td class="text-center" data-label="Id">{{ $Allocation->id }}</td>
                            <td class="text-center" data-label="Year">{{ $Allocation->year }}</td>
                            <td class="text-center" data-label="SAA Number">{{ $Allocation->saa_no }}</td>
                            <td class="text-center" data-label="P/A/P">{{ $Allocation->pap->pap }}</td>
                            <td class="text-center" data-label="Expense Class">{{ $Allocation->ExpenseClass->expense_class }}</td>
                            <td class="text-center" data-label="Office">{{ $Allocation->Office->office }}</td>
                            <td class="text-center" data-label="UACS">{{ $Allocation->UACS->uacs }}</td>
                            <td class="text-center" data-label="Purpose">{{ $Allocation->purpose }}</td>
                            <td class="text-center" data-label="Amount"><strong> {{ number_format($Allocation->amount,2,'.',',') }}</strong></td>
                            <td class="text-center" data-label="Remaining Balance"><strong> {{ number_format($Allocation->rem_bal,2,'.',',') }}</strong></td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="" class="btn btn-sm btn-success" wire:click.prevent="editAllocation({{$Allocation->id}})">Edit</a> 
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                <span class="text-center text-danger">
                                   No Voucher found.
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
                @if($updateAllocation)
                    wire:submit.prevent='updateAllocation()'
                @else
                    wire:submit.prevent="addAllocation()"
                @endif
            >
            <div class="modal-header">
              <h5 class="modal-title"> {{ $updateAllocation ? 'Update Allocation ' : 'Add Allocation'}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
    
                @if($updateAllocation == false)
                    <div class="mb-3">
                        <label class="form-label">Office </label>
                        <select class="form-select" wire:model="selectedOffice">
                                <option value="" selected>--- Choose Office ---</option>

                                @forelse ($Office_ids as $Office)
                                    <option value="{{ $Office->id }}">{{ $Office->office }}</option>
                                @empty
                                    
                                @endforelse
                    
                        </select>
                        <span class="text-danger"> @error('selectedOffice')
                            {{ $message }}
                            
                        @enderror</span> 
                    </div>

                    @if(!is_null($selectedOffice))
                    <div class="mb-3">
                        <label class="form-label">Expense Class </label>
                        <select class="form-select" wire:model="selectedExpenseClass">
                                <option value="" selected>--- Choose Expense Class ---</option>

                                @forelse ($expense_class_ids as $Expense)
                                    <option value="{{ $Expense->id }}">{{ $Expense->expense_class }}</option>
                                @empty
                                    
                                @endforelse
                    
                        </select>

                        <span class="text-danger"> @error('selectedExpenseClass')
                            {{ $message }}
                            
                        @enderror</span>
                    </div>
                    @endif
                    

                    @if(!is_null($selectedExpenseClass))
                    <div class="mb-3">
                        <label class="form-label">P/A/P </label>
                        <select class="form-select" wire:model="selectedPAP">
                                <option value="" selected>--- Choose PAP ---</option>

                                @forelse ($pap_ids as $PAP)
                                    <option value="{{ $PAP->id }}">{{ $PAP->pap }}</option>
                                @empty
                                    
                                @endforelse
                    
                        </select>
                        <span class="text-danger"> @error('selectedPAP')
                            {{ $message }}
                            
                        @enderror</span> 
                    </div>
                    @endif

                    @if(!is_null($selectedPAP))
                    <div class="mb-3">
                        <label class="form-label">UACS </label>
                        <select class="form-select" wire:model="selectedUACS">
                                <option value="" selected>--- Choose UACS ---</option>

                                @forelse ($uacs_ids as $UACS)
                                    <option value="{{ $UACS->id }}">{{ $UACS->uacs }}</option>
                                @empty
                                    
                                @endforelse
                    
                        </select>
                        <span class="text-danger"> @error('selectedUACS')
                            {{ $message }}
                            
                        @enderror</span> 
                    </div>
                    @endif


                    @if(!is_null($selectedUACS))
                    <div class="mb-3">
                        <label class="form-label">Year</label>
                        <input type="number" class="form-control" name="year" placeholder="Enter Year" wire:model="selectedYear" step="1">
                        <span class="text-danger"> @error('selectedYear')
                            {{ $message }}
                            
                        @enderror</span> 
                    </div> 
                    @endif

{{-- 
                    @if(!is_null($selectedUACS) && !is_null($selectedYear && $updateAllocation == true))
                    <div class="mb-3">
                        <label class="form-label">Allocation Amount</label>
                        <input type="text" class="form-control" wire:model="rem_bal" step="1">
                        <span class="text-danger"> @error('rem_bal')
                            {{ $message }}
                            
                        @enderror</span> 
                    </div> 

                    @endif --}}


                    @if(!is_null($selectedUACS) && !is_null($selectedYear))
                    <div class="dropdown-divider"></div>

                    
                    <div class="mb-3">
                        <label class="form-label"> SAA Number</label>
                        <input type="text" class="form-control" name="amount" placeholder="Enter SAA Number" wire:model="saa_no">
                        <span class="text-danger"> @error('saa_no')
                            {{ $message }}
                            
                        @enderror</span> 
                    </div>  


                    <div class="mb-3">
                        <label class="form-label">Purpose</label>
                        <input type="text" class="form-control" name="purpose" placeholder="Enter Purpose" wire:model="purpose">
                        <span class="text-danger"> @error('purpose')
                            {{ $message }}
                            
                        @enderror</span> 
                    </div>  


                    <div class="mb-3">
                        <label class="form-label"> Allocation Amount</label>
                        <input type="number" class="form-control" name="amount" placeholder="Enter Allocation Amount" wire:model="amount">
                        <span class="text-danger"> @error('amount')
                            {{ $message }}
                            
                        @enderror</span> 
                    </div>  
                    @endif
                
                @else

                <div class="mb-3">
                    <label class="form-label">Allocation Amount</label>
                    <input type="text" class="form-control" wire:model="amount" step="1" readonly>
                    <span class="text-danger"> @error('amount')
                        {{ $message }}
                        
                    @enderror</span> 
                </div> 

                <div class="mb-3">
                    <label class="form-label">Remaining Balance</label>
                    <input type="text" class="form-control" wire:model="rem_bal" step="1" readonly>
                    <span class="text-danger"> @error('rem_bal')
                        {{ $message }}
                        
                    @enderror</span> 
                </div> 

                <div class="dropdown-divider"></div>


                <div class="mb-3">
                    <label class="form-label">Allocation</label>
                    <input type="text" class="form-control" wire:model="new_amount" step="1">
                    <span class="text-danger"> @error('new_amount')
                        {{ $message }}
                        
                        @enderror</span> 

                </div> 
             
                @endif


            </div>
            <div class="modal-footer">
              <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">{{ $updateAllocation ? 'Update' : 'Save'}}</button>

     
            </div>
        </form>
        </div>
    </div>



</div>
