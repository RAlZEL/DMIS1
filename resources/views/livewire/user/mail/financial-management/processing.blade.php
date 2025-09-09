<div>
    <div class="row row-cards"> 
      <div class="col-sm-6 col-lg-4">
            
            <div class="card">
                <div class="card-header">
                    <a href="{{route('mail.userMail') }}"> <h3>Mail - Document Tracking System</h3></a>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <a href="{{route('user.FM') }}"> <h3>Financial Management System</h3></a>

                </div>
                <a href="{{ route('mail.FMMail')}}" ss class="nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail-exclamation mx-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M15 19h-10a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v5.5"></path>
                        <path d="M3 7l9 6l9 -6"></path>
                        <path d="M19 16v3"></path>
                        <path d="M19 22v.01"></path>
                     </svg>
                      Incoming {{ Str::plural('Voucher', $incomingCount) }}
                      @if ($incomingCount != 0)
                      <span class="badge bg-red mx-2">  {{ $incomingCount }} </span>
                      @endif
     
                  </a>            
                  <a href="{{ route('mail.processingIndexFM')}}" class="nav-link">
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
                      Processing {{ Str::plural('Voucher', $processingCount)}}
                      @if ($processingCount != 0)
                      <span class="badge bg-red mx-2">  {{ $processingCount }} </span>
                      @endif
                  </a>  
                  <a href="{{ route('mail.outgoingIndexFM')}}" class="nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail-forward mx-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 18h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v7.5"></path>
                        <path d="M3 6l9 6l9 -6"></path>
                        <path d="M15 18h6"></path>
                        <path d="M18 15l3 3l-3 3"></path>
                     </svg>
                      Outgoing {{ Str::plural('Voucher', $outgoingCount) }}
                      @if ($outgoingCount != 0)
                      <span class="badge bg-red mx-2">  {{ $outgoingCount }} </span>
                      @endif
                  </a>  
                  <a href="{{ route('mail.rejectedIndexFM')}}" class="nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail-cancel mx-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 19h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v5"></path>
                        <path d="M19 19m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                        <path d="M17 21l4 -4"></path>
                        <path d="M3 7l9 6l9 -6"></path>
                     </svg>
                      Rejected {{ Str::plural('Voucher',$rejectedCount) }}
                      @if ($rejectedCount != 0)
                      <span class="badge bg-red mx-2">  {{ $rejectedCount }} </span>
                      @endif
                  </a> 
                
          
            </div>

            {{-- @can('viewADAFM', App\Models\FinancialManagement\voucher::class)
        
            <div class="card">
                <div class="card-header">
                    <a href="{{route('mail.ADAFM') }}"> <h3>ADA List(s)</h3></a>
                </div>
            </div>
            @endcan --}}


        </div>


        <div class="col-sm-6 col-lg-8">
     
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">           Processing {{ Str::plural('Voucher',$processingLists->count()) }}</h3>
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
                    @if ($processingLists->count() !=0 && $selectedRows)
                    <div class=" text-muted">
                      <button id="btnGroupDrop1" type="button" class="btn dropdown-toggle btn-sm" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        Action
                      </button>
                        <div class="dropdown-menu dropdown-menu-end" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate3d(-0.222214px, 38px, 0px);">
                          <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#add_route">
                            Route {{ Str::plural('Voucher', count($selectedRows)) }}
                          </a>
                          <a class="dropdown-item" wire:click.prevent="markAllPrint" target="_blank" rel="noopener">
                            Print Manifest
                          </a>
                        </div>
                
                      </div>
                      <div class="text-muted btn-sm">
                        <span class="mx-2 text-sm"> selected {{ count($selectedRows) }}  {{ Str::plural('Voucher', count($selectedRows)) }}</span>
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
                          <th class="w-1">Sequence ID <!-- Download SVG icon from http://tabler-icons.io/i/chevron-up -->
                            {{-- <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-dark icon-thick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="6 15 12 9 18 15"></polyline></svg> --}}
                          </th>
                          <th>Particulars</th>
                          <th>Amount</th>
                          <th>Route From</th>
                          <th></th>
                          {{-- <th></th> --}}
              
                        </tr>
                      </thead>

                      <tbody>
        
                        @forelse ($processingLists as $List)
                        <tr>
                        <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice" id="{{ $List->id }}" value="{{$List->id}}" wire:model="selectedRows"></td>
                        <td class="text-muted">{{ $List->sequenceid }}</td>
                        <td>
                            <a href="user/Financial-Management/view/{{$List->id}}" tabindex="-1" target="_blank">{{ $List->particulars}}
                            </a>
                        </td>
                        <td class="text-muted">{{ number_format($List->amount,2,'.',',') }}</td>
          
                        <td class="text-muted">{{ $List->fromoffice->office . ' - ' . $List->fromunit->unit}} <span class="text-muted"><i><span class="btn-sm">by {{ $List->fromuser->username}}</span></i></span></td>
                        <td class="text-muted"><span class="btn-sm">{{ $List->updated_at->diffforhumans()}}</span></td>
                           
                            </tr>
        
                     
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No Processing Voucher</td>
                        </tr>
                          
                        @endforelse
                
                    </tbody>

                  </table>
           
                </div>
                <div class="card-footer d-flex align-items-center">
                
                  {{ $processingLists->links('livewire::bootstrap') }}
        
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
                  <label class="form-label">Unit </label>
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
                  <input type="text" class="form-control" name="" placeholder="Enter Remarks" wire:model="remarks">
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



