<div>
    <div class="col-12">
        <div class="card mt-2">
            <div class="card-header">

             

                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="true">
                        Actions
                    </button>
                    <div class="dropdown-menu dropdown-menu-demo"  data-bs-popper="none">
                        @can ('AddCharging',$selected_voucher)
                     
                        <div class="hr-text m-1">Charging</div>

                     
                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#charging_gaa">
                            
                            <span class="mx-2">GAA</span>
                        </a>
                             <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#charging_saa">
                              
                            <span class="mx-2">SAA</span>
                        </a>
                        <div class="dropdown-divider"></div>  
                        @endcan

                        
                        @can ('addAccountingEntry',$selected_voucher)
                     
                                            
                            <div class="hr-text m-1">Accounting Entry</div>

                        
                            <a class="dropdown-item" wire:click.prevent="DVNumber()">
                                
                                <span class="mx-2">DV Number</span>
                                @if(!is_null($selected_voucher->DVNumber))
                                <span class="badge bg-green ms-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M5 12l5 5l10 -10"></path>
                                     </svg>
                                </span>
                                @endif
                            </a>
                            <a class="dropdown-item" wire:click.prevent="AccountingEntry()">
                                
                                <span class="mx-2">Accounting Entry</span>
                                @if(!is_null($selected_voucher->AccountingEntry))
                                <span class="badge bg-green ms-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M5 12l5 5l10 -10"></path>
                                     </svg>
                                </span>
                                @endif
                            </a>
                            <a class="dropdown-item" wire:click.prevent="BoxD()">
                                
                                <span class="mx-2"> BOX D Signatory</span>
                                @if(!is_null($selected_voucher->BoxD))
                                <span class="badge bg-green ms-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M5 12l5 5l10 -10"></path>
                                     </svg>
                                </span>
                                @endif
                                
                            </a>
                            <a class="dropdown-item" wire:click.prevent="ReviewDocuments()">
                                
                                <span class="mx-2">Review of Docs</span>
                                @if(!is_null($selected_voucher->ReviewOfDocuments))
                                <span class="badge bg-green ms-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M5 12l5 5l10 -10"></path>
                                     </svg>
                                </span>
                                @endif
                            </a>
                            <div class="dropdown-divider"></div>  

                        @endcan

                        @can ('addADA',$selected_voucher)
                     
                                          
                        <a class="dropdown-item" wire:click.prevent="CheckAda()">
                            
                            <span class="mx-2">Check / ADA </span>
                            @if(!is_null($selected_voucher->CheckAda))
                            <span class="badge bg-green ms-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M5 12l5 5l10 -10"></path>
                                 </svg>
                            </span>
                            @endif

                        </a>

                        <a class="dropdown-item" wire:click.prevent="disburse()">
                            
                            <span class="mx-2">Disburse Voucher </span>

                        </a>


                        <div class="dropdown-divider"></div>  

                        @endcan
                        
                        @can ('approveVoucher',$selected_voucher)
                     
                                          
                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#approve_voucher">
                            
                            <span class="mx-2">Approve Voucher</span>
                        </a>
                        <div class="dropdown-divider"></div>  
                        @endcan
                        


                        @can ('addORS',$selected_voucher)
                     
                                          
                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#add_ors_details">
                            
                            <span class="mx-2">ORS Details</span>
                            @if(!is_null($selected_voucher->ORSDetails))
                            <span class="badge bg-green ms-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M5 12l5 5l10 -10"></path>
                                 </svg>
                            </span>
                            @endif
                        </a>
                        <div class="dropdown-divider"></div>  
                        @endcan
                        
                  
                 
                        @can ('AcceptIncoming', $selected_voucher)
                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#accept_voucher">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M5 12l5 5l10 -10"></path>
                             </svg>
                            <span class="mx-2">Accept Voucher</span>
                        </a>

                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#reject_voucher">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-ban" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                <path d="M5.7 5.7l12.6 12.6"></path>
                             </svg>
                            <span class="mx-2">Reject Voucher</span>
                        </a>

                        <div class="dropdown-divider"></div>
                        @endcan

                    

                          {{--     @can ('markasclosed',$selected_voucher)
             
                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#close_document">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-off" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M3 3l18 18"></path>
                                <path d="M7 3h7l5 5v7m0 4a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-14"></path>
                             </svg>
                            <span class="mx-2">Close Document</span>
                        </a>

                        <div class="dropdown-divider"></div>
                        @endcan
           --}}


                        {{-- @can ('addAttachment',$selected_voucher)
                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#add_attachment">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-paperclip"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path
                                    d="M15 7l-6.5 6.5a1.5 1.5 0 0 0 3 3l6.5 -6.5a3 3 0 0 0 -6 -6l-6.5 6.5a4.5 4.5 0 0 0 9 9l6.5 -6.5">
                                </path>
                            </svg>
                            <span class="mx-2">Add Attachment</span>
                        </a>
                        @endcan
                        <a class="dropdown-item"
                            href="{{ route('document-tracking.documentprint',[$selected_voucher->id]) }}"
                            rel="noopener" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path
                                    d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2">
                                </path>
                                <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
                                <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z">
                                </path>
                            </svg>
                            <span class="mx-2">Print</span>
                        </a> --}}
      
                        @can ('addRoute',$selected_voucher)
         
      

                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#add_route">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-route"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                <path d="M18 5m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                <path d="M12 19h4.5a3.5 3.5 0 0 0 0 -7h-8a3.5 3.5 0 0 1 0 -7h3.5"></path>
                            </svg>
                            <span class="mx-2">Add Route</span>
                        </a>
                        @endcan

                        <a class="dropdown-item"  href="{{ route('user.financialDVPrint',[$selected_voucher->id]) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path>
                                <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
                                <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z"></path>
                             </svg>
                            <span class="mx-2">Print DV</span>
                        </a>
            
                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#print_ors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path>
                                <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
                                <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z"></path>
                             </svg>
                            <span class="mx-2">Print ORS</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-2">
            <div class="card-body">

                {{-- <div class="card-header">
                    <h3>Voucher Information</h3>
                    <div class="card-actions">
                        @can ('update', $selected_voucher)
                        <a href="" data-bs-toggle="modal" data-bs-target="#edit_document">
                            Edit Voucher
                            <!-- Download SVG icon from http://tabler-icons.io/i/edit -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3"></path>
                                <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3"></path>
                                <line x1="16" y1="5" x2="19" y2="8"></line>
                            </svg>
                        </a>
                        @endcan
                        @can ('delete', $selected_document)
                        <a href="" class="text-danger" data-bs-toggle="modal" data-bs-target="#delete_document">
                            Delete Document
                            <!-- Download SVG icon from http://tabler-icons.io/i/edit -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M4 7l16 0"></path>
                                <path d="M10 11l0 6"></path>
                                <path d="M14 11l0 6"></path>
                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                            </svg>
                        </a>
                        @endcan


                      
                    </div>
                </div> --}}

                <div class="card-body">

                    <div class="row invoice-info mb-2">
                        <div class="col-sm-2 invoice-col">
                            <strong> Date Created </strong>
                        </div>
                        <div class="col-sm-10 invoice-col">
                            {{ $date_created }}
                        </div>
                    </div>

                    <div class="row invoice-info mb-2">
                        <div class="col-sm-2 invoice-col">
                            <strong> Sequence ID  </strong>
                        </div>
                        <div class="col-sm-10 invoice-col">
                            {{ $sequenceid }}
                        </div>
                    </div>

                    <div class="dropdown-divider"></div>
                    <div class="row invoice-info mb-2">
                        <div class="col-sm-2 invoice-col">
                            <strong> Office </strong>
                        </div>
                        <div class="col-sm-10 invoice-col">
                            {{ $office }}
                        </div>
                    </div>

                    <div class="row invoice-info mb-2">
                        <div class="col-sm-2 invoice-col">
                            <strong> Address </strong>
                        </div>
                        <div class="col-sm-10 invoice-col">
                            {{ $address }}
                     
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="row invoice-info mb-2">
                        <div class="col-sm-2 invoice-col">
                            <strong> Account Name </strong>
                        </div>
                        <div class="col-sm-10 invoice-col">
                            {{ $acct_id }}
                        </div>
                    </div>

                    <div class="row invoice-info mb-2">
                        <div class="col-sm-2 invoice-col">
                            <strong> Account Number </strong>
                        </div>
                        <div class="col-sm-10 invoice-col">
                            {{ $acct_no }}
                        </div>
                    </div>

                    <div class="dropdown-divider"></div>

                    <div class="row invoice-info mb-2">
                        <div class="col-sm-2 invoice-col">
                            <strong> Particulars </strong>
                        </div>
                        <div class="col-sm-10 invoice-col">
                            {{ $particulars }}
                        </div>
                    </div>

                    <div class="row invoice-info mb-2">
                        <div class="col-sm-2 invoice-col">
                            <strong> Amount </strong>
                        </div>
                        <div class="col-sm-10 invoice-col">
                            {{number_format($amount,2,'.',',') }}

                        </div>
                    </div>

                    @if(!is_null($remarks))
                        <div class="row invoice-info mb-2">
                            <div class="col-sm-2 invoice-col">
                                <strong> Remarks </strong>
                            </div>
                            <div class="col-sm-10 invoice-col">
                                {{ $remarks }}
                            </div>
                        </div>
                    @endif
            
                </div>

            </div>
        </div>

        @if($ChargingActivities->count() != 0 || $ChargingUACS->count() != 0 || $ChargingSAA->count() != 0  );
        {{-- @if (!is_null($ChargingActivities) || !is_null($ChargingUACS) || !is_null($ChargingSAA)) --}}
        <div class="card mt-2">
            <div class="card-header">
                <strong> Charging </strong>
            </div>
            <div class="card-body">
                <div class="card">
                    <ul class="nav nav-tabs nav-fill" data-bs-toggle="tabs">
                        @if ($ChargingActivities->count() != 0)
                            <li class="nav-item">
                                <a href="#tabs-activity-charging" class="nav-link active" data-bs-toggle="tab" wire:ignore>GAA - Activity
                                </a>
                            </li>
                        @endif
                        @if ($ChargingUACS->count() != 0)
                      <li class="nav-item">
                        <a href="#tabs-uacs-charging" class="nav-link" data-bs-toggle="tab" wire:ignore>GAA - UACS
                        </a>
                      </li>
                      @endif
                      @if ( $ChargingSAA->count() != 0  )
                      <li class="nav-item">
                        <a href="#tabs-saa-charging" class="nav-link" data-bs-toggle="tab" wire:ignore>SAA
                        </a>
                      </li>
                      @endif
                    </ul>
                    <div class="card-body">
                      <div class="tab-content">
                        @if ($ChargingActivities->count() != 0)
                        <div class="tab-pane active show" id="tabs-activity-charging" wire:ignore.self>
                          <div>
                            <div class="table-responsive">
                                <table
                                      class="table table-vcenter">
                                  <thead>
                                    <tr>
                                        <th class="text-center">Id</th>
                                        <th class="text-center">Year</th>
                                        <th class="text-center">Expense Class</th>
                                        <th class="text-center">Office</th>
                                        <th class="text-center">P/A/P</th>
                                        <th class="text-center">Acitivity Name</th>
                                        <th class="text-center">Charging Amount</th>
                                        <th></th>
                                     
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @forelse ($ChargingActivities as $index => $Charging)
                                    <tr>
                                      <td class="text-center">{{ $index + 1}}</td>
                                      <td class="text-center"> {{ $Charging->Allocation->PAPAllocation->year }}</td>
                                      <td class="text-center"> {{ $Charging->Allocation->PAPAllocation->ExpenseClass->expense_class }}</td>
                                      <td class="text-center"> {{ $Charging->Allocation->PAPAllocation->Office->office }}</td>
                                      <td class="text-center"> {{ $Charging->Allocation->PAPAllocation->PAP->pap }}</td>
                                      <td class="text-center"> {{ $Charging->Allocation->Activity->activity }}</td>
                                      <td class="text-center">     {{number_format($Charging->amount,2,'.',',') }}</td>
                                      
                                        <td>
                                            @can ('destroyCharging', $selected_voucher)
                                            <a href="" class="btn btn-sm btn-danger" wire:click.prevent="deleteActivityCharging({{$Charging->id}})">Delete</a>
                                            @endcan
                                        </td>
                              
                   
                                    </tr>
                                        
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center">
                                            <span class="text-center text-danger">
                                               No Activity Charging found.
                                           </span> 
                                       </td>
                                    </tr>
                                    @endforelse
                                    
                                  </tbody>
                                </table>
                              </div>
                          </div>
                        </div>
                        @endif
                        @if ($ChargingUACS->count() != 0)
                        <div class="tab-pane" id="tabs-uacs-charging" wire:ignore.self>
                          <div>
                            <div class="table-responsive">
                                <table
                                      class="table table-vcenter">
                                  <thead>
                                    <tr>
                                        <th class="text-center">Id</th>
                                        <th class="text-center">Year</th>
                                        <th class="text-center">Expense Class</th>
                                        <th class="text-center">Office</th>
                                        <th class="text-center">P/A/P</th>
                                        <th class="text-center">Acitivity Name</th>
                                        <th class="text-center">Charging Amount</th>
                                        <th></th>
                                     
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @forelse ($ChargingUACS as $index => $Charging)
                                    <tr>
                                      <td class="text-center">{{ $index + 1}}</td>
                                      <td class="text-center"> {{ $Charging->Allocation->PAPAllocation->year }}</td>
                                      <td class="text-center"> {{ $Charging->Allocation->PAPAllocation->ExpenseClass->expense_class }}</td>
                                      <td class="text-center"> {{ $Charging->Allocation->PAPAllocation->Office->office }}</td>
                                      <td class="text-center"> {{ $Charging->Allocation->PAPAllocation->PAP->pap }}</td>
                                      <td class="text-center"> {{ $Charging->Allocation->UACS->uacs }}</td>
                                      <td class="text-center">     {{number_format($Charging->amount,2,'.',',') }}</td>
                                      
                                        <td>
                                            @can ('destroyCharging', $selected_voucher)
                                            <a href="" class="btn btn-sm btn-danger" wire:click.prevent="deleteUACSCharging({{$Charging->id}})">Delete</a>
                                            @endcan
                                        </td>
                              
                   
                                    </tr>
                                        
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center">
                                            <span class="text-center text-danger">
                                               No UACS Charging found.
                                           </span> 
                                       </td>
                                    </tr>
                                    @endforelse
                                    
                                  </tbody>
                                </table>
                              </div>
                          </div>
                        </div>
                        @endif

                        @if ( $ChargingSAA->count() != 0  )
                        <div class="tab-pane" id="tabs-saa-charging" wire:ignore.self>
                            <div>
                                <div class="table-responsive">
                                    <table
                                          class="table table-vcenter">
                                      <thead>
                                        <tr>
                                            <th class="text-center">Id</th>
                                            <th class="text-center">Year</th>
                                            <th class="text-center">Expense Class</th>
                                            <th class="text-center">Office</th>
                                            <th class="text-center">P/A/P</th>
                                            <th class="text-center">Purpose</th>
                                            <th class="text-center">Charging Amount</th>
                                            <th></th>
                                         
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @forelse ($ChargingSAA as $index => $Charging)
                                        <tr>
                                          <td class="text-center">{{ $index + 1}}</td>
                                          <td class="text-center"> {{ $Charging->Allocation->year }}</td>
                                          <td class="text-center"> {{ $Charging->Allocation->ExpenseClass->expense_class }}</td>
                                            <td class="text-center"> {{ $Charging->Allocation->Office->office }}</td>
                                          <td class="text-center"> {{ $Charging->Allocation->pap->pap }}</td>
                                          <td class="text-center"> {{ $Charging->Allocation->purpose }}</td>
                                           <td class="text-center">     {{number_format($Charging->amount,2,'.',',') }}</td>
                                          
                                            <td>
                                                @can ('destroyCharging', $selected_voucher)
                                                <a href="" class="btn btn-sm btn-danger" wire:click.prevent="deleteSAACharging({{$Charging->id}})">Delete</a>
                                                @endcan
                                            </td>
                                  
                       
                                        </tr>
                                            
                                        @empty
                                        <tr>
                                            <td colspan="8" class="text-center">
                                                <span class="text-center text-danger">
                                                   No SAA Charging found.
                                               </span> 
                                           </td>
                                        </tr>
                                        @endforelse
                                        
                                      </tbody>
                                    </table>
                                  </div>

                           
                            </div>
                          </div>

                          @endif

                      </div>
                    </div>
                  </div>
            </div>  
        </div>
        @endif
  

        @if($selected_voucher->ORSDetails);

        <div class="card mt-2">
            <div class="card-header">
                <strong> ORS Details </strong>
            </div>
            <div class="card-body">
                <div class="card">

                    <div class="table-responsive">
                    <table
                            class="table table-vcenter">
                        <thead>
                        <tr>
                            <th class="text-center">Date</th>
                            <th class="text-center">Particulars</th>
                            <th class="text-center">ORS Number</th>
                            <th class="text-center">Fund Cluster</th>
                            <th class="text-center">Obligation</th>
                            <th class="text-center">Payable</th>
                            <th class="text-center">Payment</th>
                            <th class="text-center">Not Yet Due</th>
                            <th class="text-center">Due and Demandable</th>
                            <th></th>
                        
                        </tr>
                        </thead>
                        <tbody>
                    
                        <tr>
                            <td class="text-center">{{ $selected_voucher->ORSDetails->created_at }}</td>
                            <td class="text-center"> {{ $selected_voucher->ORSDetails->particulars }}</td>
                            <td class="text-center"> {{ $selected_voucher->ORSDetails->ors_no }}</td>
                            <td class="text-center"> {{ $selected_voucher->ORSDetails->fund_cluster }}</td>
                            <td class="text-center"> {{ number_format($selected_voucher->ORSDetails->obligation,2,'.',',')  }}</td>
                            <td class="text-center"> {{ number_format($selected_voucher->ORSDetails->payable,2,'.',',')  }}</td>
                            <td class="text-center"> {{ number_format($selected_voucher->ORSDetails->payment,2,'.',',')  }}</td>
                            <td class="text-center"> {{ number_format($selected_voucher->ORSDetails->nyd,2,'.',',')  }}</td>
                            <td class="text-center"> {{ number_format($selected_voucher->ORSDetails->dd,2,'.',',')  }}</td>
                            <td>
                                @can ('deleteORS', $selected_voucher)
                                <a href="" class="btn btn-sm btn-danger" wire:click.prevent="deleteORSDetails({{$selected_voucher->ORSDetails->id}})">Delete</a>
                                @endcan
                            </td>
                    
                    
                        </tr>            
                        </tbody>
                    </table>
                    </div>    
                </div>   
            </div>
              
        </div>
        @endif


        @if($selected_voucher->DVNumber || $selected_voucher->AccountingEntry || $selected_voucher->ReviewOfDocuments);

        <div class="card mt-2">
            <div class="card-header">
                <strong> Accounting Entries </strong>
            </div>
            <div class="card-body">
                <div class="card">
                    <ul class="nav nav-tabs nav-fill" data-bs-toggle="tabs">
                        @if ($selected_voucher->DVNumber)
                            <li class="nav-item">
                                <a href="#tabs-accounting-dv" class="nav-link active" data-bs-toggle="tab" wire:ignore>DV/JEV Number
                                </a>
                            </li>
                        @endif
                        @if ($selected_voucher->AccountingEntry)
                      <li class="nav-item">
                        <a href="#tabs-accounting-entry" class="nav-link" data-bs-toggle="tab" wire:ignore>Accounting Entry
                        </a>
                      </li>
                      @endif

                      @if ($selected_voucher->ReviewOfDocuments)
                      <li class="nav-item">
                        <a href="#tabs-review-document" class="nav-link" data-bs-toggle="tab" wire:ignore>Review of Documents
                        </a>
                      </li>
                      @endif
              
                    </ul>
                    <div class="card-body">
                      <div class="tab-content">
                        @if ($selected_voucher->DVNumber)
                        <div class="tab-pane active show" id="tabs-accounting-dv" wire:ignore.self>
                          <div>
                            <div class="table-responsive">
                                <table
                                      class="table table-vcenter">
                                  <thead>
                                    <tr>
                                        <th class="text-center">DV Number</th>
                                        <th class="text-center">JEV Number</th>
                                        <th class="text-center w-0"></th>
                                     
                                    </tr>
                                  </thead>
                                  <tbody>
                          
                                    <tr>
                                      <td class="text-center">{{ $selected_voucher->DVNumber->dv_no}}</td>
                                      <td class="text-center"> {{ $selected_voucher->DVNumber->jev_no }}</td>
                                
                                        <td>
                                            @can ('destroyAccountingEntry', $selected_voucher)
                                            <a href="" class="btn btn-sm btn-danger" wire:click.prevent="deleteDVNumber({{$selected_voucher->DVNumber->id}})">Delete</a>
                                            @endcan
                                        </td>          
                   
                                    </tr>
               
                                  </tbody>
                                </table>
                              </div>
                          </div>
                        </div>
                        @endif
                      @if ($selected_voucher->AccountingEntry)
                        <div class="tab-pane" id="tabs-accounting-entry" wire:ignore.self>
                          <div>
                            <div class="table-responsive">
                                <table
                                      class="table table-vcenter">
                                  <thead>
                                    <tr>
                                        <th class="text-center">Account Title</th>
                                        <th class="text-center">UACS</th>
                                        <th class="text-center">Debit</th>
                                        <th class="text-center">Credit</th>
                                        <th class="text-center w-1"></th>
                                     
                                    </tr>
                                  </thead>
                                  <tbody>
                                  
                                    <tr>
                                        <td class="text-center">     {{ $selected_voucher->AccountingEntry->Activity->activity }}</td>
                                        <td class="text-center">     {{ $selected_voucher->AccountingEntry->UACS->uacs }}</td>
                                        <td class="text-center">     {{number_format($selected_voucher->AccountingEntry->debit,2,'.',',') }}</td>
                                        <td class="text-center">     {{number_format($selected_voucher->AccountingEntry->credit,2,'.',',') }}</td>
                                      
                                        <td>
                                            @can ('destroyAccountingEntry', $selected_voucher)
                                            <a href="" class="btn btn-sm btn-danger" wire:click.prevent="deleteAccountingEntry({{$selected_voucher->AccountingEntry->id}})">Delete</a>
                                            @endcan
                                        </td>
                              

                                    </tr>
                                        

                                   
                                  </tbody>
                                </table>
                              </div>
                          </div>
                        </div>
                        @endif

                        @if ($selected_voucher->ReviewOfDocuments)
                        <div class="tab-pane" id="tabs-review-document" wire:ignore.self>
                          <div>
                            <div class="table-responsive">
                                <table
                                      class="table table-vcenter">
                                  <thead>
                                    <tr>
                                        <th class="text-center">Cash Available</th>
                                        <th class="text-center">Subject to Debit</th>
                                        <th class="text-center">Supporting Documents Completed</th>
                                        <th class="text-center w-1"></th>
                                     
                                    </tr>
                                  </thead>
                                  <tbody>
                                  
                                    <tr>
                                        <td class="text-center">  
                                            @if ($selected_voucher->ReviewOfDocuments->is_available) 
                                            <label class="form-switch">
                                                <input class="form-check-input" type="checkbox"  checked disabled>
                                              </label>
                                            @else 
                                            <label class="form-switch">
                                                <input class="form-check-input" type="checkbox" disabled>
                                              </label>
                                            @endif
                                        </td>
                                        <td class="text-center">  
                                            @if ($selected_voucher->ReviewOfDocuments->is_subject) 
                                            <label class="form-switch">
                                                <input class="form-check-input" type="checkbox"  checked disabled>
                                              </label>
                                            @else 
                                            <label class="form-switch">
                                                <input class="form-check-input" type="checkbox" disabled>
                                              </label>
                                            @endif
                                        </td>

                                        <td class="text-center">  
                                            @if ($selected_voucher->ReviewOfDocuments->is_supporting) 
                                            <label class="form-switch">
                                                <input class="form-check-input" type="checkbox"  checked disabled>
                                              </label>
                                            @else 
                                            <label class="form-switch">
                                                <input class="form-check-input" type="checkbox" disabled>
                                              </label>
                                            @endif
                                        </td>
                   
                                      
                                        <td>
                                            @can ('destroyAccountingEntry', $selected_voucher)
                                            <a href="" class="btn btn-sm btn-danger" wire:click.prevent="deleteReviewOfDocuments({{$selected_voucher->ReviewOfDocuments->id}})">Delete</a>
                                            @endcan
                                        </td>
                              

                                    </tr>
                                        

                                   
                                  </tbody>
                                </table>
                              </div>
                          </div>
                        </div>
                        @endif
  

                      </div>
                    </div>
                  </div>
            </div>  
        </div>
        @endif


        @if($selected_voucher->CheckAda);

        <div class="card mt-2">
            <div class="card-header">
                <strong> Cashier Entries </strong>
            </div>
            <div class="card-body">
                <div class="card">
                   
                    <div class="card-body">
                        <div>
                            <div class="table-responsive">
                                <table
                                      class="table table-vcenter">
                                  <thead>
                                    <tr>
                                        <th class="text-center">Check / ADA Number</th>
                                        <th class="text-center">Mode of Payment</th>
                            
                                        <th class="text-center w-1"></th>
                                     
                                    </tr>
                                  </thead>
                                  <tbody>
                                  
                                    <tr>
                                        <td class="text-center">  
                                           {{ $selected_voucher->CheckAda->adano }}
                                        </td>
                                        <td class="text-center">  
                                            {{ $selected_voucher->CheckAda->mop }}
                                        </td>

                                   
                   
                                      
                                        <td>
                                            @can ('destroyADA', $selected_voucher)
                                            <a href="" class="btn btn-sm btn-danger" wire:click.prevent="deleteCheckAda({{$selected_voucher->CheckAda->id}})">Delete</a>
                                            @endcan
                                        </td>
                              

                                    </tr>
                                        

                                   
                                  </tbody>
                                </table>
                              </div>
                          </div>
                    </div>
                </div>
            </div>  
        </div>
        @endif


        <div class="card mt-2">
            <div class="card-body">
                <div class="example no_toc_section">
                    <div class="example-content">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Timeline</h3>
                            </div>
                            <div class="card-body">
                                <ul class="list list-timeline">
                                

                                    @forelse ($Routes as $Route)


                                

                                         @if($Route->action == "ACCEPTED")

                                        <li>

                                            <div class="list-timeline-icon bg-success">
                                                <!-- Download SVG icon from http://tabler-icons.io/i/settings -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-pin-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M18.364 4.636a9 9 0 0 1 .203 12.519l-.203 .21l-4.243 4.242a3 3 0 0 1 -4.097 .135l-.144 -.135l-4.244 -4.243a9 9 0 0 1 12.728 -12.728zm-6.364 3.364a3 3 0 1 0 0 6a3 3 0 0 0 0 -6z" stroke-width="0" fill="currentColor"></path>
                                                </svg>
                                            </div>
                                            <div class="list-timeline-content">
                                                <div class="list-timeline-time">{{ $Route->created_at->diffforhumans()}}</div>
                                                <p class="list-timeline-title">{{ $Route->action}}</p>
                                                <div>
                                                    <i class="text-sm text-muted">
                                                        {{ $Route->office->office . ' - ' . $Route->division->division .' - ' . $Route->unit->unit}}
                                                        </i> <sub class="text-muted">by {{$Route->user->username}}. <i>{{ $Route->created_at}}</i> </sub></div>
                                            </div>
                                        </li>
                                        @endif 

                                        @if($Route->action == "REJECTED")
                                        <li>

                                            <div class="list-timeline-icon bg-danger">
                                                <!-- Download SVG icon from http://tabler-icons.io/i/settings -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-ban" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                                    <path d="M5.7 5.7l12.6 12.6"></path>
                                                </svg>
                                            </div>
                                            <div class="list-timeline-content">
                                                <div class="list-timeline-time">{{ $Route->created_at->diffforhumans()}}</div>
                                                <p class="list-timeline-title">{{ $Route->action}}</p>
                                                <div>
                                                    <i class="text-sm text-muted">
                                                        {{ $Route->office->office . ' - ' . $Route->division->division .' - ' . $Route->unit->unit}}
                                                        </i> <sub class="text-muted">by {{$Route->user->username}}. <i>{{ $Route->created_at}}</i> </sub></div>
                                            </div>
                                        </li>
                                        @endif

                                

                                        @if($Route->action == "CLOSED")
                                        <li>

                                            <div class="list-timeline-icon bg-secondary">
                                                <!-- Download SVG icon from http://tabler-icons.io/i/settings -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-off" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M3 3l18 18"></path>
                                                    <path d="M7 3h7l5 5v7m0 4a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-14"></path>
                                                </svg>
                                            </div>
                                            <div class="list-timeline-content">
                                                <div class="list-timeline-time">{{ $Route->created_at->diffforhumans()}}</div>
                                                <p class="list-timeline-title">{{ $Route->action}}</p>
                                                <div>
                                                    <i class="text-sm text-muted">
                                                        {{ $Route->office->office . ' - ' . $Route->division->division .' - ' . $Route->unit->unit}}
                                                        </i> <sub class="text-muted">by {{$Route->user->username}}. <i>{{ $Route->created_at}}</i> </sub></div>
                                            </div>
                                        </li>
                                        @endif

                                        

                                        @if($Route->action == "CHARGING CREATED" || $Route->action == "DV CREATED" ||  $Route->action == "DV UPDATED"  ||  $Route->action == "ACCOUNTING ENTRY CREATED" ||  $Route->action == "ACCOUNTING ENTRY UPDATED" || $Route->action == "REVIEW OF DOCUMENT CREATED" || $Route->action == "REVIEW OF DOCUMENT UPDATED"  || $Route->action == "BOX D SIGNATORY CREATED" || $Route->action == "BOX D SIGNATORY UPDATED" || $Route->action == "VOUCHER APPROVED" || $Route->action == "CHECK / ADA CREATED" || $Route->action == "VOUCHER DISBURSED"  )
                                        <li>

                                            <div class="list-timeline-icon bg-warning">
                                                <!-- Download SVG icon from http://tabler-icons.io/i/settings -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-coins" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M9 14c0 1.657 2.686 3 6 3s6 -1.343 6 -3s-2.686 -3 -6 -3s-6 1.343 -6 3z"></path>
                                                    <path d="M9 14v4c0 1.656 2.686 3 6 3s6 -1.344 6 -3v-4"></path>
                                                    <path d="M3 6c0 1.072 1.144 2.062 3 2.598s4.144 .536 6 0c1.856 -.536 3 -1.526 3 -2.598c0 -1.072 -1.144 -2.062 -3 -2.598s-4.144 -.536 -6 0c-1.856 .536 -3 1.526 -3 2.598z"></path>
                                                    <path d="M3 6v10c0 .888 .772 1.45 2 2"></path>
                                                    <path d="M3 11c0 .888 .772 1.45 2 2"></path>
                                                 </svg>
                                            </div>

                                            
                                            <div class="list-timeline-content">
                                                <div class="list-timeline-time">{{ $Route->created_at->diffforhumans()}}</div>
                                                <div class="list-timeline-title">{{ $Route->action}} </div>
                                                <div>
                                                    <i class="text-sm text-muted">
                                                        {{ $Route->office->office . ' - ' . $Route->division->division .' - ' . $Route->unit->unit}}
                                                        </i> <sub class="text-muted">by {{$Route->user->username}}. <i>{{ $Route->created_at}}</i> </sub></div>
                                                
                                                @if(!empty($Route->remarks))
                                                <p class="text-muted"> with Remarks: {{$Route->remarks}}
                                                </p>
                                                @endif
                                            </div>
                                        </li>
                                        @endif

                                        @if($Route->action == "ORS CREATED")
                                        <li>

                                            <div class="list-timeline-icon bg-warning">
                                                <!-- Download SVG icon from http://tabler-icons.io/i/settings -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-coins" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M9 14c0 1.657 2.686 3 6 3s6 -1.343 6 -3s-2.686 -3 -6 -3s-6 1.343 -6 3z"></path>
                                                    <path d="M9 14v4c0 1.656 2.686 3 6 3s6 -1.344 6 -3v-4"></path>
                                                    <path d="M3 6c0 1.072 1.144 2.062 3 2.598s4.144 .536 6 0c1.856 -.536 3 -1.526 3 -2.598c0 -1.072 -1.144 -2.062 -3 -2.598s-4.144 -.536 -6 0c-1.856 .536 -3 1.526 -3 2.598z"></path>
                                                    <path d="M3 6v10c0 .888 .772 1.45 2 2"></path>
                                                    <path d="M3 11c0 .888 .772 1.45 2 2"></path>
                                                 </svg>
                                            </div>

                                            
                                            <div class="list-timeline-content">
                                                <div class="list-timeline-time">{{ $Route->created_at->diffforhumans()}}</div>
                                                <div class="list-timeline-title">{{ $Route->action}} </div>
                                                <div>
                                                    <i class="text-sm text-muted">
                                                        {{ $Route->office->office . ' - ' . $Route->division->division .' - ' . $Route->unit->unit}}
                                                        </i> <sub class="text-muted">by {{$Route->user->username}}. <i>{{ $Route->created_at}}</i> </sub></div>
                                                
                                                @if(!empty($Route->remarks))
                                                <p class="text-muted"> with Remarks: {{$Route->remarks}}
                                                </p>
                                                @endif
                                            </div>
                                        </li>
                                        @endif


                                        @if($Route->action == "FORWARD TO")
                                        <li>

                                            <div class="list-timeline-icon bg-info">
                                                <!-- Download SVG icon from http://tabler-icons.io/i/settings -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-route"
                                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                                    <path d="M18 5m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                                    <path d="M12 19h4.5a3.5 3.5 0 0 0 0 -7h-8a3.5 3.5 0 0 1 0 -7h3.5"></path>
                                                </svg>
                                            </div>

                                            
                                            <div class="list-timeline-content">
                                                <div class="list-timeline-time">{{ $Route->created_at->diffforhumans()}}</div>
                                                <div class="list-timeline-title">{{ $Route->action}} </div>
                                                <div>
                                                    <i class="text-sm text-muted">
                                                        {{ $Route->office->office . ' - ' . $Route->division->division .' - ' . $Route->unit->unit}}
                                                        </i> <sub class="text-muted">by {{$Route->user->username}}. <i>{{ $Route->created_at}}</i> </sub></div>
                                                
                                                @if(!empty($Route->remarks))
                                                <p class="text-muted"> with Remarks: {{$Route->remarks}}
                                                </p>
                                                @endif
                                            </div>
                                        </li>
                                        @endif

                                        @if($Route->action == "VOUCHER CREATED")
                                        <li>

                                            <div class="list-timeline-icon">
                                                <!-- Download SVG icon from http://tabler-icons.io/i/settings -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file"
                                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                                    <path
                                                        d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="list-timeline-content">
                                                <div class="list-timeline-time">{{ $Route->created_at->diffforhumans()}}</div>
                                                <p class="list-timeline-title">{{ $Route->action}}</p>
                                                <div>
                                                    <i class="text-sm text-muted">
                                                        {{ $Route->office->office . ' - ' . $Route->division->division .' - ' . $Route->unit->unit}}
                                                        </i> <sub class="text-muted">by {{$Route->user->username}}. <i>{{ $Route->created_at}}</i> </sub></div>
                                            </div>
                                        </li>
                                        @endif

                                        @if($Route->action == "CHARGING DELETED" || $Route->action == 'ORS DELETED' || $Route->action == 'DV DELETED'  || $Route->action == 'ACCOUNTING ENTRY DELETED' || $Route->action == 'REVIEW DELETED' || $Route->action == 'CHECK / ADA DELETED'  )
                                        <li>

                                            <div class="list-timeline-icon bg-danger">
                                                <!-- Download SVG icon from http://tabler-icons.io/i/settings -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M4 7l16 0"></path>
                                                    <path d="M10 11l0 6"></path>
                                                    <path d="M14 11l0 6"></path>
                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                 </svg>
                                            </div>

                                            
                                            <div class="list-timeline-content">
                                                <div class="list-timeline-time">{{ $Route->created_at->diffforhumans()}}</div>
                                                <div class="list-timeline-title">{{ $Route->action}} </div>
                                                <div>
                                                    <i class="text-sm text-muted">
                                                        {{ $Route->office->office . ' - ' . $Route->division->division .' - ' . $Route->unit->unit}}
                                                        </i> <sub class="text-muted">by {{$Route->user->username}}. <i>{{ $Route->created_at}}</i> </sub></div>
                                                
                                                @if(!empty($Route->remarks))
                                                <p class="text-muted"> with Remarks: {{$Route->remarks}}
                                                </p>
                                                @endif
                                            </div>
                                        </li>
                                        @endif

                                        
                                   


                                        
                                    @empty

                                    @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>




{{-- @can ('addRoute',$selected_document) --}}




<div wire:ignore.self class="modal modal-blur fade" id="add_checkada" tabindex="-1" role="dialog" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content" method="POST" wire:submit.prevent='addCheckAda()'>
            <div class="modal-header">
                <h5 class="modal-title">Cashier Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

       

                <div class="mb-3">
                    <label class="form-label">Check / ADA Number</label>
              
                    <input type="text" class="form-control" name="" placeholder="Enter Check / ADA Number" wire:model="check_ada">
                    <span class="text-danger">
                        @error('check_ada')
                        {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="mb-3">
                    <label class="form-label">Mode of Payment </label>
                    <select class="form-select" wire:model="mop">
                        <option value="" selected>--- Choose Mode of Payment ---</option>
  
                      
                        <option value="MDS CHECK">MDS CHECK</option>
                        <option value="COMMERCIAL CHECK">COMMERCIAL CHECK</option>
                        <option value="ADA">ADA</option>
                        <option value="OTHERS">OTHERS</option>
  
             
  
                    </select>
                    <span class="text-danger">
                      @error('mop')
                      {{ $message }}
                      @enderror
                  </span>
                </div>
             

               
             
            </div>
            <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>       
    
                <button type="submit" class="btn btn-primary">Save</button>
                
            </div>
        </form>
    </div>
</div>




<div wire:ignore.self class="modal modal-blur fade" id="add_ors_details" tabindex="-1" role="dialog" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content" method="POST" wire:submit.prevent='addORS()'>
            <div class="modal-header">
                <h5 class="modal-title"> ORS Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

       

                <div class="mb-3">
                    <label class="form-label">Voucher Amount</label>
              
                    <input type="text" class="form-control" name=""        value="{{number_format($amount,2,'.',',') }}" readonly>
                    <span class="text-danger">
                        @error('amount')
                        {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="dropdown-divider"></div>  

                <div class="mb-3">
                    <label class="form-label">ORS Number</label>
                    <input type="text" class="form-control" name="" placeholder="Enter ORS Number" wire:model="ors_number">
                    <span class="text-danger">
                        @error('ors_number')
                        {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="mb-3">
                    <label class="form-label">Fund Cluster</label>
                    <input type="text" class="form-control" name="" placeholder="Enter Fund Cluster" wire:model="ors_fund_cluster">
                    <span class="text-danger">
                        @error('ors_fund_cluster')
                        {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="mb-3">
                    <label class="form-label">Particulars</label>
                    <input type="text" class="form-control" name="" placeholder="Enter Particulars" wire:model="ors_particulars">
                    <span class="text-danger">
                        @error('ors_particulars')
                        {{ $message }}
                        @enderror
                    </span>
                </div>

 
                <div class="mb-3">
                    <label class="form-label">Obligation Amount</label>
                    <input type="number" class="form-control" name="" placeholder="Enter Obligation Amount" wire:model="ors_obligation" step="0.01">
                    <span class="text-danger">
                        @error('ors_obligation')
                        {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="mb-3">
                    <label class="form-label">Payable Amount</label>
                    <input type="number" class="form-control" name="" placeholder="Enter Payable Amount" wire:model="ors_payable" step="0.01">
                    <span class="text-danger">
                        @error('ors_payable')
                        {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="mb-3">
                    <label class="form-label">Payment Amount</label>
                    <input type="number" class="form-control" name="" placeholder="Enter Payment Amount" wire:model="ors_payment" step="0.01">
                    <span class="text-danger">
                        @error('ors_payment')
                        {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="mb-3">
                    <label class="form-label">Not Yet Due</label>
                    <input type="number" class="form-control" name="" placeholder="Enter Not Yet Due Amount" wire:model="ors_nyd" step="0.01">
                    <span class="text-danger">
                        @error('ors_nyd')
                        {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="mb-3">
                    <label class="form-label">Due and Demandable</label>
                    <input type="number" class="form-control" name="" placeholder="Enter Due and Demandable Amount" wire:model="ors_dd" step="0.01">
                    <span class="text-danger">
                        @error('ors_dd')
                        {{ $message }}
                        @enderror
                    </span>
                </div>
             
            </div>
            <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                @if(!is_null($selected_voucher->ORSDetails))

                <button type="submit" class="btn btn-primary" disabled>Save and Obligate</button>
                @else
    
                <button type="submit" class="btn btn-primary">Save and Obligate</button>
                @endif
            </div>
        </form>
    </div>
</div>



<div wire:ignore.self class="modal modal-blur fade" id="add_route" tabindex="-1" role="dialog" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content" method="POST" wire:submit.prevent='addRoute()'>
            <div class="modal-header">
                <h5 class="modal-title"> Route Document</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <h3 class="card-title">Route Information</h3>
                  <div class="mb-3">
                    <label class="form-label">Route Action</label>
                    <input type="text" class="form-control" name="" placeholder="Enter Remarks" wire:model="routeaction"
                        disabled>
                    <span class="text-danger">
                        @error('routeaction')
                        {{ $message }}
                        @enderror
                    </span>
                </div>

              <div class="mb-3">
                  <label class="form-label">Office </label>
                  <select class="form-select" wire:model="selectedOffice">
                      <option value="" selected>--- Choose Office ---</option>

                      @forelse ($officeids as $Office)
                      <option value="{{ $Office->id }}">{{ $Office->office}}</option>
                      @empty

                      @endforelse

                  </select>
                  <span class="text-danger">
                    @error('selectedOffice')
                    {{ $message }}
                    @enderror
                </span>
              </div>
        

              @if(!is_null($selectedOffice))
              <div class="mb-3">
                  <label class="form-label">Division </label>
                  <select class="form-select" wire:model="selectedDivision">
                      <option value="" selected>--- Choose Division ---</option>


                      @forelse ($divisionids as $Division)
                      <option value="{{ $Division->id }}">{{ $Division->division}}</option>
                      @empty

                      @endforelse
                  </select>
                  <span class="text-danger">
                    @error('selectedDivision')
                    {{ $message }}
                    @enderror
                </span>
              </div>
      

              @endif

              @if (!is_null($selectedDivision))
              <div class="mb-3">
                  <label class="form-label">Unit</label>
                  <select class="form-select" wire:model="selectedUnit">
                      <option value="" selected>--- Choose Unit ---</option>
                      @forelse ($unitids as $Unit)
                      <option value="{{ $Unit->unit_id }}">{{ $Unit->unit->unit}}</option>
                      @empty

                      @endforelse
                  </select>
                  <span class="text-danger">
                    @error('selectedUnit')
                    {{ $message }}
                    @enderror
                </span>
              </div>
     
              @endif

              <div class="mb-3">
                  <label class="form-label">Route Remarks</label>
                  <input type="text" class="form-control" name="" placeholder="Enter Remarks" wire:model="route_remarks">
                  <span class="text-danger">
                      @error('remarks')
                      {{ $message }}
                      @enderror
                  </span>
              </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>




{{-- @endcan --}}


<div wire:ignore.self class="modal modal-blur fade" id="approve_voucher" tabindex="-1" role="dialog" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <form class="modal-content" method="POST" wire:submit.prevent='approveVoucher()'>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-success"></div>
            <div class="modal-body text-center py-4">
                <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-success icon-lg" width="24" height="24"
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 9v2m0 4v.01" />
                    <path
                        d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                    </svg>
                <h3>Are you sure?</h3>
                <div class="text-muted">Do you want to Approve this Voucher.</div>
                <div>{{ $selected_voucher->sequenceid }}</div>
            </div>
            <div class="modal-footer">
                <div class="w-100">
                    <div class="row">
                        <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                Cancel
                            </a></div>
                        <div class="col">
                            <button type="submit" class="btn btn-success w-100">Accept</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>



<div wire:ignore.self class="modal modal-blur fade" id="disburse" tabindex="-1" role="dialog" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <form class="modal-content" method="POST" wire:submit.prevent='disburseVoucher()'>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-success"></div>
            <div class="modal-body text-center py-4">
                <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-success icon-lg" width="24" height="24"
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 9v2m0 4v.01" />
                    <path
                        d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                    </svg>
                <h3>Are you sure?</h3>
                <div class="text-muted">Do you want to disburse this Voucher.</div>
                <div>{{ $selected_voucher->sequenceid }}</div>
            </div>
            <div class="modal-footer">
                <div class="w-100">
                    <div class="row">
                        <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                Cancel
                            </a></div>
                        <div class="col">
                            <button type="submit" class="btn btn-success w-100">Disburse</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>




<div wire:ignore.self class="modal modal-blur fade" id="accept_voucher" tabindex="-1" role="dialog" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <form class="modal-content" method="POST" wire:submit.prevent='acceptVoucher()'>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-success"></div>
            <div class="modal-body text-center py-4">
                <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-success icon-lg" width="24" height="24"
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 9v2m0 4v.01" />
                    <path
                        d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                    </svg>
                <h3>Are you sure?</h3>
                <div class="text-muted">Do you want to accept this Voucher.</div>
                <div>{{ $selected_voucher->sequenceid }}</div>
            </div>
            <div class="modal-footer">
                <div class="w-100">
                    <div class="row">
                        <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                Cancel
                            </a></div>
                        <div class="col">
                            <button type="submit" class="btn btn-success w-100">Accept</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>



<div wire:ignore.self class="modal modal-blur fade" id="reject_voucher" tabindex="-1" role="dialog" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <form class="modal-content" method="POST" wire:submit.prevent='rejectVoucher()'>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-danger"></div>
            <div class="modal-body text-center py-4">
                <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24"
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 9v2m0 4v.01" />
                    <path
                        d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                    </svg>
                <h3>Are you sure?</h3>
                <div class="text-muted">Do you want to reject this Voucher.</div>
                <div>{{ $selected_voucher->sequenceid}}</div>
            </div>
            <div class="modal-footer">
                <div class="w-100">
                    <div class="row">
                        <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                Cancel
                            </a></div>
                        <div class="col">
                            <button type="submit" class="btn btn-danger w-100">Reject</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div wire:ignore.self class="modal modal-blur fade" id="delete_ada" tabindex="-1" role="dialog" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <form class="modal-content" method="POST" wire:submit.prevent='destroyADA()'>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-danger"></div>
            <div class="modal-body text-center py-4">
                <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24"
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 9v2m0 4v.01" />
                    <path
                        d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                    </svg>
                <h3>Are you sure?</h3>
                <div class="text-muted">Do you want to delete CHECK / ADA.</div>
                {{-- <div>{{ $selected_document->PDN}}</div> --}}
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


<div wire:ignore.self class="modal modal-blur fade" id="delete_accounting_entry" tabindex="-1" role="dialog" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <form class="modal-content" method="POST" wire:submit.prevent='destroyAccountingEntry()'>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-danger"></div>
            <div class="modal-body text-center py-4">
                <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24"
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 9v2m0 4v.01" />
                    <path
                        d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                    </svg>
                <h3>Are you sure?</h3>
                <div class="text-muted">Do you want to delete Accounting Entry.</div>
                {{-- <div>{{ $selected_document->PDN}}</div> --}}
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

<div wire:ignore.self class="modal modal-blur fade" id="delete_review" tabindex="-1" role="dialog" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <form class="modal-content" method="POST" wire:submit.prevent='destroyReview()'>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-danger"></div>
            <div class="modal-body text-center py-4">
                <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24"
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 9v2m0 4v.01" />
                    <path
                        d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                    </svg>
                <h3>Are you sure?</h3>
                <div class="text-muted">Do you want to delete Review of Document.</div>
                {{-- <div>{{ $selected_document->PDN}}</div> --}}
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


<div wire:ignore.self class="modal modal-blur fade" id="delete_charging_uacs" tabindex="-1" role="dialog" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <form class="modal-content" method="POST" wire:submit.prevent='destroyChargingUACS()'>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-danger"></div>
            <div class="modal-body text-center py-4">
                <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24"
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 9v2m0 4v.01" />
                    <path
                        d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                    </svg>
                <h3>Are you sure?</h3>
                <div class="text-muted">Do you want to delete UACS Charging.</div>
                {{-- <div>{{ $selected_document->PDN}}</div> --}}
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


<div wire:ignore.self class="modal modal-blur fade" id="delete_dv_number" tabindex="-1" role="dialog" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <form class="modal-content" method="POST" wire:submit.prevent='destroyDVNUmber()'>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-danger"></div>
            <div class="modal-body text-center py-4">
                <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24"
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 9v2m0 4v.01" />
                    <path
                        d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                    </svg>
                <h3>Are you sure?</h3>
                <div class="text-muted">Do you want to delete DV / JEV Number.</div>
                {{-- <div>{{ $selected_document->PDN}}</div> --}}
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

<div wire:ignore.self class="modal modal-blur fade" id="delete_ors_details" tabindex="-1" role="dialog" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <form class="modal-content" method="POST" wire:submit.prevent='destroyORSDetails()'>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-danger"></div>
            <div class="modal-body text-center py-4">
                <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24"
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 9v2m0 4v.01" />
                    <path
                        d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                    </svg>
                <h3>Are you sure?</h3>
                <div class="text-muted">Do you want to delete ORS Details.</div>
                {{-- <div>{{ $selected_document->PDN}}</div> --}}
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



<div wire:ignore.self class="modal modal-blur fade" id="delete_charging_saa" tabindex="-1" role="dialog" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <form class="modal-content" method="POST" wire:submit.prevent='destroyChargingSAA()'>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-danger"></div>
            <div class="modal-body text-center py-4">
                <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24"
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 9v2m0 4v.01" />
                    <path
                        d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                    </svg>
                <h3>Are you sure?</h3>
                <div class="text-muted">Do you want to delete SAA Charging.</div>
                {{-- <div>{{ $selected_document->PDN}}</div> --}}
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



<div wire:ignore.self class="modal modal-blur fade" id="delete_charging_activity" tabindex="-1" role="dialog" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <form class="modal-content" method="POST" wire:submit.prevent='destroyChargingActivity()'>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-danger"></div>
            <div class="modal-body text-center py-4">
                <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24"
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 9v2m0 4v.01" />
                    <path
                        d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                    </svg>
                <h3>Are you sure?</h3>
                <div class="text-muted">Do you want to delete Activity Charging.</div>
                {{-- <div>{{ $selected_document->PDN}}</div> --}}
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
{{-- 

@can ('addAttachment',$selected_document)

<div wire:ignore.self class="modal modal-blur fade" id="add_attachment" tabindex="-1" role="dialog" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content" method="POST" wire:submit.prevent='addAttachment()'>
            <div class="modal-header">
                <h5 class="modal-title"> Add Attachment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="mb-3">
                    <label class="form-label">Details</label>
                    <input type="text" class="form-control" name="" placeholder="Enter Remarks"
                        wire:model="attachmentdetails">
                    <span class="text-danger">
                        @error('attachmentdetails')
                        {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="mb-3">
                    <div class="form-label">Attachment</div>
                    <input type="file" class="form-control" wire:model="addattachment">

                    <span class="text-danger">
                        @error('addattachment')
                        {{ $message }}
                        @enderror
                    </span>
                </div>

                @if ($addattachment)
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24"
                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M5 12l5 5l10 -10"></path>
                </svg>
                Your file is ready to upload!
                @endif

                <div class="mb-3">

                    <div class="form-label" wire:loading wire:target="addattachment">Uploading File</div>

                    <div class="progress" wire:loading wire:target="addattachment">
                        <div class="progress-bar progress-bar-indeterminate bg-green text-center" wire:loading
                            wire:target="addattachment"></div>

                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" wire:loading-finish wire:target="attachment">Save</button>
            </div>
        </form>
    </div>
</div>

@endcan



<div wire:ignore.self class="modal modal-blur fade" id="accept_document" tabindex="-1" role="dialog" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <form class="modal-content" method="POST" wire:submit.prevent='acceptDocument()'>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-success"></div>
            <div class="modal-body text-center py-4">
                <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-success icon-lg" width="24" height="24"
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 9v2m0 4v.01" />
                    <path
                        d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                    </svg>
                <h3>Are you sure?</h3>
                <div class="text-muted">Do you want to accept this Document.</div>
                <div>{{ $selected_document->PDN}}</div>
            </div>
            <div class="modal-footer">
                <div class="w-100">
                    <div class="row">
                        <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                Cancel
                            </a></div>
                        <div class="col">
                            <button type="submit" class="btn btn-success w-100">Accept</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>



<div wire:ignore.self class="modal modal-blur fade" id="reject_document" tabindex="-1" role="dialog" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <form class="modal-content" method="POST" wire:submit.prevent='rejectDocument()'>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-danger"></div>
            <div class="modal-body text-center py-4">
                <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24"
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 9v2m0 4v.01" />
                    <path
                        d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                    </svg>
                <h3>Are you sure?</h3>
                <div class="text-muted">Do you want to reject this Document.</div>
                <div>{{ $selected_document->PDN}}</div>
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


<div wire:ignore.self class="modal modal-blur fade" id="close_document" tabindex="-1" role="dialog" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <form class="modal-content" method="POST" wire:submit.prevent='closeDocument()'>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-danger"></div>
            <div class="modal-body text-center py-4">
                <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24"
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 9v2m0 4v.01" />
                    <path
                        d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                    </svg>
                <h3>Are you sure?</h3>
                <div class="text-muted">Do you want to close this Document.</div>
                <div>{{ $selected_document->PDN}}</div>
            </div>
            <div class="modal-footer">
                <div class="w-100">
                    <div class="row">
                        <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                Cancel
                            </a></div>
                        <div class="col">
                            <button type="submit" class="btn btn-danger w-100">Close Document</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>






@can ('delete', $selected_document)

<div wire:ignore.self class="modal modal-blur fade" id="delete_document" tabindex="-1" role="dialog" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <form class="modal-content" method="POST" wire:submit.prevent='destroyDocument()'>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-danger"></div>
            <div class="modal-body text-center py-4">
                <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24"
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 9v2m0 4v.01" />
                    <path
                        d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                    </svg>
                <h3>Are you sure?</h3>
                <div class="text-muted">Do you really want to delete this Document.</div>
                <div>{{ $selected_document->PDN}}</div>
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

@endcan


@can ('deleteAttachment',$selected_document)
<div wire:ignore.self class="modal modal-blur fade" id="delete_attachment" tabindex="-1" role="dialog"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <form class="modal-content" method="POST" wire:submit.prevent='destroyAttachment()'>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-danger"></div>
            <div class="modal-body text-center py-4">
                <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24"
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 9v2m0 4v.01" />
                    <path
                        d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                    </svg>
                <h3>Are you sure?</h3>
                <div class="text-muted">Do you really want to delete this Attachment.</div>
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
@endcan



@can ('update', $selected_document)

<div wire:ignore.self class="modal modal-blur fade" id="edit_document" tabindex="-1" role="dialog" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content" method="POST" wire:submit.prevent='updateDocument()'>
            <div class="modal-header">
                <h5 class="modal-title"> Edit Document</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <h3 class="card-title">Document Information</h3>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_retired" id="is_retired"
                                    wire:model="is_urgent">
                                <span class="form-check-label">Is Urgent :</span>
                            </label>
                        </div>
                        <span class="text-danger">
                            @error('is_urgent')
                            {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Date Received :<span class="text-danger">*</span></label>
                            <input type="date" class="form-control" wire:model="datereceived">
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
                            <label class="form-label">Originating Office :<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="originatingoffice"
                                placeholder="Enter Originiating Office" wire:model="originatingoffice">
                            <span class="text-danger">
                                @error('originatingoffice')
                                {{ $message }}
                                @enderror
                            </span>

                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-label">Sender Name :<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="sendername" placeholder="Enter Sender Name"
                                wire:model="sendername">
                            <span class="text-danger">
                                @error('sendername')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-label">Sender Address :<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="senderaddress"
                                placeholder="Enter Sender Address" wire:model="senderaddress">
                            <span class="text-danger">
                                @error('senderaddress')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>

                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-label"> Document Type :<span class="text-danger">*</span></label>

                            <datalist id="doctype">
                                <option value="MEMORANDUM">
                                <option value="LETTER">
                                <option value="SPECIAL ORDER">
                                <option value="REGIONAL SPECIAL ORDER">
                                <option value="DENR SPECIAL ORDER">
                                <option value="DENR MEMORANDUM CIRCULAR">
                                <option value="FAX MESSAGE">
                                <option value="ELECTRONIC MESSAGE FOR TRANSMISSION">

                            </datalist>
                            <input type="text" class="form-control" name="doc_type" list="doctype"
                                placeholder="--- ADD OR SELECT DOCUMENT TYPE ---"
                                oninput="this.value = this.value.toUpperCase()" wire:model="doc_type">
                            <span class="text-danger">
                                @error('doc_type')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>

                    </div>
                </div>



                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-label">Subject :<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="originatingoffice" placeholder="Enter Subject"
                                wire:model="subject">
                            <span class="text-danger">
                                @error('subject')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-label">Addressee :<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="addressee" placeholder="Enter Addressee"
                                wire:model="addressee">
                            <span class="text-danger">
                                @error('addressee')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>

                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
@endcan --}}



<div wire:ignore.self class="modal modal-blur fade" id="charging_saa" tabindex="-1" role="dialog" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content" method="POST" wire:submit.prevent='chargingSAA()'>
            <div class="modal-header">
                <h5 class="modal-title"> Charging - SAA</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <h3 class="card-title">Charging Information Information</h3>


                <div class="mb-3">
                    <label class="form-label">Voucher SAA Balance</label>
                    <input type="text" class="form-control" name="amount" wire:model="rem_bal_saa_voucher" readonly>
                    <span class="text-danger"> @error('rem_bal_saa_voucher')
                        {{ $message }}
                        
                    @enderror</span> 
                </div>


                <div class="mb-3">
                    <label class="form-label">SAA Number </label>
                    <select class="form-select" wire:model="selectedSAA">
                            <option value="" selected>--- Choose SAA Number ---</option>

                            @forelse ($Saa_ids as $SAA)
                                <option value="{{ $SAA->id }}">{{ $SAA->saa_no }}</option>
                            @empty
                                
                            @endforelse
                
                    </select>
                    <span class="text-danger"> @error('selectedSAA')
                        {{ $message }}
                          
                      @enderror</span> 
                </div>
                @if (!is_null($selectedSAA))
                <div class="mb-3">
                    <label class="form-label">Remaining SAA Balance</label>
                    <input type="text" class="form-control" name="amount" wire:model="saa_rem_bal" readonly>
                    <span class="text-danger"> @error('saa_rem_bal')
                        {{ $message }}
                        
                    @enderror</span> 
                </div>
                @endif  

                @if (!is_null($saa_rem_bal))
                <div class="mb-3">
                    <label class="form-label">Charging Amount</label>
                    <input type="text" class="form-control" name="amount" wire:model="saa_charging">
                    <span class="text-danger"> @error('saa_charging')
                        {{ $message }}
                        
                    @enderror</span> 
                </div>
                @endif  

            </div>
            <div class="modal-footer">



                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                @if ( $rem_bal_saa_voucher != 0  && $saa_rem_bal !=0)
                <button type="submit" class="btn btn-primary">Add Charging</button>

                @else
                <button type="submit" class="btn btn-primary" disabled>Add Charging</button>
                @endif
            </div>
        </form>
    </div>
</div>



<div wire:ignore.self class="modal modal-blur fade" id="add_dv_number" tabindex="-1" role="dialog" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content" method="POST" 
        @if($update_dv)
        wire:submit.prevent='updateDVNumber()'
        @else
            wire:submit.prevent="addDVNumber()"
        @endif
        >
            <div class="modal-header">
                <h5 class="modal-title"> {{ $update_dv ? 'Update DV NUmber ' : 'Add DV NUmber'}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <h3 class="card-title">Disbursement Voucher Information</h3>


                <div class="mb-3">
                    <label class="form-label">DV Number</label>
                    <input type="text" class="form-control" name="amount" wire:model="dv_number">
                    <span class="text-danger"> @error('dv_number')
                        {{ $message }}
                        
                    @enderror</span> 
                </div>

                <div class="mb-3">
                    <label class="form-label">JEV Number</label>
                    <input type="text" class="form-control" name="amount" wire:model="jev_number">
                    <span class="text-danger"> @error('jev_number')
                        {{ $message }}
                        
                    @enderror</span> 
                </div>
             

            </div>
            <div class="modal-footer">



                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                @if (!is_null($dv_number) && !is_null($jev_number))
                <button type="submit" class="btn btn-primary">{{ $update_dv ? 'Update' : 'Save'}}</button>
                @else
                <button type="submit" class="btn btn-primary" disabled>{{ $update_dv ? 'Update' : 'Save'}}</button>
      
                @endif
            </div>
        </form>
    </div>
</div>



<div wire:ignore.self class="modal modal-blur fade" id="add_boxd" tabindex="-1" role="dialog" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content" method="POST" 
        @if($update_boxd)
        wire:submit.prevent='updateBoxD()'
        @else
            wire:submit.prevent="addBoxD()"
        @endif
        >
            <div class="modal-header">
                <h5 class="modal-title"> {{ $update_boxd ? 'Update Box D Signatory ' : 'Add Box D Signatory'}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="mb-3">
                    <label class="form-label">Box D Signatory </label>
                    <select class="form-select" wire:model="selected_box_d">
                            <option value="" selected>--- Choose Signatory ---</option>

                            @forelse ($BoxDSignatories as $Signatory)
                                <option value="{{ $Signatory->id }}">{{ $Signatory->certified_by . ' - ' . $Signatory->position }}</option>
                            @empty
                                
                            @endforelse
                
                    </select>
                    <span class="text-danger"> @error('selected_box_d')
                        {{ $message }}
                          
                      @enderror</span> 
                </div>
             

            </div>
            <div class="modal-footer">

                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
      
                <button type="submit" class="btn btn-primary">{{ $update_boxd ? 'Update' : 'Save'}}</button>
    
               
            </div>
        </form>
    </div>
</div>

<div wire:ignore.self class="modal modal-blur fade" id="add_review" tabindex="-1" role="dialog" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content" method="POST" 
        @if($update_review)
        wire:submit.prevent='updateReview()'
        @else
            wire:submit.prevent="addReview()"
        @endif
        >   
           <div class="modal-header">
                <h5 class="modal-title"> {{ $update_review ? 'Update Review of Documents ' : 'Add Review of Documents'}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

              <h3 class="card-title">Review of Documents Information</h3>

                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="" id="" wire:model="is_available">
                            <span class="form-check-label">Cash Available</span>
                            </label>
                        </div>
                        <span class="text-danger"> 
                            @error('is_available')
                                {{ $message }}   
                            @enderror
                        </span>
                    </div>

                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="" id="" wire:model="is_subject">
                            <span class="form-check-label">Subject to Authority to Debit Account (when Applicable)</span>
                            </label>
                        </div>
                        <span class="text-danger"> 
                            @error('is_subject')
                                {{ $message }}   
                            @enderror
                        </span>
                    </div>

                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="" id="" wire:model="is_supporting">
                            <span class="form-check-label">Supporting Documents completed and amount claimed proper</span>
                            </label>
                        </div>
                        <span class="text-danger"> 
                            @error('is_supporting')
                                {{ $message }}   
                            @enderror
                        </span>
                    </div>
    {{--
                <div class="mb-3">
                    <label class="form-label">DV Number</label>
                    <input type="text" class="form-control" name="amount" wire:model="dv_number">
                    <span class="text-danger"> @error('dv_number')
                        {{ $message }}
                        
                    @enderror</span> 
                </div>

                <div class="mb-3">
                    <label class="form-label">JEV Number</label>
                    <input type="text" class="form-control" name="amount" wire:model="jev_number">
                    <span class="text-danger"> @error('jev_number')
                        {{ $message }}
                        
                    @enderror</span> 
                </div>
              --}}

            </div>
            <div class="modal-footer">



                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
          
                <button type="submit" class="btn btn-primary">{{ $update_review ? 'Update' : 'Save'}}</button>
             
            </div>
        </form>
    </div>
</div>



<div wire:ignore.self class="modal modal-blur fade" id="add_accounting_entry" tabindex="-1" role="dialog" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content" method="POST" 
        @if($update_accounting_entry)
        wire:submit.prevent='updateAccountingEntry()'
        @else
            wire:submit.prevent="addAccountingEntry()"
        @endif
        >
            <div class="modal-header">
                <h5 class="modal-title"> {{ $update_accounting_entry ? 'Update Accounting Entry ' : 'Add Accounting Entry'}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <h3 class="card-title">Accounting Entry Information</h3>

                <div class="mb-3">
                    <label class="form-label">Account Title </label>
                    <select class="form-select" wire:model="selectedAccountTitle">
                        <option value="" selected>--- Choose Account Title ---</option>
  
                        @forelse ($AccountTitles as $AccountTitle)
                        <option value="{{ $AccountTitle->id }}">{{ $AccountTitle->activity}}</option>
                        @empty
  
                        @endforelse
  
                    </select>
                    <span class="text-danger">
                      @error('selectedAccountTitle')
                      {{ $message }}
                      @enderror
                  </span>
                </div>

                @if(!is_null($selectedAccountTitle))
                <div class="mb-3">
                    <label class="form-label">UACS </label>
                    <select class="form-select" wire:model="selectedAccountUACS">
                            <option value="" selected>--- Choose UACS ---</option>

                            @forelse ($AUACSLists as $List)
                                <option value="{{ $List->id }}">{{ $List->uacs }}</option>
                            @empty
                                
                            @endforelse
                
                    </select>
                    <span class="text-danger"> @error('selectedAccountUACS')
                        {{ $message }}
                          
                      @enderror</span> 
                </div>
                @endif

                <div class="mb-3">
                    <label class="form-label">Debit</label>
                    <input type="number" class="form-control" name="amount" step="0.01" wire:model="a_debit">
                    <span class="text-danger"> @error('a_debit')
                        {{ $message }}
                        
                    @enderror</span> 
                </div>

                {{-- <div class="mb-3">
                    <label class="form-label">JEV Number</label>
                    <input type="number" class="form-control" name="amount" step="0.01"  wire:model="a_credit">
                    <span class="text-danger"> @error('a_credit')
                        {{ $message }}
                        
                    @enderror</span> 
                </div> --}}
             

            </div>
            <div class="modal-footer">



                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                @if (!is_null($selectedAccountTitle) && !is_null($selectedAccountUACS))
                <button type="submit" class="btn btn-primary">{{ $update_accounting_entry ? 'Update' : 'Save'}}</button>
                @else
                <button type="submit" class="btn btn-primary" disabled>{{ $update_accounting_entry ? 'Update' : 'Save'}}</button>
      
                @endif
            </div>
        </form>
    </div>
</div>



<div wire:ignore.self class="modal modal-blur fade" id="charging_gaa" tabindex="-1" role="dialog" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> Charging - GAA</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <h3 class="card-title">Charging Information</h3>

                <div class="mb-3">
                    <label class="form-label">Office </label>
                    <select class="form-select" wire:model="selectedOfficeFM">
                            <option value="" selected>--- Choose Office ---</option>

                            @forelse ($Office_ids as $Office)
                                <option value="{{ $Office->id }}">{{ $Office->office }}</option>
                            @empty
                                
                            @endforelse
                
                    </select>
                    <span class="text-danger"> @error('selectedOfficeFM')
                        {{ $message }}
                          
                      @enderror</span> 
                </div>

                @if(!is_null($selectedOfficeFM))
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


                @if (!is_null($selectedYear))
                <div class="card">
                    <ul class="nav nav-tabs nav-fill" data-bs-toggle="tabs">
                      <li class="nav-item">
                        <a href="#tabs-activity" class="nav-link active" data-bs-toggle="tab" wire:ignore>Activity
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="#tabs-uacs" class="nav-link" data-bs-toggle="tab" wire:ignore>UACS
                        </a>
                    </li>
                    </ul>
                    <div class="card-body">
                      <div class="tab-content">

                        <div class="tab-pane active show" id="tabs-activity" wire:ignore.self>
                        <form method="POST" wire:submit.prevent='addGAAChargingActivity()'>
                          <div>

                            
                            <div class="mb-3">
                                <label class="form-label">Voucher Activity Balance</label>
                                <input type="text" class="form-control" name="amount" wire:model="rem_bal_activity_voucher" readonly>
                                <span class="text-danger"> @error('rem_bal_activity_voucher')
                                    {{ $message }}
                                    
                                @enderror</span> 
                            </div> 


                            <div class="mb-3">
                                <label class="form-label">Activity  </label>
                                <select class="form-select" wire:model="selectedActivity">
                                        <option value="" selected>--- Choose Activity ---</option>

                                        @forelse ($activity_ids as $Activity)
                                            <option value="{{ $Activity->id }}">{{ $Activity->Activity->activity}}</option>
                                        @empty
                                            
                                        @endforelse
                            
                                </select>
                                <span class="text-danger"> @error('selectedActivity')
                                    {{ $message }}
                                    
                                @enderror</span> 
                            </div>

                            @if(!is_null($selectedActivity))
                                <div class="mb-3">
                                    <label class="form-label">Remaining Activity Balance</label>
                                    <input type="text" class="form-control" name="amount" wire:model="activity_rem_bal" readonly>
                                    <span class="text-danger"> @error('activity_rem_bal')
                                        {{ $message }}
                                        
                                    @enderror</span> 
                                </div>  

                                @if ($activity_rem_bal != 0 || !is_null($activity_rem_bal))
                                <div class="mb-3">
                                    <label class="form-label">Charging Amount</label>
                                    <input type="number" class="form-control" name="activity_charging" placeholder="Enter Activity Charging Amount" wire:model="activity_charging" step="0.01">
                                    <span class="text-danger"> @error('activity_charging')
                                        {{ $message }}
                                        
                                    @enderror</span> 
                                </div>  
                                @endif
                            @endif
                          </div>


                          <div class="">
                            @if ( $rem_bal_activity_voucher != 0  && $activity_rem_bal !=0)
                            
                                <button type="submit" class="btn btn-primary">Add Charging</button>
                            @else
                                <button type="submit" class="btn btn-primary" disabled>Add Charging</button>
                            @endif
                            
                          </div>
                       


                        </form>
                        </div>
                        <div class="tab-pane" id="tabs-uacs" wire:ignore.self>
                            <form method="POST" wire:submit.prevent='addGAAChargingUACS()'>
                                <div>
                
                                    <div class="mb-3">
                                        <label class="form-label">Voucher UACS Balance</label>
                                        <input type="text" class="form-control" name="amount" wire:model="rem_bal_uacs_voucher" readonly>
                                        <span class="text-danger"> @error('rem_bal_uacs_voucher')
                                            {{ $message }}
                                            
                                        @enderror</span> 
                                    </div> 

                                    <div class="mb-3">
                                        <label class="form-label">UACS  </label>
                                        <select class="form-select" wire:model="selectedUACS">
                                                <option value="" selected>--- Choose UACS ---</option>
            
                                                @forelse ($Uacs_ids as $UACS)
                                                    <option value="{{ $UACS->id }}">{{ $UACS->UACS->uacs }}</option>
                                                @empty
                                                    
                                                @endforelse
                                    
                                        </select>
                                        <span class="text-danger"> @error('selectedUACS')
                                            {{ $message }}
                                            
                                        @enderror</span> 
                                    </div>
            
                                    @if(!is_null($selectedUACS))
                                        <div class="mb-3">
                                            <label class="form-label">Remaining UACS Balance</label>
                                            <input type="text" class="form-control" name="amount" wire:model="uacs_rem_bal" readonly>
                                            <span class="text-danger"> @error('uacs_rem_bal')
                                                {{ $message }}
                                                
                                            @enderror</span> 
                                        </div>  
            
                                        @if ($uacs_rem_bal != 0 || !is_null($uacs_rem_bal))
                                        <div class="mb-3">
                                            <label class="form-label">Charging Amount</label>
                                            <input type="number" class="form-control" name="uacs_charging" placeholder="Enter UACS Charging Amount" wire:model="uacs_charging" step="0.01">
                                            <span class="text-danger"> @error('uacs_charging')
                                                {{ $message }}
                                                
                                            @enderror</span> 
                                        </div>  
                                        @endif
                                    @endif

                                    <div class="">
                                        @if ( $rem_bal_uacs_voucher != 0  && $uacs_rem_bal !=0)
                                        
                                            <button type="submit" class="btn btn-primary">Add Charging</button>
                                        @else
                                            <button type="submit" class="btn btn-primary" disabled>Add Charging</button>
                                        @endif
                                        
                                    </div>
                                </div>
                            </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endif               
            </div>

            <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                {{-- <button type="submit" class="btn btn-primary">Add Charging</button> --}}
            </div>
        </div>
    </div>
</div>



</div>
