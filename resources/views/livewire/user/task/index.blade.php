<div>
  <div class="card">

      @can('create', App\Models\Task\Task::class)
      <div class="card-header">
          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_task">
              Create Task
          </button>
      </div>

      @endcan


  <div class="card-body">
    <div class="card">
        <ul class="nav nav-tabs nav-fill" data-bs-toggle="tabs">
          <li class="nav-item">
            <a href="#tabs-all" class="nav-link" data-bs-toggle="tab"> My Task <span class="badge bg-red mx-2 text-xs">  {{ $myTasksCount }} </span>
            </a>
          </li>
        
          <li class="nav-item">
            <a href="#tabs-process" class="nav-link" data-bs-toggle="tab"> My On Process <span class="badge bg-warning mx-2 text-xs">  {{ $AcceptedTasksCount }}
            </a>
          </li>
          <li class="nav-item">
            <a href="#tabs-completed" class="nav-link" data-bs-toggle="tab"> My Completed <span class="badge bg-success mx-2 text-xs">  {{ $CompletedTasksCount }}
            </a>
          </li>
          <li class="nav-item">
            <a href="#tabs-rejected" class="nav-link" data-bs-toggle="tab"> My Rejected <span class="badge bg-teel mx-2 text-xs">  {{ $RejectedTasksCount }}
            </a>
          </li>
          @can('create', App\Models\Task\Task::class)
            <li class="nav-item">
            <a href="#tabs-assigned" class="nav-link" data-bs-toggle="tab"> Assigned Task to Employee <span class="badge bg-info mx-2 text-xs">  {{ $AssignedTasksCount }}
            </a>
          </li>
          @endcan
        </ul>
        <div class="card-body">
          <div class="tab-content">
            <div class="tab-pane" id="tabs-all" wire:ignore.self>
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
                                <table class="table table-vcenter table-mobile-md card-table">
                                <thead>
                                    <tr>
                                        <th class="text-center">Id</th>
                                        <th class="text-center">Task</th>
                                        <th class="text-center">Remarks</th>
                                        <th class="text-center">Start Date</th>
                                        <th class="text-center">End Date</th>
                                        <th class="text-center">Assignment Details</th>
                                        <th class="text-center w-1">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
            
                                    @forelse ($MyTasks as $Key => $Task)
                                    <tr>
                                        <td class="text-center" data-label="Id">{{ $Key + 1 }}</td>
                                        @if(!is_null($Task->document_id)) 
                                        <td class="text-center" data-label="Task"><a href="user/document-tracking/view/{{$Task->document_id}}">{{ $Task->task }}</a></td>
                                        @else 
                                        <td class="text-center" data-label="Task">{{ $Task->task }}</td>
                                        @endif
                                        <td class="text-center" data-label="Remarks">{{ $Task->remarks }}
                                        <td class="text-center" data-label="Start Date">{{ $Task->start_date }}</td>
                                        <td class="text-center" data-label="End Date">{{ $Task->due_date }}</td>
                                        <td class="text-center" data-label="Assignement Details">Assigned by {{ $Task->AssignedBy->Employee->firstname . ' ' . $Task->AssignedBy->Employee->lastname }}</td>
                              
                                        <td class="text-center">
                                            <div class="btn-group">
                                                {{-- <a href="user/document-tracking/view/{{$Document->id}}" class="btn btn-sm btn-primary" target="_blank">View</a> &nbsp; --}}
                                                <button class="btn btn-sm btn-info" wire:click.prevent="AcceptTaskShow({{$Task->id}})" >Accept</button> &nbsp;
                                                <button class="btn btn-sm btn-danger" wire:click.prevent="RejectTaskShow({{$Task->id}})" >Reject</button> &nbsp;
                                                <button type="button" class="btn btn-sm m-1" wire:click.prevent="showComment({{$Task->id}})">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-message-dots" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M4 21v-13a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-9l-4 4"></path>
                                                        <path d="M12 11l0 .01"></path>
                                                        <path d="M8 11l0 .01"></path>
                                                        <path d="M16 11l0 .01"></path>
                                                     </svg>
                                                     {{ Str::plural('Comment', $Task->Comments->count()) }} @if( $Task->Comments->count() != 0) :  {{ $Task->Comments->count() }}
                                                    @endif
                                                  </button>&nbsp;
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center">
                                            <span class="text-center text-danger">
                                            No Task found.
                                        </span> 
                                    </td>
                                    </tr>
                                    @endforelse
                                
                                    
                                </tbody>
                                </table>
                                
                            </div>
                            <div class="card-footer d-flex align-items-center">
                            
                                        {{ $MyTasks->links('livewire::bootstrap') }}
                         
                            
                            </div>
                        </div>
                    </div>
                </div>


              </div>
            </div>
            @can('create', App\Models\Task\Task::class)
            <div class="tab-pane" id="tabs-assigned" wire:ignore.self>
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
                              <table class="table table-vcenter table-mobile-md card-table">
                              <thead>
                                  <tr>
                                      <th class="text-center">Id</th>
                                      <th class="text-center">Task</th>
                                      <th class="text-center">Remarks</th>
                                      <th class="text-center">Start Date</th>
                                      <th class="text-center">End Date</th>
                                      <th class="text-center">Assigned Employee</th>
                                      <th class="text-center">Status</th>
                           
                           
                                  </tr>
                              </thead>
                              <tbody>
          
                                  @forelse ($AssignedTasks as $Key => $Task)
                                  <tr>
                                      <td class="text-center" data-label="Id">{{ $Key + 1 }}</td>
                                      @if(!is_null($Task->document_id)) 
                                      <td class="text-center" data-label="Task"><a href="user/document-tracking/view/{{$Task->document_id}}">{{ $Task->task }}</a></td>
                                      @else 
                                      <td class="text-center" data-label="Task">{{ $Task->task }}</td>
                                      @endif
                                      
                                      <td class="text-center" data-label="Remarks">{{ $Task->remarks }}
                                      <td class="text-center" data-label="Start Date">{{ $Task->start_date }}</td>
                                      <td class="text-center" data-label="End Date">{{ $Task->due_date }}</td>
                                      <td class="text-center" data-label="Assigned Employee">{{ $Task->AssignedTo->firstname . ' ' . $Task->AssignedTo->lastname }}</td>
                                      <td class="text-center" data-label="Status"> 
                                      @if ($Task->is_accepted == true)
                                      <button class="btn btn-warning btn-sm text-sm m-1">Accepted / On Process</button> 
                                      @elseif ($Task->is_rejected == true)
                                        <button class="btn btn-danger btn-sm text-sm m-1">Rejected</button>
                                      @elseif ($Task->is_completed == true)
                                      <button class="btn btn-success btn-sm text-sm m-1">Completed</button>
                                      @else 
                                      <button class="btn btn-secondary btn-sm text-sm m-1">Pending</button>
                                      @endif
                                        <button type="button" class="btn btn-sm m-1" wire:click.prevent="showComment({{$Task->id}})">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-message-dots" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M4 21v-13a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-9l-4 4"></path>
                                                <path d="M12 11l0 .01"></path>
                                                <path d="M8 11l0 .01"></path>
                                                <path d="M16 11l0 .01"></path>
                                             </svg>
                                             {{ Str::plural('Comment', $Task->Comments->count()) }} @if( $Task->Comments->count() != 0) :  {{ $Task->Comments->count() }}
                                            @endif
                                          </button>&nbsp;
                                      </tr></td>
                                   
                                  @empty
                                  <tr>
                                      <td colspan="8" class="text-center">
                                          <span class="text-center text-danger">
                                          No Task found.
                                      </span> 
                                  </td>
                                  </tr>
                                  @endforelse
                              
                                  
                              </tbody>
                              </table>
                              
                          </div>
                          <div class="card-footer d-flex align-items-center">
                          
                                      {{ $AssignedTasks->links('livewire::bootstrap') }}
                       
                          
                          </div>
                      </div>
                  </div>
              </div>

              </div>
            </div>
            @endcan
            <div class="tab-pane" id="tabs-process" wire:ignore.self>
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
                              <table class="table table-vcenter table-mobile-md card-table">
                              <thead>
                                  <tr>
                                      <th class="text-center">Id</th>
                                      <th class="text-center">Task</th>
                                      <th class="text-center">Remarks</th>
                                      <th class="text-center">Start Date</th>
                                      <th class="text-center">End Date</th>   
                                      <th class="text-center w-1">Action</th>
                                  </tr>
                              </thead>
                              <tbody>
          
                                  @forelse ($AcceptedTasks as $Key => $Task)
                                  <tr>
                                      <td class="text-center" data-label="Id">{{ $Key + 1 }}</td>
                                      @if(!is_null($Task->document_id)) 
                                      <td class="text-center" data-label="Task"><a href="user/document-tracking/view/{{$Task->document_id}}">{{ $Task->task }}</a></td>
                                      @else 
                                      <td class="text-center" data-label="Task">{{ $Task->task }}</td>
                                      @endif
                                      <td class="text-center" data-label="Remarks">{{ $Task->remarks }}
                                      <td class="text-center" data-label="Start Date">{{ $Task->start_date }}</td>
                                      <td class="text-center" data-label="End Date">{{ $Task->due_date }}</td>
                                      <td class="text-center">
                                          <div class="btn-group">

                                    
                                   
                                         
                                              <a class="btn btn-sm btn-success" wire:click.prevent="updateTaskShow({{$Task->id}})" >Mark Complete</a> &nbsp;

                                              <button type="button" class="btn  btn-sm" wire:click.prevent="showComment({{$Task->id}})">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-message-dots" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M4 21v-13a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-9l-4 4"></path>
                                                    <path d="M12 11l0 .01"></path>
                                                    <path d="M8 11l0 .01"></path>
                                                    <path d="M16 11l0 .01"></path>
                                                 </svg>
                                                 {{ Str::plural('Comment', $Task->Comments->count()) }} @if( $Task->Comments->count() != 0) :  {{ $Task->Comments->count() }}
                                                @endif
                                              </button>&nbsp;
                                              
                                          </div>
                                      </td>
                                  </tr>
                                  @empty
                                  <tr>
                                      <td colspan="8" class="text-center">
                                          <span class="text-center text-danger">
                                          No Task found.
                                      </span> 
                                  </td>
                                  </tr>
                                  @endforelse
                              
                                  
                              </tbody>
                              </table>
                              
                          </div>
                          <div class="card-footer d-flex align-items-center">
                          
                                      {{ $AcceptedTasks->links('livewire::bootstrap') }}
                       
                          
                          </div>
                      </div>
                  </div>
              </div>

              </div>
            </div>
            <div class="tab-pane" id="tabs-completed" wire:ignore.self>
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
                                <table class="table table-vcenter table-mobile-md card-table">
                                <thead>
                                    <tr>
                                        <th class="text-center">Id</th>
                                        <th class="text-center">Task</th>
                                        <th class="text-center">Remarks</th>
                                        <th class="text-center">Start Date</th>
                                        <th class="text-center">End Date</th>   
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
            
                                    @forelse ($CompletedTasks as $Key => $Task)
                                    <tr>
                                        <td class="text-center" data-label="Id">{{ $Key + 1 }}</td>
                                        @if(!is_null($Task->document_id)) 
                                        <td class="text-center" data-label="Task"><a href="user/document-tracking/view/{{$Task->document_id}}">{{ $Task->task }}</a></td>
                                        @else 
                                        <td class="text-center" data-label="Task">{{ $Task->task }}</td>
                                        @endif
                                        <td class="text-center" data-label="Remarks">{{ $Task->remarks }}
                                        <td class="text-center" data-label="Start Date">{{ $Task->start_date }}</td>
                                        <td class="text-center" data-label="End Date">{{ $Task->due_date }}</td>
                                        <td class="text-center">
                                        <button type="button" class="btn  btn-sm" wire:click.prevent="showComment({{$Task->id}})">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-message-dots" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M4 21v-13a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-9l-4 4"></path>
                                                <path d="M12 11l0 .01"></path>
                                                <path d="M8 11l0 .01"></path>
                                                <path d="M16 11l0 .01"></path>
                                             </svg>
                                             {{ Str::plural('Comment', $Task->Comments->count()) }} @if( $Task->Comments->count() != 0) :  {{ $Task->Comments->count() }}
                                            @endif
                                          </button>&nbsp;     
                                        </td>                        
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center">
                                            <span class="text-center text-danger">
                                            No Task found.
                                        </span> 
                                    </td>
                                    </tr>
                                    @endforelse
                                
                                    
                                </tbody>
                                </table>
                                
                            </div>
                            <div class="card-footer d-flex align-items-center">
                            
                                        {{ $CompletedTasks->links('livewire::bootstrap') }}
                         
                            
                            </div>
                        </div>
                    </div>
                </div>

                </div>
              </div>
               <div class="tab-pane" id="tabs-rejected" wire:ignore.self>
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
                                <table class="table table-vcenter table-mobile-md card-table">
                                <thead>
                                    <tr>
                                        <th class="text-center">Id</th>
                                        <th class="text-center">Task</th>
                                        <th class="text-center">Remarks</th>
                                        <th class="text-center">Start Date</th>
                                        <th class="text-center">End Date</th>   
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
            
                                    @forelse ($RejectedTasks as $Key => $Task)
                                    <tr>
                                        <td class="text-center" data-label="PDN">{{ $Key + 1 }}</td>
                                        @if(!is_null($Task->document_id) || $Task->document_id == "") 
                                        <td class="text-center" data-label="Task"><a href="user/document-tracking/view/{{$Task->document_id}}">{{ $Task->task }}</a></td>
                                        @else 
                                        <td class="text-center" data-label="Task">{{ $Task->task }}</td>
                                        @endif
                                        <td class="text-center" data-label="Subject">{{ $Task->remarks }}
                                        <td class="text-center" data-label="PDN">{{ $Task->start_date }}</td>
                                        <td class="text-center" data-label="Document Type">{{ $Task->due_date }}</td>       
                                        <td class="text-center">
                                            <button type="button" class="btn  btn-sm" wire:click.prevent="showComment({{$Task->id}})">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-message-dots" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M4 21v-13a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-9l-4 4"></path>
                                                    <path d="M12 11l0 .01"></path>
                                                    <path d="M8 11l0 .01"></path>
                                                    <path d="M16 11l0 .01"></path>
                                                 </svg>
                                                 {{ Str::plural('Comment', $Task->Comments->count()) }} @if( $Task->Comments->count() != 0) :  {{ $Task->Comments->count() }}
                                                @endif
                                              </button>&nbsp;     
                                            </td>                          
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center">
                                            <span class="text-center text-danger">
                                            No Task found.
                                        </span> 
                                    </td>
                                    </tr>
                                    @endforelse
                                
                                    
                                </tbody>
                                </table>
                                
                            </div>
                            <div class="card-footer d-flex align-items-center">
                            
                                        {{ $RejectedTasks->links('livewire::bootstrap') }}
                         
                            
                            </div>
                        </div>
                    </div>
                </div>


                </div>
              </div>
          </div>
        </div>
      </div>
  </div>
  </div>


  <div wire:ignore.self class="modal modal-blur fade" id="add_task" tabindex="-1" role="dialog" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content" method="POST" wire:submit.prevent='addTask()'>
            <div class="modal-header">
                <h5 class="modal-title"> Add as Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <h3 class="card-title">Task Information</h3>
 
                <div class="mb-3">
                    <label class="form-label">Start Date :</label>
                    <input type="date" class="form-control" wire:model="TaskStart">
                    <span class="text-danger"> 
                        @error('TaskStart')
                            {{ $message }}   
                        @enderror
                    </span>
                </div>
                <div class="mb-3">
                    <label class="form-label">Due Date :</label>
                    <input type="date" class="form-control" wire:model="TaskEnd">
                    <span class="text-danger"> 
                        @error('TaskEnd')
                            {{ $message }}   
                        @enderror
                    </span>
                </div>

          
                <div class="mb-3">
                    <label class="form-label">Employee Name </label>
                    <select class="form-select" wire:model="UserAssignedTask">
                        <option value="" selected>--- Choose Employee Name ---</option>
  
                        @forelse ($EmployeeLists as $Employee)
                        <option value="{{ $Employee[0] }}">{{ $Employee[1] }}</option>
                        @empty
  
                        @endforelse
  
                    </select>
                    <span class="text-danger">
                      @error('UserAssignedTask')
                      {{ $message }}
                      @enderror
                  </span>
                </div>

                <div class="mb-3">
                  <label class="form-label">Task</label>
                  <input type="text" class="form-control" name="" placeholder="Enter Task" wire:model="Task">
                  <span class="text-danger">
                      @error('Task')
                      {{ $message }}
                      @enderror
                  </span>
              </div>

              <div class="mb-3">
                  <label class="form-label">Remarks</label>
                  <input type="text" class="form-control" name="" placeholder="Enter Remarks" wire:model="TaskRemarks">
                  <span class="text-danger">
                      @error('TaskRemarks')
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



<div wire:ignore.self class="modal modal-blur fade" id="accept_task" tabindex="-1" role="dialog" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <form class="modal-content" method="POST" wire:submit.prevent='acceptTask()'>
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
                <div class="text-muted">Do you want to accept this Task.</div>
                    
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

    <div wire:ignore.self class="modal modal-blur fade" id="update_task" tabindex="-1" role="dialog" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <form class="modal-content" method="POST" wire:submit.prevent='completeTask()'>
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
                <div class="text-muted">Do you want to Complete this Task.</div>
                    
            </div>
            <div class="modal-footer">
                <div class="w-100">
                    <div class="row">
                        <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                Cancel
                            </a></div>
                        <div class="col">
                            <button type="submit" class="btn btn-success w-100">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>


  </div>
<div wire:ignore.self class="modal modal-blur fade" id="reject_task" tabindex="-1" role="dialog" aria-hidden="true"
data-bs-backdrop="static" data-bs-keyboard="false">
<div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <form class="modal-content" method="POST" wire:submit.prevent='rejectTask()'>
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
            <div class="text-muted">Do you want to reject this Task.</div>
                
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


<div wire:ignore.self class="modal modal-blur fade" id="add_comment" tabindex="-1" role="dialog" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <form class="modal-content" method="POST" wire:submit.prevent='addComment()'>
            <div class="modal-header">
                <h5 class="modal-title"> Comment(s)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                @forelse ($Comments as $Comment)
                    @if($Comment->user_id == auth('web')->user()->id) 


                    <div class="card mb-1">
                        <div class="row m-2">
                        
                          <div class="col">
                            <div class="text-truncate">
                              <strong>You</strong> commented on this Task : <strong>{{ $Comment->comment}}</strong>.
                              <sub class="text-muted text-sm m-auto"> {{ $Comment->created_at}}</sub>
                            </div>
                            {{-- <div class="text-muted">yesterday</div> --}}
                          </div>
                        
                        </div>
                      </div>

                    @else 
                    <div class="card mb-1">
                        <div class="row m-2">
                        
                          <div class="col">
                            <div class="text-truncate">
                              <strong>{{ $Comment->User->Employee->firstname }}</strong> commented on this Task : <strong>{{ $Comment->comment}}</strong>.
                              <sub class="text-muted text-sm m-auto"> {{ $Comment->created_at}}</sub>
                            </div>
                       
                          </div>
                        
                        </div>
                      </div>
                    @endif

                @empty
                    <div class="mb-3 text-center text-muted">
                        No Comment to show
                    </div>
                @endforelse

            </div>
            @can('addComment', $selected_task_id)
            <div class="modal-footer">
                <div class="col-12">
                    <div class="input-group mb-2">
                      <input type="text" class="form-control" placeholder="Enter Text" wire:model="NewComment">
                      <button class="btn" type="submit"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-send" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M10 14l11 -11"></path>
                        <path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5"></path>
                     </svg></button>
                    </div>
                  </div>
            </div>
            @endcan
        </form>
    </div>
</div>


</div>
