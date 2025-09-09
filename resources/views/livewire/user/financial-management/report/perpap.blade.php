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
                        <input type="text" class="form-control form-control-sm" aria-label="Search" wire:model='Search'>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-vcenter table-mobile-md card-table">
                    <thead>
                        <tr>
                            <th  class="text-center">Year</th>
                            <th  class="text-center">Program</th>
                            <th  class="text-center">Expense Class</th>
                            
                            <th  class="text-center">Office</th>
                            <th  class="text-center">Allotment</th>
                            <th  class="text-center">Obligation</th>
                            <th  class="text-center">Disbursement</th>
                            <th  class="text-center">Balance</th>
                            <th  class="text-center">%Obligation/Allotment</th>
                            <th  class="text-center">%Disbursement/Obligation</th>
                            <th  class="text-center">%Disbursement/Allotment</th>
                        </tr>
                    </thead>
                    <tbody>
     
                     @forelse ($Reports as $Index => $Report)
                        <tr>
                            <td class="text-center" data-label="Year"> {{ $Report[11] }}</td>
                            <td class="text-center" data-label="Program"> {{ $Report[10] }}</td> 
                            <td class="text-center" data-label="Expense Class"> {{ $Report[9] }}</td>                            
                            <td class="text-center" data-label="Office"> {{ $Report[8] }}</td>
                            <td class="text-center" data-label="Allotment"> {{ $Report[7] }}</td>  
                                           
                            <td class="text-center" data-label="Obligation"> {{ $Report[0] }}</td>
                            <td class="text-center" data-label="Disbursement"> {{ $Report[2] }}</td>
                            <td class="text-center" data-label="Balance"> {{ $Report[5] }}</td>
                            <td class="text-center" data-label="%Obligation/Allotment"> {{ $Report[1] }}</td>
                            <td class="text-center" data-label="%Disbursement/Obligation"> {{ $Report[3] }}</td>
                            <td class="text-center" data-label="%Disbursement/Allotment"> {{ $Report[4] }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">
                                <span class="text-center text-danger">
                                   No PAP Allocation found.
                               </span> 
                           </td>
                        </tr>
                        @endforelse 
                    
                        
                    </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex align-items-center">
                    {{-- {{ $Offices->links('livewire::bootstrap') }} --}}
                </div>
            </div>
        </div>
    </div>
</div>
