<div>
    <div class="row row-cards"> 
        <div class="col-12">
            <div class="card">
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
                        <input type="text" class="form-control form-control-sm" aria-label="Search" wire:model='Search' placeholder="Search To UACS Code">
                        </div>
                    </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                    <thead> 
                        <tr>
                            <th class="text-center" rowspan="2">id</th>
                            <th class="text-center" rowspan="2">Year</th>
                            <th class="text-center" rowspan="2">Expense Class</th>
                            <th class="text-center" rowspan="2">P/A/P</th>
                            <th class="text-center" colspan="3">From UACS</th>
                            <th class="text-center" colspan="3">To UACS</th>
                            <th class="text-center" rowspan="2">Created At</th>
                        </tr>
                        <tr>
                            <th class="text-center">UACS Code</th>
                            <th class="text-center">Old Balance</th>
                            <th class="text-center">New Balance</th>
                            <th class="text-center">UACS Code</th>
                            <th class="text-center">Old Balance</th>
                            <th class="text-center">New Balance</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($Realignments as $Index => $Realignment)
                        <tr>
        
                            <td class="text-center" data-label="Id">{{ $Realignment->id }}</td>
                            <td class="text-center" data-label="Year">{{ $Realignment->UACSAllocation->PAPAllocation->year }}</td>
                            <td class="text-center" data-label="Expense Class">{{ $Realignment->UACSAllocation->PAPAllocation->ExpenseClass->expense_class }}</td>
                            <td class="text-center" data-label="P/A/P">{{ $Realignment->UACSAllocation->PAPAllocation->Pap->pap }}</td>
                            <td class="text-center" data-label="From UACS - UACS Code">{{ $Realignment->UACSAllocation->uacs->uacs }}</td>
                            <td class="text-center" data-label="From UACS - Old Balance">{{ number_format($Realignment->from_old_balance,2,'.',',') }}</td>
                            <td class="text-center" data-label="From UACS - New Balance">{{ number_format($Realignment->from_new_balance,2,'.',',') }}</td>
                            <td class="text-center" data-label="To UACS - UACS Code"> {{ $Realignment->UACS->uacs }}</td>
                            <td class="text-center" data-label="TO UACS - Old Balance">{{ number_format($Realignment->to_old_balance,2,'.',',') }}</td>
                            <td class="text-center" data-label="TO UACS - New Balance">{{ number_format($Realignment->to_new_balance,2,'.',',') }}</td>
                            <td class="text-center" data-label="Created At">{{ $Realignment->created_at }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                <span class="text-center text-danger">
                                   No Realignment found.
                               </span> 
                           </td>
                        </tr>
                        @endforelse
                    
                        
                    </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex align-items-center">
                    {{ $Realignments->links('livewire::bootstrap') }}
                </div>
            </div>
        </div>
    </div>

</div>
