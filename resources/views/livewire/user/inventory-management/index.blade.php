<div>
    <div class="row row-cards"> 
        <div class="col-12">
            <div class="card">
                <div class="card-body border-bottom py-3">
                    <div class="d-flex flex-wrap gap-3 align-items-center">
                        <div class="text-muted d-flex align-items-center">
                            <span class="me-2">Show</span>
                            <div class="mx-2 d-inline-block">
                                <select class="form-select" wire:model="perPage">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                            <span>entries</span>
                        </div>

                        <div class="ms-auto d-flex gap-2">
                            <button type="button" class="btn btn-outline-secondary btn-sm" wire:click="resetToFirstPage">Reset Page</button>
                            <button type="button" class="btn btn-primary btn-sm" wire:click="openFilterModal" data-bs-toggle="modal" data-bs-target="#filterModal">Filters</button>
                        </div>
                    </div>
                </div>

                <div class="px-3 py-3">
                    <div class="row g-3">
                        <div class="col-sm-4 col-12">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body py-2">
                                    <div class="text-muted mb-1">Total Items (All)</div>
                                    <div class="h4 mb-0">{{ number_format($totalCountAll) }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-12">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body py-2">
                                    <div class="text-muted mb-1">Filtered Items</div>
                                    <div class="h4 mb-0">{{ number_format($filteredCount) }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-12">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body py-2">
                                    <div class="text-muted mb-1">Total Unit Value (Filtered)</div>
                                    <div class="h4 mb-0">₱ {{ number_format($totalUnitValue, 2) }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @include('livewire.user.inventory-management.partials.filter-modal')
                <div class="table-responsive">
                    <table class="table table-vcenter table-mobile-md card-table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center" role="button" wire:click="sortBy('article_id')" style="min-width: 120px;">ARTICLE ITEM</th>
                            <th class="text-center" role="button" wire:click="sortBy('article_description')" style="min-width: 100px;">DESCRIPTION</th>
                            <th class="text-center" role="button" wire:click="sortBy('property_no')" style="min-width: 150px;">PROPERTY NO.</th>
                            <th class="text-center" role="button" wire:click="sortBy('date_acquired')" style="min-width: 120px;">DATE ACQUIRED</th>
                            <th class="text-center" role="button" wire:click="sortBy('unit_value')" style="min-width: 120px;">UNIT VALUE</th>
                            <th class="text-center" role="button" wire:click="sortBy('remarks')" style="min-width: 140px;">REMARKS</th>
                            <th class="text-center" role="button" wire:click="sortBy('accountable_officer')" style="min-width: 140px;">ACCOUNTABLE OFFICER</th>
                            <th class="text-center" style="min-width: 140px;">OFFICE</th>
                            <th class="text-center w-1">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($properties as $Index => $property)
                        <tr>
                            <td class="text-center">{{ $property->ArticleName->article_name ?? 'N/A' }}</td>
                            <td class="text-center">{{ $property->ArticleDescription->article_description }}</td>
                            <td class="text-center">{{ $property->property_no }}</td>
                            <td class="text-center">
                                {{ $property->date_acquired ? \Carbon\Carbon::parse($property->date_acquired)->format('Y-m-d') : 'N/A' }}
                            </td>
                            <td class="text-center">
                                {{ $property->unit_value !== null ? '₱ ' . number_format($property->unit_value, 2) : 'N/A' }}
                            </td>
                            <td class="text-center">
                                @php
                                    $remarksText = $property->remarks ?? 'N/A';
                                    $remarksUpper = strtoupper($remarksText);
                                    $badgeClass = 'bg-secondary';
                                    if ($remarksUpper === 'IN GOOD CONDITION') {
                                        $badgeClass = 'bg-success';
                                    } elseif (str_contains($remarksUpper, 'SURRENDER')) {
                                        $badgeClass = 'bg-warning text-dark';
                                    } elseif (str_contains($remarksUpper, 'DISPOSAL') || str_contains($remarksUpper, 'DISPOSE')) {
                                        $badgeClass = 'bg-danger';
                                    }
                                @endphp
                                <span class="badge {{ $badgeClass }}">{{ $remarksText }}</span>
                            </td>
                            <td class="text-center">
                                @if($property->Employee)
                                    {{ $property->Employee->firstname . ' ' . $property->Employee->middlename . ' ' . $property->Employee->lastname }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="text-center">{{ $property->Office->office ?? 'N/A' }}</td>
                            <td class="text-center">
                                <div class="d-flex gap-2 justify-content-center">
                                    <button wire:click="editProperty({{ $property->id }})" class="btn btn-sm btn-icon btn-primary" title="Edit" aria-label="Edit">
                                        <i class="fa-solid fa-pen-to-square" aria-hidden="true"></i>
                                    </button>
                                    <button wire:click="confirmDelete({{ $property->id }})" class="btn btn-sm btn-icon btn-danger" data-bs-toggle="modal" data-bs-target="#deletePropertyModal" title="Delete" aria-label="Delete">
                                        <i class="fa-regular fa-trash-can" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">
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
                    {{ $properties->links() }}
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

    {{-- Removed create property form from homepage --}}

    @include('livewire.user.inventory-management.update')

    <!-- Delete Confirmation Modal -->
    <div wire:ignore.self class="modal modal-blur fade" id="deletePropertyModal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <form class="modal-content" method="POST" wire:submit.prevent="deleteProperty()">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-status bg-danger"></div>
                <div class="modal-body text-center py-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v2m0 4v.01" /><path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" /></svg>
                    <h3>Are you sure?</h3>
                    <div class="text-muted">Do you really want to delete this property?</div>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <div class="row">
                            <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">Cancel</a></div>
                            <div class="col"><button type="submit" class="btn btn-danger w-100" data-bs-dismiss="modal">Delete</button></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
