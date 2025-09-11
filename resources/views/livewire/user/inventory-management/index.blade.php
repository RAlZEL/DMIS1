@section('pageTitle', 'Inventory Management System')
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
                            <th class="text-center">ID</th>
                            <th class="text-center">ARTICLE ITEM</th>
                            <th class="text-center">DESCRIPTION</th>
                            <th class="text-center">PROPERTY NO.</th>
                            <th class="text-center">UNIT VALUE</th>
                            <th class="text-center">REMARKS</th>
                            <th class="text-center">ACCOUNTABLE OFFICER</th>
                            <th class="text-center w-1">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($properties as $Index => $property)
                        <tr>
                            <td class="text-center">{{ $property->id }}</td>
                            <td class="text-center">{{ $property->ArticleName->article_id }}</td>
                            <td class="text-center">{{ $property->ArticleDescription->article_description }}</td>
                            <td class="text-center">{{ $property->property_no }}</td>
                            <td class="text-center">{{ $property->unit_value}}</td>
                            <td class="text-center">{{ $property->remarks}}</td>
                            <td class="text-center">{{ $property->accountable_officer}}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    {{-- <a href="user/financial-management-system/view/{{$property->id}}" class="btn btn-sm btn-primary" target="_blank">Edit</a> &nbsp; --}}
                                    <a href="#" class="btn btn-sm btn-primary" target="_blank">Edit</a> &nbsp;
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">
                                <span class="text-center text-danger">
                                   No Property Found.
                               </span> 
                           </td>
                        </tr>
                        @endforelse
                    
                        
                    </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex align-items-center">
                    {{-- {{ $Offices->links('livewire::bootstrap') }} --}}
                </div>
            </div>
        </div>
    </div>
{{-- 
    <div wire:ignore.self class="modal modal-blur fade" id="add_office" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <form class="modal-content" method="POST"
                @if($updateOffice)
                    wire:submit.prevent='updateOffice()'
                @else
                    wire:submit.prevent="addOffice()"
                @endif
            >
            <div class="modal-header">
              <h5 class="modal-title"> {{ $updateOffice ? 'Update Office ' : 'Add Office'}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
    
                <div class="mb-3">
                    <label class="form-label">Office Name</label>
                    <input type="text" class="form-control" name="office" placeholder="Enter Office Name" wire:model="office">
                  </div>  
                  <span class="text-danger"> @error('office')
                    {{ $message }}
                      
                  @enderror</span>   

                  <div class="mb-3">
                    <label class="form-label">Address</label>
                    <input type="text" class="form-control" name="address" placeholder="Enter Address" wire:model="address">
                  </div>  
                  <span class="text-danger">
                    @error('address')
                        {{ $message }}
                      
                    @enderror</span> 

            </div>
            <div class="modal-footer">
              <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">{{ $updateOffice ? 'Update' : 'Save'}}</button>
            </div>
        </form>
        </div>
    </div>

    <div wire:ignore.self class="modal modal-blur fade" id="delete_office" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
          <form class="modal-content" method="POST"     wire:submit.prevent='destroyOffice()'>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-danger"></div>
            <div class="modal-body text-center py-4">
              <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v2m0 4v.01" /><path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" /></svg>
              <h3>Are you sure?</h3>
              <div class="text-muted">Do you really want to delete this office.</div>
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
    </div> --}}

</div>
