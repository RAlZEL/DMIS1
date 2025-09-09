<div>
    <div class="row row-cards"> 
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_activity">
                    Add New Activity
                    </button>
                </div>
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
                    <table class="table card-table table-vcenter text-nowrap datatable">
                    <thead>
                        <tr>
                            <th class="text-center">Id </th>
                            <th class="text-center">P/A/P </th>
                            <th class="text-center">Activity </th>
                            <th class="text-center w-1">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($Activities as $Index => $Activity)
                        <tr>
                            <td class="text-center" data-label="Id">{{ $Activity->id }}</td>
                            <td class="text-center" data-label="P/A/P">{{ $Activity->pap->pap }}</td>
                            <td class="text-center" data-label="Activity">{{ $Activity->activity }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="" class="btn btn-sm btn-primary" wire:click.prevent="editActivity({{$Activity->id}})">Edit</a> &nbsp;
                                    <a href="" class="btn btn-sm btn-danger" wire:click.prevent="deleteActivity({{$Activity->id}})">Delete</a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                <span class="text-center text-danger">
                                   No Activity found.
                               </span> 
                           </td>
                        </tr>
                        @endforelse
                    
                        
                    </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex align-items-center">
                    {{ $Activities->links('livewire::bootstrap') }}
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal modal-blur fade" id="add_activity" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <form class="modal-content" method="POST"
                @if($updateActivity)
                    wire:submit.prevent='updateActivity()'
                @else
                    wire:submit.prevent="addActivity()"
                @endif
            >
            <div class="modal-header">
              <h5 class="modal-title"> {{ $updateActivity ? 'Update Activity ' : 'Add Activity'}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
    

                <div class="mb-3">
                    <label class="form-label">P/A/P </label>
                    <select class="form-select" wire:model="papid">
                            <option value="" selected>--- Choose PAP ---</option>

                            @forelse ($PAPs as $PAP)
                                <option value="{{ $PAP->id }}">{{ $PAP->pap }}</option>
                            @empty
                                
                            @endforelse
                
                    </select>
                    <span class="text-danger"> @error('papid')
                        {{ $message }}
                          
                      @enderror</span> 
                </div>


                <div class="mb-3">
                    <label class="form-label">Activity Name</label>
                    <input type="text" class="form-control" name="office" placeholder="Enter Activity Name" wire:model="activity">
                    <span class="text-danger"> @error('activity')
                        {{ $message }}
                          
                      @enderror</span> 
                </div>  
                 

            </div>
            <div class="modal-footer">
              <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">{{ $updateActivity ? 'Update' : 'Save'}}</button>
            </div>
        </form>
        </div>
    </div>

  
    <div wire:ignore.self class="modal modal-blur fade" id="delete_activity" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
          <form class="modal-content" method="POST"     wire:submit.prevent='destroyActivity()'>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-danger"></div>
            <div class="modal-body text-center py-4">
              <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v2m0 4v.01" /><path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" /></svg>
              <h3>Are you sure?</h3>
              <div class="text-muted">Do you really want to delete this Activity.</div>
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
