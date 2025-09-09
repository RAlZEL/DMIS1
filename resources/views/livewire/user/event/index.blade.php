<div>
    <div class="row row-cards"> 
        <div class="col-12">
            <div class="card">
                @can('create', App\Models\Event::class)
                <div class="card-header">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_event">
                    Add New Event
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
                            <th class="text-center">Date</th>
                            <th class="text-center">Event Name</th>
                            <th class="text-center">Remarks</th>
                            <th class="text-center">Schedule</th>
                            <th class="text-center">Office </th>
                            <th class="text-center w-1"></th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($Events as $Event)
                        <tr>
                            <td class="text-center" data-label="ID">{{ $Event->id }}</td>
                            <td class="text-center" data-label="Date">{{ $Event->date }}</td>
                            <td class="text-center" data-label="Event Name">{{ $Event->event }}</td>
                            <td class="text-center" data-label="Remarks">{{ $Event->remarks }}</td>
                            <td class="text-center" data-label="Schedule">{{ $Event->schedule }}</td>
                            <td class="text-center" data-label="Office">{{ $Event->Office->office }}</td>
           
                            <td class="text-center">
                                <div class="btn-group">
                                    @if ($Event->date >= now())
                                        @can('update', $Event)
                                        <a href="" class="btn btn-sm btn-primary" wire:click.prevent="editEvent({{$Event->id}})">Edit</a> &nbsp;
                                        @endcan
                                        @can('delete', $post)
                                        <a href="" class="btn btn-sm btn-danger" wire:click.prevent="deleteEvent({{$Event->id}})">Delete</a>
                                        @endcan
                                     
                                    @endif
                                </div>        
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">
                                <span class="text-center text-danger">
                                No Event found.
                            </span> 
                        </td>
                        </tr>
                        @endforelse
                    
                        
                    </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex align-items-center">
                    {{ $Events->links('livewire::bootstrap') }}
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal modal-blur fade" id="add_event" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <form class="modal-content" method="POST" @if($updateEvent)
                    wire:submit.prevent='updateEvent()'
                @else
                    wire:submit.prevent="addEvent()"
                @endif>
                <div class="modal-header">
                    <h5 class="modal-title"> {{ $updateEvent ? 'Update Event ' : 'Add Event'}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <label class="form-label">Event Information</label>
                    <div class="dropdown-divider"></div>

                    <div class="mb-3">
                        <label class="form-label">Date</label>
                        <input type="date" class="form-control" wire:model="date">
                        <span class="text-danger"> 
                            @error('date')
                                {{ $message }}   
                            @enderror
                        </span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Office</label>
                        <select class="form-select" wire:model="office">
                            <option value="" selected>--- Choose Office ---</option>
                            @foreach ($officelists as $office)
                       
                            <option value="{{ $office->id }}">{{ $office->office }}</option>
                            @endforeach
                          
                      
                        </select>
                        <span class="text-danger"> 
                            @error('office')
                                {{ $message }}   
                            @enderror
                        </span>
                    </div>
                
                
                    <div class="mb-3">
                        <label class="form-label">Schedule</label>
                        <select class="form-select" wire:model="schedule">
                            <option value="" selected>--- Choose Schedule ---</option>
                                    <option value="1st Shift">1st Shift</option>
                                    <option value="2nd Shift">2nd Shift</option>
                                    <option value="Whole Day">Whole Day</option>
                        </select>
                        <span class="text-danger"> 
                            @error('schedule')
                                {{ $message }}   
                            @enderror
                        </span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Event Name</label>
                        <input type="text" class="form-control"  placeholder="Enter Event Name" wire:model="event">
                        <span class="text-danger"> 
                            @error('event')
                                {{ $message }}   
                            @enderror
                        </span>
                    </div>

                       
                    <div class="mb-3">
                        <label class="form-label">Remarks</label>
                        <select class="form-select" wire:model="remarks">
                            <option value="" selected>--- Choose Remarks ---</option>
                                    <option value="HOLIDAY">HOLIDAY</option>
                                    <option value="OTHERS">OTHERS</option>
                                    <option value="WORK SUSPENSION">WORK SUSPENSION</option>
                        </select>
                        <span class="text-danger"> 
                            @error('remarks')
                                {{ $message }}   
                            @enderror
                        </span>
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">{{ $updateEvent ? 'Update' : 'Save'}}</button>
                </div>
            </form>
        </div>
    </div> 

    <div wire:ignore.self class="modal modal-blur fade" id="delete_event" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
          <form class="modal-content" method="POST"     wire:submit.prevent='destroyEvent()'>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-danger"></div>
            <div class="modal-body text-center py-4">
              <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v2m0 4v.01" /><path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" /></svg>
              <h3>Are you sure?</h3>
              <div class="text-muted">Do you really want to delete this Event.</div>
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
