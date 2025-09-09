<div>
    <form action="" method="POST" wire:submit.prevent='createDocument()'>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Document Information</h3>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_urgent" id="is_urgent" wire:model="is_urgent">
                                <span class="form-check-label">Is Urgent </span>
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
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_paperless" id="is_paperless" wire:model="is_paperless">
                                <span class="form-check-label">Is Paperless </span>
                                </label>    
                            </div>
                            <span class="text-danger"> 
                                @error('is_paperless')
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
                                <input type="text" class="form-control" name="originatingoffice" placeholder="Enter Originating Office" wire:model="originatingoffice">
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
                                <input type="text" class="form-control" name="sendername" placeholder="Enter Sender Name" wire:model="sendername">
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
                                <input type="text" class="form-control" name="senderaddress" placeholder="Enter Sender Address" wire:model="senderaddress">
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
                                <input type="text" class="form-control" name="doc_type" list="doctype" placeholder="--- ADD OR SELECT DOCUMENT TYPE ---" oninput="this.value = this.value.toUpperCase()" wire:model="doc_type">
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
                                <input type="text" class="form-control" name="originatingoffice" placeholder="Enter Subject" wire:model="subject">
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
                                <input type="text" class="form-control" name="addressee" placeholder="Enter Addressee" wire:model="addressee">
                                <span class="text-danger"> 
                                    @error('addressee')
                                        {{ $message }}   
                                    @enderror
                                </span>
                            </div>
                    
                        </div>
                    </div>



                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </div>
        </div>

      
    </form>

    @if(!is_null($newPDN))
        <div wire:ignore.self class="modal modal-blur fade" id="view_document" tabindex="-1" role="dialog" aria-hidden="true"
            data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <form class="modal-content" method="POST" wire:submit.prevent='viewDocument({{ $newPDN->id}})'>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-status bg-success"></div>
                    <div class="modal-body text-center py-4">
                        <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->

                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                            <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"></path>
                         </svg>
                        <h3>View Document</h3>
                        <div class="text-muted">Do you  want to view New Created Document?</div>
                        <div>{{ $newPDN->PDN }}</div>
                    </div>
                    <div class="modal-footer">
                        <div class="w-100">
                            <div class="row">
                                <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                        Cancel
                                    </a></div>
                                <div class="col">
                                    <button type="submit" class="btn btn-success w-100">View</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif

</div>
