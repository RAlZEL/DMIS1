<div>
    <form action="" method="POST" wire:submit.prevent='{{ $isEditing ? "updateProperty" : "createProperty" }}()'>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">{{ $isEditing ? 'Edit' : 'Create' }} Property Information</h3>
                                      
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Date Acquired :<span class="text-danger">*</span></label>
                                <input type="date" class="form-control" wire:model="date_acquired">
                                <span class="text-danger"> 
                                    @error('date_acquired')
                                    {{ $message }}   
                                @enderror
                                </span>
                            </div>
                      
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label"> Article/Item :<span class="text-danger">*</span></label>
                              
                                <select class="form-select" wire:model="selectedArticle">
                                    <option value="" selected>--- Choose Article ---</option>

                                    @forelse ($articleids as $Article)
                                    <option value="{{ $Article->id }}">{{ $Article->article_name}}</option>
                            
                    
                                    
                                @empty
                                    
                                @endforelse          
                                    
                                </select>
                                
                                <span class="text-danger"> 
                                    @error('selectedArticle')
                                        {{ $message }}   
                                        @enderror
                                </span>
                            
                            </div>
                   
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label"> Description :<span class="text-danger">*</span></label>
                              
                                <select class="form-select" wire:model="selectedArticleDescription">
                                    <option value="" selected>--- Choose Description ---</option>
                                    
                                    @forelse ($articledesciptions as $Article)
                                        <option value="{{ $Article->id }}">{{ $Article->article_description }}</option>
         
                                    @empty
                                    <option value="" selected disabled>No Article Description Found</option>
                                    @endforelse
                                             
                                    
                                </select>
                                
                                <span class="text-danger"> 
                                    @error('selectedArticleDescription')
                                    {{ $message }}   
                                    @enderror
                                </span>
                            
                            </div>
                   
                        </div>
                    </div>

                   
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Specification :<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="Enter Specification" wire:model="specification">
                                <span class="text-danger"> 
                                    @error('specification')
                                    {{ $message }}   
                                    @enderror
                                </span>
                            </div>
                         
                        </div>
                    </div>
                   


                    
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label"> Property No. :<span class="text-danger">*</span></label>
                              
                                <input type="text" class="form-control" placeholder="Enter Property Number" wire:model="propertynumber"> 
                                <span class="text-danger"> 
                                    @error('propertynumber')
                                    {{ $message }}   
                                    @enderror
                                </span>                                                       
                            </div>                   
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label"> Unit Of Measurement :<span class="text-danger"></span></label>
                                <input type="text" class="form-control" placeholder="Enter Unit" wire:model="unitofmeasurement"> 
                                <span class="text-danger"> 
                                    @error('unitofmeasurement')
                                    {{ $message }}   
                                    @enderror
                                </span>                                                       
                            </div>                   
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Unit Value :<span class="text-danger">*</span></label>
                                <input type="number" class="form-control" placeholder="Enter Unit Value" wire:model="unitvalue">
                                <span class="text-danger"> 
                                    @error('unitvalue')
                                    {{ $message }}   
                                    @enderror
                                </span>
                            </div>
                         
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Quantity Per Property Card :<span class="text-danger"></span></label>
                                <input type="number" class="form-control" placeholder="Enter Quantity Per Card" wire:model="quantitypercard">
                                <span class="text-danger"> 
                                    @error('quantitypercard')
                                    {{ $message }}   
                                    @enderror
                                </span>
                            </div>
                         
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Quantity Per Physical Count :<span class="text-danger"></span></label>
                                <input type="number" class="form-control" placeholder="Quantity Per Physical Count" wire:model="quantityphysicalcount">
                                <span class="text-danger"> 
                                    @error('quantityphysicalcount')
                                    {{ $message }}   
                                    @enderror
                                </span>
                            </div>
                         
                        </div>
                    </div>

                   
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label"> Remarks :<span class="text-danger">*</span></label>
                              
                                <select class="form-select" wire:model="remarks">
                                    <option value="" selected>--- Choose Remarks ---</option>
                                    <option value="IN GOOD CONDITION" selected>IN GOOD CONDITION</option>  
                                    <option value="FOR SURRENDER" selected>FOR SURRENDER</option>   
                                    
                                </select>
                                
                                <span class="text-danger"> 
                                    @error('remarks')
                                    {{ $message }}   
                                    @enderror
                                </span>
                            
                            </div>
                   
                        </div>
                    </div> 
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label"> Office :<span class="text-danger">*</span></label>
                              
                                <select class="form-select" wire:model="SelectedOffice">
                                    <option value="" selected>--- Choose Office ---</option>
                                    @forelse ($OfficeLists as $Office)
                                <option value="{{ $Office->id }}">
                                    {{ $Office->office}}
                                </option>
                                @empty

                                @endforelse         
                                    
                                </select>
                                
                                <span class="text-danger"> 
                                    @error('SelectedOffice')
                                    {{ $message }}   
                                    @enderror
                                </span>
                            </div>
                   
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label"> Accountable Officer :<span class="text-danger">*</span></label>
                              
                                <select class="form-select" wire:model="selectedEmployee">
                                    <option value="" selected>--- Choose Employee ---</option>
                                    @forelse ($Employees as $Employee)
                                    <option value="{{ $Employee->id }}">
                                        {{ $Employee->firstname . ' ' . $Employee->middlename . ' ' . $Employee->lastname}}
                                    </option>
                                    @empty
    
                                    @endforelse  
                                </select>
                                
                                <span class="text-danger"> 
                                    @error('selectedEmployee')
                                    {{ $message }}   
                                    @enderror
                                </span>
                            
                            
                            </div>
                   
                        </div>
                    </div>

                   

                                   

                    <button type="submit" class="btn btn-primary">{{ $isEditing ? 'Update' : 'Create' }}</button>
                </div>
            </div>
        </div>

      
    </form>


    <div wire:ignore.self class="modal modal-blur fade" id="view_property" tabindex="-1" role="dialog" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <form class="modal-content" method="POST" wire:submit.prevent='viewProperty'>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-success"></div>
            <div class="modal-body text-center py-4">
                <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->

                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                    <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"></path>
                 </svg>
                <h3>Property Created</h3>
                <div class="text-muted">Property Created Successfully</div>
                
            </div>
            <div class="modal-footer">
                <div class="w-100">
                    <div class="row">
                        <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                Cancel
                            </a></div>
                        <div class="col">
                            <button type="submit" class="btn btn-success w-100">OK</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit Property Modal -->
<div wire:ignore.self class="modal modal-blur fade" id="edit_property" tabindex="-1" role="dialog" aria-hidden="true"
data-bs-backdrop="static" data-bs-keyboard="false">
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <form class="modal-content" method="POST" wire:submit.prevent='updateProperty'>
        <div class="modal-header">
            <h5 class="modal-title">Edit Property</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- <div class="modal-footer">
            <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
        </div> -->
    </form>
</div>
</div>

   

</div>
