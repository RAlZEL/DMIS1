<div>
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
                            <input type="text" class="form-control form-control-sm" aria-label="Search" wire:model='Search' placeholder="Search Activity">
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
                                <th class="text-center">Acitivity Name</th>
                                <th class="text-center">Amount</th>
                                <th class="text-center">Remaining Balance</th>
                                <th class="text-center w-1">Action</th>
                            </tr>
                        </thead>
                        <tbody>
    
                            @forelse ($Allocations as $Index => $Allocation)
                            <tr>
                                <td class="text-center" data-label="Id">{{ $Allocation->id }}</td>
                                <td class="text-center" data-label="Year">{{ $Allocation->PAPAllocation->year }}</td>
                                <td class="text-center" data-label="Expense Class">{{ $Allocation->PAPAllocation->ExpenseClass->expense_class }}</td>
                                <td class="text-center" data-label="Office">{{ $Allocation->PAPAllocation->Office->office }}</td>
                                <td class="text-center" data-label="P/A/P">{{ $Allocation->PAPAllocation->pap->pap }}</td>
                                <td class="text-center" data-label="Activity Name">{{ $Allocation->Activity->activity }}</td>
                                <td class="text-center" data-label="Amount"><strong> {{ number_format($Allocation->amount,2,'.',',') }}</strong></td>
                            
                                <td class="text-center" data-label="Remaining Balance">{{number_format($Allocation->rem_bal,2,'.',',') }}</td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        @can('updateAllocation', App\Models\FinancialManagement\voucher::class)
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
                        {{-- {{ $Allocations->links('livewire::bootstrap') }} --}}
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
                                    <option value="{{ $Expense[0] }}">{{ $Expense[1] }}</option>
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
                                    <option value="{{ $PAP[0] }}">{{ $PAP[1] }}</option>
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
                        <label class="form-label">Year </label>
                        <select class="form-select" wire:model="selectedYear">
                                <option value="" selected>--- Choose Year ---</option>
    
                                @forelse ($year_ids as $year)
                                    <option value="{{ $year->year }}">{{ $year->year }}</option>
                                @empty
                                    
                                @endforelse
                    
                        </select>
                        <span class="text-danger"> @error('selectedYear')
                            {{ $message }}
                              
                          @enderror</span> 
                    </div>
                    @endif


                    @if(!is_null($selectedYear))
                    <div class="mb-3">
                        <label class="form-label">Remaining Activity Balance</label>
                        <input type="text" class="form-control" name="amount" placeholder="Enter Allocation Amount" wire:model="rem_bal" readonly>
                        <span class="text-danger"> @error('rem_bal')
                            {{ $message }}
                              
                          @enderror</span> 
                    </div>  
                    @endif
                    <div class="dropdown-divider"></div>
                    @if(!is_null($selectedYear))
                    <div class="mb-3">
                        <label class="form-label">Activity </label>
                        <select class="form-select" wire:model="selectedActivity">
                                <option value="" selected>--- Choose Activity ---</option>
    
                                @forelse ($activity_ids as $activity)
                                    <option value="{{ $activity->id }}">{{ $activity->activity }}</option>
                                @empty
                                    
                                @endforelse
                    
                        </select>
                        <span class="text-danger"> @error('selectedActivity')
                            {{ $message }}
                              
                          @enderror</span> 
                    </div>
                    @endif



                    @if(!is_null($rem_bal))
                    <div class="mb-3">
                        <label class="form-label">Allocation Amount</label>
                        <input type="number" class="form-control" name="amount" placeholder="Enter Allocation Amount" wire:model="amount" step="0.01">
                        <span class="text-danger"> @error('amount')
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
    


        <div wire:ignore.self class="modal modal-blur fade" id="activity_add_confirm" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
              <form class="modal-content" method="POST"     wire:submit.prevent='addConfirmAllocation()'>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-status bg-danger"></div>
                <div class="modal-body text-center py-4">
                  <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v2m0 4v.01" /><path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" /></svg>
                  <h3>Allocation have Record.</h3>
                  <div class="text-muted">Do you want to add allocation amount to the exisiting Allocation?</div>
                </div>
                <div class="modal-footer">
                  <div class="w-100">
                    <div class="row">
                      <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                          Cancel
                        </a></div>
                      <div class="col"> 
                        <button type="submit" class="btn btn-danger w-100">Confirm</button>  
                       </div>
                    </div>
                  </div>
                </div>
            </form>
            </div>
        </div>
    
    </div>
    
</div>
