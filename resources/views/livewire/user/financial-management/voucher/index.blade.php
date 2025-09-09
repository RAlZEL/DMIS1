<div>
    <form action="" method="POST" wire:submit.prevent='createVoucher()'>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Voucher Information</h3>
                                      
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Date Created :<span class="text-danger">*</span></label>
                                <input type="date" class="form-control" wire:model="date_created" readonly>
                                <span class="text-danger"> 
                                    @error('datereceived')
                                        {{ $message }}   
                                    @enderror
                                </span>
                            </div>
                      
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label"> Office :<span class="text-danger">*</span></label>
                              
                                <select class="form-select" wire:model="office">
                                    <option value="" selected>--- Choose Office ---</option>
            
                                    @forelse ($Offices as $Office)
                                        <option value="{{ $Office->id }}">{{ $Office->office}}</option>
                                
                        
                                        
                                    @empty
                                        
                                    @endforelse
                                </select>
                                
                                <span class="text-danger"> 
                                    @error('office')
                                        {{ $message }}   
                                        @enderror
                                </span>
                            
                            </div>
                   
                        </div>
                    </div>

                    @if($office)
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Office Address :<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" wire:model="address" readonly>
                                <span class="text-danger"> 
                                    @error('address')
                                        {{ $message }}   
                                    @enderror
                                </span>
                            </div>
                         
                        </div>
                    </div>
                    @endif


                    
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label"> Account Name :<span class="text-danger">*</span></label>
                              
                                <select class="form-select" wire:model="selectedAccount">
                                    <option value="" selected>--- Choose Account Name ---</option>
            
                                    @forelse ($accountids as $Account)
                                        <option value="{{ $Account->id }}">{{ $Account->acct_name}}</option>
                                
                    
                                        
                                    @empty
                                        
                                    @endforelse
                                </select>
                                
                                <span class="text-danger"> 
                                    @error('selectedAccount')
                                        {{ $message }}   
                                        @enderror
                                </span>
                            
                            </div>
                   
                        </div>
                    </div>

                    @if ($selectedAccount)
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label"> Account Number :<span class="text-danger">*</span></label>
                              
                                <select class="form-select" wire:model="selectedAccountNo">
                                    <option value="" selected>--- Choose Account Number ---</option>
                                @if ($accoutnumbers->count() != 0)
                                    @forelse ($accoutnumbers as $Account)
                                        <option value="{{ $Account->id }}">{{ $Account->bank_name . ' - ' . $Account->acct_no }}</option>
         
                                    @empty
                                
                                    @endforelse
                                @else
                                <option value="" selected disabled>No Account Number Enrolled</option>
                                @endif
                                    
                                </select>
                                <span class="text-danger"> 
                                    @error('selectedAccountNo')
                                        {{ $message }}   
                                        @enderror
                                </span>
                            
                            </div>
                   
                        </div>
                    </div>
                    @endif
                   


                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Particulars :<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="Enter Particulars" wire:model="particulars">
                                <span class="text-danger"> 
                                    @error('particulars')
                                        {{ $message }}   
                                    @enderror
                                </span>
                            </div>
                         
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Remarks :</label>
                                <input type="text" class="form-control" placeholder="Enter Remarks" wire:model="remarks">
                                <span class="text-danger"> 
                                    @error('remarks')
                                        {{ $message }}   
                                    @enderror
                                </span>
                            </div>
                         
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Amount :<span class="text-danger">*</span></label>
                                <input type="number" class="form-control" placeholder="Enter Amount" wire:model="amount">
                                <span class="text-danger"> 
                                    @error('amount')
                                        {{ $message }}   
                                    @enderror
                                </span>
                            </div>
                         
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label"> Certified By (Box-A-DV) :<span class="text-danger">*</span></label>
                              
                                <select class="form-select" wire:model="certified_by_dv">
                                    <option value="" selected>--- Choose Name ---</option>
            
                                    @forelse ($certfiedBys as $Certify)
                                        <option value="{{ $Certify->id }}">{{ $Certify->certified_by . ' - ' . $Certify->position}}</option>
                                
                                       
                     
                                        
                                    @empty
                                        
                                    @endforelse
                                </select>
                                <span class="text-danger"> 
                                    @error('certified_by_dv')
                                        {{ $message }}   
                                        @enderror
                                </span>
                            
                            </div>
                   
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label"> Certified By (Box-A-ORS) :<span class="text-danger">*</span></label>
                              
                                <select class="form-select" wire:model="certified_by_ors">
                                    <option value="" selected>--- Choose Name ---</option>
            
                                    @forelse ($certfiedBys as $Certify)
                                        <option value="{{ $Certify->id }}">{{ $Certify->certified_by . ' - ' . $Certify->position }}</option>
                                
                                      
                      
                                        
                                    @empty
                                        
                                    @endforelse
                                </select>
                                <span class="text-danger"> 
                                    @error('certified_by_ors')
                                        {{ $message }}  
                                        @enderror
                                </span>
                            
                            </div>
                   
                        </div>
                    </div>


               

                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </div>
        </div>

      
    </form>

    @if(!is_null($newVoucher))
        <div wire:ignore.self class="modal modal-blur fade" id="view_voucher" tabindex="-1" role="dialog" aria-hidden="true"
            data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <form class="modal-content" method="POST" wire:submit.prevent='viewVoucher({{ $newVoucher->id}})'>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-status bg-success"></div>
                    <div class="modal-body text-center py-4">
                        <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->

                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                            <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"></path>
                         </svg>
                        <h3>View Voucher</h3>
                        <div class="text-muted">Do you  want to view New Created Voucher?</div>
                        <div>{{ $newVoucher->sequenceid }}</div>
                    </div>
                    <div class="modal-footer">
                        <div class="w-100">
                            <div class="row">
                                <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                        Cancel
                                    </a></div>
                                <div class="col">
                                    <button type="submit" class="btn btn-success w-100">View</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif

</div>
