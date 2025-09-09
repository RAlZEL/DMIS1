<div>
    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Incoming Document(s)</h3>
        </div>
        <div class="card-body border-bottom py-3">
          <div class="d-flex">
            {{-- <div class="text-muted">
              Show
              <div class="mx-2 d-inline-block">
                <input type="text" class="form-control form-control-sm" value="8" size="3" aria-label="Invoices count">
              </div>
              entries
            </div> --}}
            @if ($IncomingLists->count() !=0 && $selectedRows)
            <div class=" text-muted">
              <button id="btnGroupDrop1" type="button" class="btn dropdown-toggle btn-sm" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                Action
              </button>
                <div class="dropdown-menu dropdown-menu-end" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate3d(-0.222214px, 38px, 0px);">
                  
                  @can('addMultipleAccept', App\Models\DocumentTracking\Document::class)
                    <a class="dropdown-item" wire:click.prevent="markAccept">
                      Accept {{ Str::plural('Document', count($selectedRows)) }}
                    </a>
                  <a class="dropdown-item" wire:click.prevent="markReject">
                    Reject {{ Str::plural('Document', count($selectedRows)) }}
                  </a>
                  @endcan
                  
                  <a class="dropdown-item" wire:click.prevent="markAllPrint">
                    Print Manifest
                  </a>
                </div>
        
              </div>
              <div class="text-muted btn-sm">
                <span class="mx-2 text-sm"> selected {{ count($selectedRows) }}  {{ Str::plural('Document', count($selectedRows)) }}</span>
              </div>    
            @endif
            
        
        
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
                <th class="w-1" >PDN <!-- Download SVG icon from http://tabler-icons.io/i/chevron-up -->
                  {{-- <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-dark icon-thick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="6 15 12 9 18 15"></polyline></svg> --}}
                </th>
                <th class="text-center">Document Type</th>
                <th class="text-center">Subject</th>
                <th class="text-center">Remarks</th>
                <th class="text-center">Route From</th>
                <th></th>
                {{-- <th></th> --}}
    
              </tr>
            </thead>
            <tbody>
        
                @forelse ($IncomingLists as $List)
                <tr>
                <td ><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice" id="{{ $List->id }}" value="{{$List->id}}" wire:model="selectedRows"></td>
                <td class="text-muted"  data-label="PDN">{{ $List->PDN }}</td>
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
                    
                <td class="text-muted" data-label="Route From">{{ $List->fromoffice->office . ' - ' . $List->fromunit->unit}} <span class="text-muted"><i><span class="btn-sm">by {{ $List->fromuser->username}}</span></i></span></td>
                  
              <td class="text-muted"><span class="btn-sm">{{ $List->updated_at->diffforhumans()}}</span></td>
                   
                    </tr>

             
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">No Incoming Document</td>
                </tr>
                  
                @endforelse
        
            </tbody>
          </table>
    
        </div>
        <div class="card-footer d-flex align-items-center">
        
          {{ $IncomingLists->links('livewire::bootstrap') }}


          
<div wire:ignore.self class="modal modal-blur fade" id="accept_documents" tabindex="-1" role="dialog" aria-hidden="true"
data-bs-backdrop="static" data-bs-keyboard="false">
<div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <form class="modal-content" method="POST" wire:submit.prevent='markAllAccept()'>
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
            <div class="text-muted">Do you want to accept this Document(s).</div>
           
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

<div wire:ignore.self class="modal modal-blur fade" id="reject_documents" tabindex="-1" role="dialog" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <form class="modal-content" method="POST" wire:submit.prevent='markAllReject()'>
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
                <div class="text-muted">Do you want to reject this Document(s).</div>
                <div class="mb-3">
                    <label class="form-label">Remarks</label>
                    <input type="text" class="form-control" name="" placeholder="Enter Remarks" wire:model="rejectremarks"
                        >
                    <span class="text-danger">
                        @error('routeaction')
                        {{ $message }}
                        @enderror
                    </span>
                </div>
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



          
</div>
