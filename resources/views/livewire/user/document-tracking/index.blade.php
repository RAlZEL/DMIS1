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
                            <td data-label="PDN">{{ $Document->PDN }}</td>
                            <td data-label="Document Type">{{ $Document->doc_type }}</td>
                            <td data-label="Subject">{{ $Document->subject }}
                  
                                
                                @if ($Document->is_urgent == true)
                                    <span class="btn btn-danger btn-sm"> Urgent
                                    </span>
                                @endif
                                
                                
                                @if ($Document->is_paperless == true)
                                    <span class="btn btn-success btn-sm"> Paperless
                                    </span>
                                @endif
                                
                                
                            </td>
                            <td data-label="Originating Office">{{ $Document->originatingoffice }}</td>
                            <td data-label="Sender Name">{{ $Document->sendername }}</td>
                            <td data-label="Addressee">{{ $Document->addressee }}</td>
                            <td data-label="Date Received">{{ $Document->datereceived }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="user/document-tracking/view/{{$Document->id}}" class="btn btn-sm btn-primary" target="_blank">View</a> &nbsp;
                                 
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
</div>
