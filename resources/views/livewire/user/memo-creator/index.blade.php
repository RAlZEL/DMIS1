<div>
    <div class="row row-cards"> 
        <div class="col-12">
            <div class="card">
                {{-- @can('create', App\Models\Announcement::class) --}}
                <div class="card-header">
                  
                    <button class="btn btn-primary"  onclick="window.location.href='{{ route('user.MemoCreate')}}';">
                        {{-- <button class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#add_memo"> --}}
                    Create Memorandum
                    </button>
                </div>
                {{-- @endcan --}}
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
                            <th class="text-center">Subject</th>
                            <th class="text-center">From </th>
                            <th class="text-center">Created By</th>
                            <th class="text-center w-1"></th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($Memorandums as $Memorandum)
                        <tr>
                            <td class="text-center" data-label="Id">{{ $Memorandum->id }}</td>
                            <td class="text-center" data-label="Id">{{ $Memorandum->date }}</td>
                            <td class="text-center" data-label="To">{{ $Memorandum->subject }}</td>
                            <td class="text-center" data-label="Subject">{{ $Memorandum->from_emp . ' - ' . $Memorandum->from_pos }}</td>
                            <td class="text-center" data-label="Remarks">{{ $Memorandum->user_id }}</td>
                    
                            <td class="text-center">
                                <div class="btn-group">
                                    {{-- <a href="{{ route('user.MemoCreate')}}" class="btn btn-sm btn-warning">Update</a> &nbsp; --}}
                                    {{-- <a href="" class="btn btn-sm btn-primary" wire:click.prevent="editAnnouncement({{$Memorandum->id}})">Update</a> &nbsp; --}}
                                    <a href="" class="btn btn-sm btn-danger" wire:click.prevent="editAnnouncement({{$Memorandum->id}})">Delete</a> &nbsp;
                                </div>        
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">
                                <span class="text-center text-danger">
                                No Memorandum found.
                            </span> 
                        </td>
                        </tr>
                        @endforelse
                    
                        
                    </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex align-items-center">
                    {{-- {{ $Announcements->links('livewire::bootstrap') }} --}}
                </div>
            </div>
        </div>
    </div>

   
    <div wire:ignore.self class="modal modal-blur fade" id="add_memo" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <form class="modal-content" method="POST" wire:submit.prevent='createMemorandum()'>
                <div class="modal-header">
                    <h5 class="modal-title">New Memorandum</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <label class="form-label">Memorandum Information</label>
                    <div class="dropdown-divider"></div>
                
                    <div class="mb-3">
                        <label class="form-label"> Date</label>
                        <input type="date" class="form-control" wire:model="date">
                        <span class="text-danger"> 
                            @error('date')
                                {{ $message }}   
                            @enderror
                        </span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Subject</label>
                        <textarea name="" id="" class="form-control" rows="5" placeholder="Enter Subject" wire:model="subject"></textarea>
                     
                        <span class="text-danger"> 
                            @error('subject')
                                {{ $message }}   
                            @enderror
                        </span>
                    </div>

                    <label class="form-label">From</label>
                    <div class="dropdown-divider"></div>
                    <div class="mb-3">
                        <label class="form-label">Employee Name</label>
                        <input type="text" class="form-control"  placeholder="Enter Employee Name" wire:model="from_emp">
                        <span class="text-danger"> 
                            @error('from_emp')
                                {{ $message }}   
                            @enderror
                        </span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Position</label>
                        <input type="text" class="form-control"  placeholder="Enter Employee Position" wire:model="from_pos">
                        <span class="text-danger"> 
                            @error('from_pos')
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

