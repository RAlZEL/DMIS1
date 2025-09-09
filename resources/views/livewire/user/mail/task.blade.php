<div>
    <div class="row row-cards"> 
      <div class="col-sm-6 col-lg-4">
          @can('viewMail', App\Models\FinancialManagement\voucher::class)
          <div class="card">
            <div class="card-header">
                <a href="{{route('mail.FMMail') }}"> <h3>Mail - Financial Management System</h3></a>
            </div>
          </div>
          @endcan

        
            <div class="card">
                <div class="card-header">
                   <a href="{{route('document-tracking.userhome') }}"> <h3>Document Tracking System</h3></a>
                </div>
                <a href="{{ route('mail.userMail')}}" ss class="nav-link">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail-exclamation mx-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M15 19h-10a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v5.5"></path>
                    <path d="M3 7l9 6l9 -6"></path>
                    <path d="M19 16v3"></path>
                    <path d="M19 22v.01"></path>
                 </svg>
                      Incoming {{ Str::plural('Document',$incomingCount)}}
                      @if ($incomingCount != 0)
                      <span class="badge bg-red mx-2">  {{ $incomingCount }} </span>
                      @endif
     
                  </a>            
                  <a href="{{ route('mail.processingIndex')}}" class="nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail-cog mx-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 19h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v5"></path>
                        <path d="M3 7l9 6l9 -6"></path>
                        <path d="M19.001 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                        <path d="M19.001 15.5v1.5"></path>
                        <path d="M19.001 21v1.5"></path>
                        <path d="M22.032 17.25l-1.299 .75"></path>
                        <path d="M17.27 20l-1.3 .75"></path>
                        <path d="M15.97 17.25l1.3 .75"></path>
                        <path d="M20.733 20l1.3 .75"></path>
                     </svg>
                      Processing {{ Str::plural('Document', $processingCount) }}
                      @if ($processingCount != 0)
                      <span class="badge bg-red mx-2">  {{ $processingCount }} </span>
                      @endif
                  </a>  
                  {{-- <a href="{{ route('mail.assignedTask')}}" class="nav-link mx-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrows-up-right mx-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M17 21l4 -4l-4 -4"></path>
                        <path d="M21 17h-11a3 3 0 0 1 -3 -3v-11"></path>
                        <path d="M11 7l-4 -4l-4 4"></path>
                     </svg>
                      Assigned Task
                      @if ($AssignedTaskCount != 0)
                      <span class="badge bg-red mx-2">  {{ $AssignedTaskCount }} </span>
                      @endif
                  </a>   --}}


                  <a href="{{ route('mail.outgoingIndex')}}" class="nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail-forward mx-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 18h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v7.5"></path>
                        <path d="M3 6l9 6l9 -6"></path>
                        <path d="M15 18h6"></path>
                        <path d="M18 15l3 3l-3 3"></path>
                     </svg>
                      Outgoing {{ Str::plural('Document', $outgoingCount )}}
                      @if ($outgoingCount != 0)
                      <span class="badge bg-red mx-2">  {{ $outgoingCount }} </span>
                      @endif
                  </a>  
                  <a href="{{ route('mail.rejectedIndex')}}" class="nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail-cancel mx-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M12 19h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v5"></path>
                      <path d="M19 19m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                      <path d="M17 21l4 -4"></path>
                      <path d="M3 7l9 6l9 -6"></path>
                   </svg>
                      Rejected {{ Str::plural('Document', $rejectedCount) }}
                      @if ($rejectedCount != 0)
                      <span class="badge bg-red mx-2">  {{ $rejectedCount }} </span>
                      @endif
                  </a> 
                  <a href="{{ route('mail.closedIndex')}}" class="nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail-x mx-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M13.5 19h-8.5a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v6"></path>
                      <path d="M3 7l9 6l9 -6"></path>
                      <path d="M22 22l-5 -5"></path>
                      <path d="M17 22l5 -5"></path>
                   </svg>
                      Closed {{ Str::plural('Document', $closedCount) }}
                      @if ($closedCount != 0)
                      <span class="badge bg-red mx-2">  {{ $closedCount }} </span>
                      @endif
                  </a> 
          
            </div>
        </div>



        <div class="col-sm-6 col-lg-8">
     
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Assigned Task(s) </h3>
                </div>
                <div class="card-body border-bottom py-3">
                  <div class="d-flex">
                    <div class="text-muted">
                      Show
                      <div class="mx-2 d-inline-block">
                        <input type="text" class="form-control form-control-sm" value="8" size="3" aria-label="Invoices count">
                      </div>
                      entries
                    </div> 
                     {{-- @if ($AssignTaskLists->count() !=0 && $selectedRows)
                    <div class=" text-muted">
                      <button id="btnGroupDrop1" type="button" class="btn dropdown-toggle btn-sm" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        Action
                      </button>
                        <div class="dropdown-menu dropdown-menu-end" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate3d(-0.222214px, 38px, 0px);">
                       
        
                          <a class="dropdown-item" wire:click.prevent="markAllPrint" target="_blank" rel="noopener">
                            Print Manifest
                          </a>
                        </div>
                
                      </div>
                      <div class="text-muted btn-sm">
                        <span class="mx-2 text-sm"> selected {{ count($selectedRows) }}  {{ Str::plural('Task', count($selectedRows)) }}</span>
                      </div>    
                    @endif --}}
                    
                
                
                    <div class="ms-auto text-muted">
                      Search:
                      <div class="ms-2 d-inline-block">
                        <input type="text" class="form-control form-control-sm" aria-label="Search invoice" wire:model='Search'>
                      </div>
                    </div>
        
                
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table table-vcenter table-mobile-md card-table">
                    <thead>
                      <tr>
                        <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select all invoices" wire:model="selectedPageRows"></th>
                        <th class="w-1">PDN 
                        </th>
                        <th class="text-center">Document Type</th>
                        <th class="text-center">Subject</th>
                        <th class="text-center">Remarks</th>
                        <th class="text-center">Closed By</th>
                        <th></th>
                    
            
                      </tr>
                    </thead>
                    <tbody>
                
                         {{-- @forelse ($AssignTaskLists as $List) --}}
                        {{-- <tr>
                        <td class="" data-label="Document Type"><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice" id="{{ $List->id }}" value="{{$List->id}}" wire:model="selectedRows"></td>
                        <td class="text-muted" data-label="PDN">{{ $List->PDN }}</td>
                        <td class="text-muted text-nowrap" data-label="Document Type">{{ $List->doc_type}}</td>
                        <td data-label="Subject">
                            <a href="user/document-tracking/view/{{$List->id}}" tabindex="-1">{{ $List->subject}}
                              
                        @if ($List->is_paperless == true)
                        <span class="btn btn-success btn-sm"> Paperless
                        </span>
                            
                        @endif
                            @if ($List->is_urgent == true)
                            <span class="btn btn-danger btn-sm"> Urgent
                            </span>
                                
                            @endif
                            </a>
                        
                        </td>
                        @if (!is_null($List->remarks))
                        <td class="text-muted"  data-label="Remarks">{{ $List->remarks }}</td>
                        @else 
                        <td></td>
                        @endif


                        <td class="text-muted data-label="Closed By">{{ $List->fromuser->Employee->firstname}} </td>
                        <td class="text-muted"><span class="btn-sm">{{ $List->created_at->diffforhumans()}}</span></td>
                           
                            </tr> --}}
        
                     
                        {{-- @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No Task Document</td>
                        </tr>
                          
                        @endforelse  --}}
                
                    </tbody>
                  </table>
           
                </div>
                <div class="card-footer d-flex align-items-center">
                
                  {{-- {{ $AssignTaskLists->links('livewire::bootstrap') }} --}}
                    
        </div>
    </div>

    
</div>
