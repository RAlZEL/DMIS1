<div>

    <div class="col-12">
        <div class="card mt-2">
            <div class="card-header">

             

                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="true">
                        Actions
                    </button>
                    <div class="dropdown-menu dropdown-menu-demo">

                        @can ('acceptIncoming',$selected_document)
             
                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#accept_document">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M5 12l5 5l10 -10"></path>
                             </svg>
                            <span class="mx-2">Accept Document</span>
                        </a>

                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#reject_document">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-ban" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                <path d="M5.7 5.7l12.6 12.6"></path>
                             </svg>
                            <span class="mx-2">Reject Document</span>
                        </a>

                        <div class="dropdown-divider"></div>
                        @endcan

                    

                        @can ('markasclosed',$selected_document)
             
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



                        @can ('addAttachment',$selected_document)
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
                            href="{{ route('document-tracking.documentprint',[$selected_document->id]) }}"
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
                        </a>

                        @can('addTask',$selected_document )

                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#add_task">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-star" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                <path d="M6 21v-2a4 4 0 0 1 4 -4h.5"></path>
                                <path d="M17.8 20.817l-2.172 1.138a.392 .392 0 0 1 -.568 -.41l.415 -2.411l-1.757 -1.707a.389 .389 0 0 1 .217 -.665l2.428 -.352l1.086 -2.193a.392 .392 0 0 1 .702 0l1.086 2.193l2.428 .352a.39 .39 0 0 1 .217 .665l-1.757 1.707l.414 2.41a.39 .39 0 0 1 -.567 .411l-2.172 -1.138z"></path>
                             </svg>
                            <span class="mx-2">Add Task</span>
                        </a>
                        @endcan


                 


                        @can ('addRoute',$selected_document)

                        <div class="dropdown-divider"></div>

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

                      


                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-2">
            <div class="card-body">

                <div class="card-header">
                    <h3>Document Information</h3>
                    <div class="card-actions">
                        @can ('update', $selected_document)
                        <a href="" data-bs-toggle="modal" data-bs-target="#edit_document">
                            Edit Document
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
                </div>

                <div class="card-body">

                    <div class="row invoice-info mb-2">
                        <div class="col-sm-2 invoice-col">
                            <strong> Date Received </strong>
                        </div>
                        <div class="col-sm-10 invoice-col">
                            {{ $datereceived }}
                        </div>
                    </div>

                    <div class="row invoice-info mb-2">
                        <div class="col-sm-2 invoice-col">
                            <strong> PDN  </strong>
                        </div>
                        <div class="col-sm-10 invoice-col">
                            {{ $PDN }}
                        </div>
                    </div>

                    <div class="row invoice-info mb-2">
                        <div class="col-sm-2 invoice-col">
                            <strong> Document Type </strong>
                        </div>
                        <div class="col-sm-10 invoice-col">
                            {{ $doc_type }}
                        </div>
                    </div>

                    <div class="row invoice-info mb-2">
                        <div class="col-sm-2 invoice-col">
                            <strong> Subject </strong>
                        </div>
                        <div class="col-sm-10 invoice-col">
                            {{ $subject }}
                            
                            @if ($is_paperless == true)
                            <span class="btn btn-success btn-sm"> Paperless
                            </span>
                        @endif
                        
                          
                             @if ($is_urgent == true)
                            <span class="btn btn-danger btn-sm"> Urgent
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="dropdown-divider"></div>

                    <div class="row invoice-info mb-2">
                        <div class="col-sm-2 invoice-col">
                            <strong> Originating Office </strong>
                        </div>
                        <div class="col-sm-10 invoice-col">
                            {{ $originatingoffice }}
                        </div>
                    </div>

                    <div class="row invoice-info mb-2">
                        <div class="col-sm-2 invoice-col">
                            <strong> Sender Name </strong>
                        </div>
                        <div class="col-sm-10 invoice-col">
                            {{ $sendername }}
                        </div>
                    </div>

                    <div class="row invoice-info mb-2">
                        <div class="col-sm-2 invoice-col">
                            <strong> Address </strong>
                        </div>
                        <div class="col-sm-10 invoice-col">
                            {{ $senderaddress }}
                        </div>
                    </div>

                    <div class="dropdown-divider"></div>


                    <div class="row invoice-info mb-2">
                        <div class="col-sm-2 invoice-col">
                            <strong> Addressee </strong>
                        </div>
                        <div class="col-sm-10 invoice-col">
                            {{ $addressee }}
                        </div>
                    </div>

                    <div class="row invoice-info mb-2">
                        <div class="col-sm-2 invoice-col">
                            <strong> Attachment(s) </strong>
                        </div>
                           @forelse ($attachments as $attachment)
                        <div class="col-sm-10 invoice-col">
                            {{-- @livewire('user.document-tracking.attachment',['id' => $PDN]) --}}
                            
                            
                                {{ $attachment->attachmentdetails}} - <a
                                    href="{{ route('document-tracking.attachmentview', [$attachment->id]) }}"
                                    target="_blank">{{ $attachment->attachment}}</a>

                                @can ('deleteAttachment',$selected_document)
                                <a href="" class="text-danger mx-2 btn-sm"
                                    wire:click.prevent="deleteAttachment({{$attachment->id}})">Remove</a> &nbsp;
                                @endcan
 
                        </div>
                           @empty

                            <span class="text-danger">No Attachment</span>

                            @endforelse
                    </div>
                </div>

            </div>
        </div>


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


                                    @if ($Route->action == "ATTACHED A FILE")
                                    <li>

                                        <div class="list-timeline-icon bg-yellow">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/settings -->
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-paperclip" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path
                                                    d="M15 7l-6.5 6.5a1.5 1.5 0 0 0 3 3l6.5 -6.5a3 3 0 0 0 -6 -6l-6.5 6.5a4.5 4.5 0 0 0 9 9l6.5 -6.5">
                                                </path>
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

                                    @if ($Route->action == "ADD AS TASK")
                                    <li>

                                        <div class="list-timeline-icon bg-yellow">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/settings -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-star" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"></path>
                                             </svg>
                                        </div>
                                        <div class="list-timeline-content">
                                            <div class="list-timeline-time">{{ $Route->created_at->diffforhumans()}}</div>
                                            <div class="list-timeline-title">ADDED TASK TO - {{ $Route->Task->AssignedTo->firstname . ' ' . $Route->Task->AssignedTo->lastname }} 
                                                 @if ( $Route->Task->is_accepted == true)
                                                 <span class="btn btn-warning btn-sm text-sm">Accepted / On Process</span>
                                                  @elseif ($Route->Task->is_rejected == true)
                                                  <span class="btn btn-danger btn-sm text-sm">Rejected</span>
                                                  @elseif ($Route->Task->is_completed == true)
                                                  <span class="btn btn-success btn-sm text-sm">Completed</span>
                                                  @else 
                                                  <span class="btn btn-secondary btn-sm text-sm">Pending</span>
                                                  @endif

                                                  @if(!is_null($Route->task_id))
                                        
                                                  @if($Route->TaskComment->count() != 0) 

                                                    <button type="button" class="btn  btn-sm" wire:click.prevent="showComment({{$Route->id}})">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-message-dots" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M4 21v-13a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-9l-4 4"></path>
                                                            <path d="M12 11l0 .01"></path>
                                                            <path d="M8 11l0 .01"></path>
                                                            <path d="M16 11l0 .01"></path>
                                                         </svg>
                                                         {{ Str::plural('Comment', $Route->TaskComment->count()) . ': ' . $Route->TaskComment->count() }}
                                                     
                                                      </button>

                                                    @endif
                                                  @endif
                                            </div>
                                            <div>
                                                <i class="text-sm text-muted">
                                                    {{ $Route->office->office . ' - ' . $Route->division->division .' - ' . $Route->unit->unit}}
                                                    </i> <sub class="text-muted">by {{$Route->user->username}}. <i>{{ $Route->created_at}}</i> </sub></div>
                                            
                                            @if(!empty($Route->remarks))
                                            <p class="text-muted">Remarks: {{$Route->remarks}}
                                            </p>
                                            @endif
                                        </div>
                                            
                                    </li>
                                    @endif



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
                                            @if(!empty($Route->remarks))
                                            <p class="text-muted"> with Remarks: {{$Route->remarks}}
                                            </p>
                                            @endif
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
                                    <div class="list-timeline-title">FORWARDED TO </div>
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

                            @if($Route->action == "DOCUMENT CREATED")
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
                    <label class="form-label">Task Action</label>
                    <input type="text" class="form-control" name="" placeholder="Add as Task" wire:model="addasTask"
                        disabled>
                    <span class="text-danger">
                        @error('addasTask')
                        {{ $message }}
                        @enderror
                    </span>
                </div>

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
                        <option value="{{ $Employee[0] }}">{{ $Employee[1]}}</option>
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
                  <label class="form-label">Task Remarks</label>
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




{{-- @can ('addRoute',$selected_document) --}}

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
                      <option value="{{ $Office->id }}">{{ $Office->office }}</option>
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
                <label class="form-label">Office / Section /Unit</label>
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
                  
                  <datalist id="routeremarks">
                      <option value="PLS ATTEND.">
                    <option value="PLS ACT.">
                    <option value="FOR ATTENDANCE, PLS">
                    <option value="FOR APPROPRIATE ACTION, PLS">
                    <option value="FOR EVALUATION AND FURTHER APPROPRIATE ACTION, PLS">
                    <option value="FOR INFORMATION AND RECORD, PLS">
                    <option value="FOR INFORMATION AND GUIDANCE, PLS">
                    <option value="FOR DISSEMINATION, PLS">
                    <option value="FOR CHECKING AND RECORDING, PLS">
                    <option value="FOR PRIORITY / URGENT ACTION, PLS">
                </datalist>


                  <input type="text" class="form-control"  list="routeremarks" name="" placeholder="Enter Remarks" wire:model="remarks">
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
                 <div class="mb-3">
                    <label class="form-label">Remarks</label>
                    <input type="text" class="form-control" name="" placeholder="Enter Remarks" wire:model="closeremarks"
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
@endcan



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
                            <div class="text-muted">
                              <strong>You</strong> commented on this Task : <strong>{{ $Comment->comment}}</strong>.
                              <sub class="text-muted text-sm m-auto"> {{ $Comment->created_at}}</sub>
                            </div>
                           
                          </div>
                        
                        </div>
                      </div>

                    @else 
                    <div class="card mb-1">
                        <div class="row m-2">
                        
                          <div class="col">
                            <div class="text-muted">
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
