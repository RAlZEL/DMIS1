<div>
    <div class="row row-cards"> 
        <div class="col-12">
            <div class="card">
                @can('create', App\Models\Announcement::class)
                <div class="card-header">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_announcement">
                    New Announcement
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
                            <th class="text-center">Id</th>
                            <th class="text-center">Target Office</th>
                            <th class="text-center">To</th>
                            <th class="text-center">Subject</th>
                            <th class="text-center">Remarks</th>
                            <th class="text-center">Start Date</th>
                            <th class="text-center">End Date</th>
                            <th class="text-center">Created By</th>
                            <th class="text-center w-1"></th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($Announcements as $Announcement)
                        <tr>
                            <td class="text-center" data-label="Id">{{ $Announcement->id }}</td>
                            @if ( $Announcement->office_id == 0) 
                            <td class="text-center" data-label="Target Office">ALL OFFICES</td>
                            @else
                            <td class="text-center" data-label="Target Office">{{ $Announcement->Office->office }}</td>
                            @endif
                            <td class="text-center" data-label="To">{{ $Announcement->announce_to }}</td>
                            <td class="text-center" data-label="Subject">{{ $Announcement->subject }}</td>
                            <td class="text-center" data-label="Remarks">{{ $Announcement->remarks }}</td>
                            <td class="text-center" data-label="Start Date">{{ $Announcement->start_date }}</td>
                            <td class="text-center" data-label="End Date">{{ $Announcement->end_date }}</td>
                            <td class="text-center" data-label="Created By">{{ $Announcement->User->Employee->firstname . ' ' . $Announcement->User->Employee->lastname }}</td>
           
                            <td class="text-center">
                                <div class="btn-group">
                                 
                                        @can('update', $Announcement)
                                        <a href="" class="btn btn-sm btn-primary" wire:click.prevent="editAnnouncement({{$Announcement->id}})">Edit</a> &nbsp;
                                        @endcan
                                        @can('delete', $Announcement)
                                        <a href="" class="btn btn-sm btn-danger" wire:click.prevent="deleteAnnouncement({{$Announcement->id}})">Delete</a>
                                        @endcan
                                     
                        
                                </div>        
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">
                                <span class="text-center text-danger">
                                No Announcement found.
                            </span> 
                        </td>
                        </tr>
                        @endforelse
                    
                        
                    </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex align-items-center">
                    {{ $Announcements->links('livewire::bootstrap') }}
                </div>
            </div>
        </div>
    </div>

   <div wire:ignore.self class="modal modal-blur fade" id="add_announcement" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <form class="modal-content" method="POST" @if($updateAnnouncement)
                    wire:submit.prevent='updateAnnouncement()'
                @else
                    wire:submit.prevent="addAnnouncement()"
                @endif>
                <div class="modal-header">
                    <h5 class="modal-title"> {{ $updateAnnouncement ? 'Update Announcement ' : 'Add Announcement'}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <label class="form-label">Announcement Information</label>
                    <div class="dropdown-divider"></div>

                    <div class="mb-3">
                        <label class="form-label">Target Office    <span class="text-danger mb-2" > <i class="text-sm mb-2">(All Employees under this office can only view the Announcement)</i>  </span> </label> 
                        <select class="form-select" wire:model="office_id">
                            <option value="" selected>--- Choose Office ---</option>
                            <option value="0">ALL OFFICE</option>
                            @forelse ($OfficeLists as $Office)
                            <option value="{{ $Office->id }}">{{ $Office->office }}</option>

                            @empty
      
                            @endforelse
                          
                        </select>
                        <span class="text-danger">
                          @error('office_id')
                          {{ $message }}
                          @enderror
                      </span>
                    </div>


                    <div class="mb-3">
                        <label class="form-label">To</label>

                        <datalist id="announce_to">
                            <option value="ALL EMPLOYEES">
                            <option value="ALL USERS">
                            <option value="ALL DIVISION CHIEF">
                            <option value="ALL SECTION CHIEF">
                            <option value="ALL DIVISION / SECTION CHIEF">
                        </datalist>


                        <input type="text" class="form-control" list="announce_to" placeholder="Enter To" wire:model="announce_to">
                        <span class="text-danger"> 
                            @error('announce_to')
                                {{ $message }}   
                            @enderror
                        </span>
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Subject</label>
                        <input type="text" class="form-control"  placeholder="Enter Subject" wire:model="subject">
                        <span class="text-danger"> 
                            @error('subject')
                                {{ $message }}   
                            @enderror
                        </span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Remarks</label>
                        <input type="text" class="form-control"  placeholder="Enter Remarks" wire:model="remarks">
                        <span class="text-danger"> 
                            @error('remarks')
                                {{ $message }}   
                            @enderror
                        </span>
                    </div>


                 <div class="dropdown-divider"></div>  
                 <span class="text-danger mb-2" > <i class="text-sm mb-2">Date where Announcement will be posted</i>  </span>
                    <div class="mb-3 mt-2">
                        <label class="form-label">Start Date</label>
                        <input type="date" class="form-control" wire:model="start_date">
                        <span class="text-danger"> 
                            @error('start_date')
                                {{ $message }}   
                            @enderror
                        </span>
                    </div>

                    
                    <div class="mb-3">
                        <label class="form-label">End Date</label>
                        <input type="date" class="form-control" wire:model="end_date">
                        <span class="text-danger"> 
                            @error('end_date')
                                {{ $message }}   
                            @enderror
                        </span>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">{{ $updateAnnouncement ? 'Update' : 'Save'}}</button>
                </div>
            </form>
        </div>
    </div> 

      
    <div wire:ignore.self class="modal modal-blur fade" id="delete_announcement" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
          <form class="modal-content" method="POST"     wire:submit.prevent='destroyAnnouncement()'>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-danger"></div>
            <div class="modal-body text-center py-4">
              <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v2m0 4v.01" /><path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" /></svg>
              <h3>Are you sure?</h3>
              <div class="text-muted">Do you really want to delete this Announcement.</div>
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


</div>

