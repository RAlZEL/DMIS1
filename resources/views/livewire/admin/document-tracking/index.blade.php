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
                    <table class="table card-table table-vcenter datatable">
                    <thead>
                        <tr>
                            <th class="text-center">PDN</th>
                            <th class="text-center">Document Type</th>
                            <th class="text-center">Subject</th>
                            <th class="text-center">Originating Office</th>
                            <th class="text-center">Sender Name</th>
                            <th class="text-center">Addressee</th>
                            <th class="text-center">Date Received</th>
                            <th class="text-center w-1">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($Documents as $Index => $Document)
                        <tr>
                            <td class="text-center">{{ $Document->PDN }}</td>
                            <td class="text-center">{{ $Document->doc_type }}</td>
                            <td class="">
                                {{-- <a href="user/document-tracking/view/{{$Document->id}}" tabindex="-1" target="_blank"> --}}
                                {{ $Document->subject }}
                  
                                @if ($Document->is_urgent == true)
                                    <span class="btn btn-danger btn-sm"> Urgent
                                    </span>
                                @endif
                                {{-- </a> --}}2
                            </td>
                            <td class="text-center">{{ $Document->originatingoffice }}</td>
                            <td class="text-center">{{ $Document->sendername }}</td>
                            <td class="text-center">{{ $Document->addressee }}</td>
                            <td class="text-center">{{ $Document->datereceived }}</td>
                            <td class="text-center">
                      
                         
                                    <div class="btn-list flex-nowrap">
                                      <a class="btn bg-info " wire:click.prevent="addRoute({{$Document->id}})">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-route"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                        <path d="M18 5m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                        <path d="M12 19h4.5a3.5 3.5 0 0 0 0 -7h-8a3.5 3.5 0 0 1 0 -7h3.5"></path>
                                    </svg>
                                    <span class="mx-2">Route</span>
                                    </a>
                    
                                    </div>
                                    <div class="btn-list flex-nowrap" wire:click.prevent="deleteDocument({{$Document->id}})">
                                        <a class="btn bg-danger" >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M4 7l16 0"></path>
                                                <path d="M10 11l0 6"></path>
                                                <path d="M14 11l0 6"></path>
                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                             </svg>
                                      <span class="mx-2">Delete</span>
                                      </a>
                      
                                      </div>
                                  
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">
                                <span class="text-center text-danger">
                                No Document found.
                            </span> 
                        </td>
                        </tr>
                        @endforelse
                    
                        
                    </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex align-items-center">
                    {{ $Documents->links('livewire::bootstrap') }}
                </div>
            </div>
        </div>
    </div>



    <div wire:ignore.self class="modal modal-blur fade" id="delete_document" tabindex="-1" role="dialog"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
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





    <div wire:ignore.self class="modal modal-blur fade" id="add_route" tabindex="-1" role="dialog" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content" method="POST" wire:submit.prevent='createRoute()'>
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
                  <label class="form-label">Office Assigned</label>
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

                      @forelse ($DivisionFinal as $Final)
                            @forelse ($divisionids as $Division)
                            @if($Final->id == $Division->Division->id)
                                 <option value="{{ $Division->Division->id }}">{{ $Division->Division->division }}</option>
                                 @break;
                                 @endif
                            @empty

                            @endforelse
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
                      <option value="{{ $Unit->Unit->id }}">{{ $Unit->Unit->unit}}</option>
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



</div>
