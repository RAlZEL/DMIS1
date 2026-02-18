<div style="margin: 0; padding: 0; overflow: hidden; width: 100%;">
    <div class="row" style="margin: 0; width: 100%;">
        <div class="col-12" style="padding: 0;">
            <div class="card" style="margin: 0; border-radius: 0; overflow: hidden;">
                <!-- Header Section -->
                <div class="card-body border-bottom" style="padding: 0.6rem 0.75rem !important;">
                    <div class="d-flex flex-wrap gap-3 align-items-center">
                        <!-- Left: Entries Per Page -->
                        <div class="text-muted d-flex align-items-center">
                            <span class="me-2 fw-500"><i class="fa-solid fa-list me-1"></i>Show</span>
                            <div class="mx-2 d-inline-block">
                                <select class="form-select form-select-sm" wire:model="perPage" style="min-width: 80px;">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                            <span class="text-sm">entries</span>
                        </div>

                        <!-- Right: Action Buttons -->
                        <div class="ms-auto d-flex gap-2 flex-wrap">
                            <button type="button" class="btn btn-info btn-sm gap-2" data-bs-toggle="modal" data-bs-target="#article_modal" title="Manage articles">
                                <i class="fa-solid fa-tags"></i>
                                <span>Add Article</span>
                            </button>
                            <button type="button" class="btn btn-success btn-sm gap-2" data-bs-toggle="modal" data-bs-target="#create_property_modal" title="Add a new property">
                                <i class="fa-solid fa-plus"></i>
                                <span>Add Property</span>
                            </button>
                            <a href="{{ route('user.inventoryPrint') }}" target="_blank" class="btn btn-warning btn-sm gap-2" title="Print inventory">
                                <i class="fa-solid fa-print"></i>
                                <span>Print</span>
                            </a>
                            <button type="button" class="btn btn-outline-secondary btn-sm gap-2" wire:click="resetToFirstPage" title="Reset filters and pagination">
                                <i class="fa-solid fa-rotate-left"></i>
                                <span>Reset</span>
                            </button>
                            <button type="button" class="btn btn-primary btn-sm gap-2" wire:click="openFilterModal" data-bs-toggle="modal" data-bs-target="#filterModal" title="Apply filters to properties">
                                <i class="fa-solid fa-filter"></i>
                                <span>Filters</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Statistics Cards -->
                <div class="px-3 py-2 bg-light">
                    <div class="row g-3">
                        <div class="col-sm-4 col-12">
                            <div class="card h-100 shadow-sm border-0">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <div class="text-muted text-sm mb-1">
                                                <i class="fa-solid fa-box me-1 text-primary"></i>Total Items (All)
                                            </div>
                                            <div class="h3 mb-0 fw-bold text-primary">{{ number_format($totalCountAll) }}</div>
                                        </div>
                                        <div class="text-primary opacity-50">
                                            <i class="fa-solid fa-inbox fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-12">
                            <div class="card h-100 shadow-sm border-0">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <div class="text-muted text-sm mb-1">
                                                <i class="fa-solid fa-filter me-1 text-info"></i>Filtered Items
                                            </div>
                                            <div class="h3 mb-0 fw-bold text-info">{{ number_format($filteredCount) }}</div>
                                        </div>
                                        <div class="text-info opacity-50">
                                            <i class="fa-solid fa-list-check fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-12">
                            <div class="card h-100 shadow-sm border-0">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <div class="text-muted text-sm mb-1">
                                                <i class="fa-solid fa-peso-sign me-1 text-success"></i>Total Unit Value (Filtered)
                                            </div>
                                            <div class="h3 mb-0 fw-bold text-success"><span class="currency-inline">₱&nbsp;{{ number_format($totalUnitValue, 2) }}</span></div>
                                        </div>
                                        <div class="text-success opacity-50">
                                            <i class="fa-solid fa-calculator fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @include('livewire.user.inventory-management.partials.filter-modal')
                @include('livewire.user.inventory-management.partials.create-property-modal')
                
                <!-- Table Section -->
                <div class="table-responsive">
                    <table class="table table-vcenter table-mobile-md card-table table-striped inventory-table mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-center fw-bold">
                                <span>ARTICLE ITEM</span>
                            </th>
                            <th class="text-center fw-bold">
                                <span>DESCRIPTION</span>
                            </th>
                            <th class="text-center fw-bold">
                                <span>PROPERTY NO.</span>
                            </th>
                            <th class="text-center fw-bold">
                                <span>DATE ACQUIRED</span>
                            </th>
                            <th class="text-center fw-bold">
                                <span>UNIT VALUE</span>
                            </th>
                            <th class="text-center fw-bold d-none d-lg-table-cell">
                                <span>SPECIFICATION</span>
                            </th>
                            <th class="text-center fw-bold d-none d-lg-table-cell">
                                <span>UNIT OF MEASUREMENT</span>
                            </th>
                            <th class="text-center fw-bold d-none d-lg-table-cell">
                                <span>QTY/CARD</span>
                            </th>
                            <th class="text-center fw-bold d-none d-lg-table-cell">
                                <span>QTY/COUNT</span>
                            </th>
                            <th class="text-center fw-bold cursor-pointer user-select-none" role="button" wire:click="sortBy('remarks')">
                                <span>REMARKS</span>
                                <i class="fa-solid fa-arrow-up-down fa-xs ms-1 opacity-50"></i>
                            </th>
                            <th class="text-center fw-bold">ACCOUNTABLE OFFICER</th>
                            <th class="text-center fw-bold">OFFICE</th>
                            <th class="text-center fw-bold w-1">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($properties as $Index => $property)
                        <tr class="table-row-hover">
                            <td class="text-center fw-500">{{ $property->ArticleName->article_name ?? 'N/A' }}</td>
                            <td class="text-center text-muted">{{ $property->ArticleDescription->article_description }}</td>
                            <td class="text-center fw-500">{{ $property->property_no }}</td>
                            <td class="text-center date-cell">
                              <span class="badge bg-light text-dark date-badge" style="font-size: 0.75rem; font-weight: 700; padding: 0.35rem 0.5rem;">{{ $property->date_acquired ? \Carbon\Carbon::parse($property->date_acquired)->format('Y-m-d') : 'N/A' }}</span>
                            </td>
                            <td class="text-center fw-600 text-success">
                                @if($property->unit_value !== null)
                                    <span class="currency-inline">₱&nbsp;{{ number_format($property->unit_value, 2) }}</span>
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="text-center text-muted d-none d-lg-table-cell">
                              {{ $property->specification ?? 'N/A' }}
                            </td>
                            <td class="text-center text-muted d-none d-lg-table-cell">
                                {{ $property->unit_of_measurement ?? 'N/A' }}
                            </td>
                            <td class="text-center text-muted d-none d-lg-table-cell">
                                {{ $property->quantity_per_card ?? 'N/A' }}
                            </td>
                            <td class="text-center text-muted d-none d-lg-table-cell">
                                {{ $property->quantity_per_count ?? 'N/A' }}
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
                                <span class="badge {{ $badgeClass }} px-2 py-1">{{ $remarksText }}</span>
                            </td>
                            <td class="text-center text-sm">
                                @if($property->Employee)
                                    <span class="text-muted">{{ $property->Employee->firstname . ' ' . substr($property->Employee->middlename, 0, 1) . '. ' . $property->Employee->lastname }}</span>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td class="text-center text-sm">
                                <span class="text-muted">{{ $property->Office->office ?? '—' }}</span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <button wire:click="editProperty({{ $property->id }})" class="btn btn-sm btn-outline-primary btn-action-edit" title="Edit property" data-bs-toggle="tooltip">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button wire:click="confirmDelete({{ $property->id }})" class="btn btn-sm btn-outline-danger btn-action-delete" title="Delete property" data-bs-toggle="tooltip" data-bs-target="#deletePropertyModal">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="13" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fa-solid fa-inbox fa-2x mb-2 opacity-50 d-block"></i>
                                    <span class="fw-500">No properties found</span>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    </table>
                </div>
                
                <!-- Pagination Footer -->
                <div class="card-footer px-4 py-3 bg-light">
                    <div class="d-flex align-items-center justify-content-end">
                        {{ $properties->links() }}
                    </div>
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

@push('styles')
<style>
        /* ============ INVENTORY MANAGEMENT SYSTEM - POLISHED UI ============ */
        
        /* LAYOUT FIXES */
        html, body {
                overflow-x: hidden !important;
                max-width: 100vw !important;
                background: #f8fafc !important;
        }

        .page-body {
                overflow-x: hidden !important;
                max-width: 100vw !important;
        }

        /* CUSTOM SCROLLBAR */
        .table-responsive::-webkit-scrollbar {
                width: 8px;
                height: 8px;
        }

        .table-responsive::-webkit-scrollbar-track {
                background: #f1f5f9;
                border-radius: 10px;
        }

        .table-responsive::-webkit-scrollbar-thumb {
                background: linear-gradient(135deg, #94a3b8 0%, #64748b 100%);
                border-radius: 10px;
        }

        .table-responsive::-webkit-scrollbar-thumb:hover {
                background: linear-gradient(135deg, #64748b 0%, #475569 100%);
        }

        /* TOOLTIPS */
        .tooltip {
                font-size: 0.75rem !important;
        }

        .tooltip-inner {
                background: #1e293b !important;
                border-radius: 6px !important;
                padding: 0.5rem 0.75rem !important;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15) !important;
        }

        /* STATISTICS CARDS */
        .px-3.py-2.bg-light {
                padding: 1.25rem 1.5rem !important;
                background: linear-gradient(135deg, #f5f7fa 0%, #f8f9fa 100%) !important;
        }

        .px-3.py-2.bg-light .card {
                border: none !important;
                border-radius: 12px !important;
                box-shadow: 0 2px 8px rgba(0,0,0,0.06), 0 1px 3px rgba(0,0,0,0.04) !important;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
                overflow: hidden !important;
        }

        .px-3.py-2.bg-light .card:hover {
                box-shadow: 0 8px 16px rgba(0,0,0,0.1), 0 3px 6px rgba(0,0,0,0.06) !important;
                transform: translateY(-4px) !important;
        }

        .px-3.py-2.bg-light .card .card-body {
                padding: 1.25rem !important;
        }

        .px-3.py-2.bg-light .card .h3 {
                font-size: 1.75rem !important;
                font-weight: 700 !important;
                letter-spacing: -0.5px !important;
        }

        .px-3.py-2.bg-light .card .text-muted {
                font-size: 0.8rem !important;
                font-weight: 500 !important;
                text-transform: uppercase !important;
                letter-spacing: 0.5px !important;
        }

        /* MAIN TABLE CARD */
        .row-cards > .col-12 > .card {
                border: none !important;
                border-radius: 12px !important;
                box-shadow: 0 4px 12px rgba(0,0,0,0.08), 0 2px 4px rgba(0,0,0,0.04) !important;
                overflow: hidden !important;
                background: #fff !important;
        }

        /* HEADER SECTION */
        .card-body.border-bottom {
                padding: 1rem 1.25rem !important;
                background: linear-gradient(180deg, #ffffff 0%, #f8fafb 100%) !important;
                border-bottom: 1px solid #e5e7eb !important;
        }

        .card-body.border-bottom .form-select {
                padding: 0.5rem 0.75rem !important;
                font-size: 0.8rem !important;
                border: 1.5px solid #d1d5db !important;
                border-radius: 8px !important;
                transition: all 0.2s ease !important;
        }

        .card-body.border-bottom .form-select:focus {
                border-color: #3b82f6 !important;
                box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1) !important;
        }

        .card-body.border-bottom .btn {
                padding: 0.5rem 1rem !important;
                font-size: 0.8rem !important;
                font-weight: 600 !important;
                border-radius: 8px !important;
                transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
                border: none !important;
        }

        .card-body.border-bottom .btn:hover {
                transform: translateY(-2px) !important;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15) !important;
        }

        .card-body.border-bottom .btn-info {
                background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%) !important;
        }

        .card-body.border-bottom .btn-success {
                background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
        }

        .card-body.border-bottom .btn-warning {
                background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%) !important;
        }

        .card-body.border-bottom .btn-outline-secondary {
                border: 1.5px solid #6b7280 !important;
                color: #6b7280 !important;
                background: white !important;
        }

        .card-body.border-bottom .btn-outline-secondary:hover {
                background: #6b7280 !important;
                color: white !important;
        }

        /* PAGINATION FOOTER */
        .card-footer {
                background: linear-gradient(180deg, #f8fafb 0%, #f1f5f9 100%) !important;
                border-top: 1px solid #e5e7eb !important;
                padding: 1rem 1.25rem !important;
        }

        .card-footer .pagination {
                margin: 0 !important;
        }

        .card-footer .pagination .page-link {
                border-radius: 6px !important;
                margin: 0 0.15rem !important;
                border: 1px solid #cbd5e1 !important;
                color: #475569 !important;
                font-weight: 500 !important;
                transition: all 0.2s ease !important;
        }

        .card-footer .pagination .page-link:hover {
                background: #3b82f6 !important;
                color: white !important;
                border-color: #3b82f6 !important;
                transform: translateY(-1px) !important;
        }

        .card-footer .pagination .page-item.active .page-link {
                background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%) !important;
                border-color: #3b82f6 !important;
                box-shadow: 0 2px 4px rgba(59, 130, 246, 0.3) !important;
        }

        /* CURRENCY INLINE */
        .currency-inline {
                display: inline-flex;
                align-items: baseline;
                white-space: nowrap;
                font-weight: 600 !important;
                color: #059669 !important;
        }

        /* TEXT STYLING */
        .fw-500 {
                font-weight: 500 !important;
        }

        .fw-600 {
                font-weight: 600 !important;
        }

        .text-sm {
                font-size: 0.75rem !important;
        }

        /* TABLE CONTAINER */
        .table-responsive {
                overflow-x: hidden !important;
                overflow-y: auto !important;
                max-height: calc(100vh - 320px);
        }

        /* TABLE STRUCTURE */
        .inventory-table {
                width: 100% !important;
                table-layout: fixed !important;
                border-collapse: collapse !important;
        }

        /* TABLE HEADERS */
        .inventory-table thead th {
                padding: 0.75rem 0.5rem !important;
                font-size: 0.7rem !important;
                font-weight: 700 !important;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%) !important;
                border-bottom: 2px solid #cbd5e1 !important;
                color: #334155 !important;
                white-space: normal !important;
                word-wrap: break-word !important;
                line-height: 1.3;
                position: sticky;
                top: 0;
                z-index: 10;
                vertical-align: middle !important;
                box-shadow: 0 2px 4px rgba(0,0,0,0.04) !important;
        }

        /* TABLE BODY CELLS */
        .inventory-table tbody td {
                padding: 0.75rem 0.5rem !important;
                font-size: 0.75rem !important;
                line-height: 1.4;
                border-bottom: 1px solid #f1f5f9 !important;
                vertical-align: middle !important;
                color: #1e293b !important;
        }

        /* TEXT ELLIPSIS FOR LONG CONTENT */
        .inventory-table tbody td:nth-child(1),
        .inventory-table tbody td:nth-child(2),
        .inventory-table tbody td:nth-child(6),
        .inventory-table tbody td:nth-child(10) {
                max-width: 0 !important;
                overflow: hidden !important;
                text-overflow: ellipsis !important;
                white-space: nowrap !important;
        }

        /* Keep other columns wrapping */
        .inventory-table tbody td:not(:nth-child(1)):not(:nth-child(2)):not(:nth-child(6)):not(:nth-child(10)) {
                white-space: normal !important;
                word-wrap: break-word !important;
        }

        /* TABLE ROW STYLING */
        .inventory-table tbody tr {
                transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .inventory-table tbody tr:nth-child(even) {
                background: #f8fafc;
        }

        .inventory-table tbody tr:hover {
                background: linear-gradient(90deg, #eff6ff 0%, #dbeafe 100%) !important;
                box-shadow: inset 0 0 0 1px #93c5fd, 0 2px 4px rgba(59, 130, 246, 0.08);
                transform: scale(1.001);
        }

        /* DATE BADGE STYLING */
        .date-badge {
                display: inline-block;
                padding: 0.4rem 0.75rem !important;
                font-size: 0.7rem !important;
                font-weight: 600 !important;
                border-radius: 8px !important;
                background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%) !important;
                color: white !important;
                box-shadow: 0 2px 4px rgba(14, 165, 233, 0.2) !important;
                letter-spacing: 0.3px !important;
        }

        /* CONDITION BADGES */
        .badge.bg-light {
                background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%) !important;
                color: #334155 !important;
                padding: 0.4rem 0.75rem !important;
                font-weight: 600 !important;
                border-radius: 8px !important;
                font-size: 0.7rem !important;
                border: 1px solid #cbd5e1 !important;
        }

        .badge[style*="background: green"],
        .badge[class*="IN GOOD CONDITION"] {
                background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
                color: white !important;
                padding: 0.4rem 0.75rem !important;
                font-weight: 600 !important;
                border-radius: 8px !important;
                font-size: 0.7rem !important;
                box-shadow: 0 2px 4px rgba(16, 185, 129, 0.2) !important;
                border: none !important;
        }

        /* REMARKS/STATUS BADGES */
        .badge.bg-success {
                background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
                color: white !important;
                padding: 0.45rem 0.85rem !important;
                font-weight: 600 !important;
                border-radius: 8px !important;
                font-size: 0.7rem !important;
                box-shadow: 0 2px 4px rgba(16, 185, 129, 0.25) !important;
                border: none !important;
                letter-spacing: 0.3px !important;
        }

        .badge.bg-warning {
                background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%) !important;
                color: white !important;
                padding: 0.45rem 0.85rem !important;
                font-weight: 600 !important;
                border-radius: 8px !important;
                font-size: 0.7rem !important;
                box-shadow: 0 2px 4px rgba(245, 158, 11, 0.25) !important;
                border: none !important;
                letter-spacing: 0.3px !important;
        }

        .badge.bg-danger {
                background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%) !important;
                color: white !important;
                padding: 0.45rem 0.85rem !important;
                font-weight: 600 !important;
                border-radius: 8px !important;
                font-size: 0.7rem !important;
                box-shadow: 0 2px 4px rgba(239, 68, 68, 0.25) !important;
                border: none !important;
                letter-spacing: 0.3px !important;
        }

        .badge.bg-secondary {
                background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%) !important;
                color: white !important;
                padding: 0.45rem 0.85rem !important;
                font-weight: 600 !important;
                border-radius: 8px !important;
                font-size: 0.7rem !important;
                box-shadow: 0 2px 4px rgba(107, 114, 128, 0.25) !important;
                border: none !important;
                letter-spacing: 0.3px !important;
        }

        /* COLUMN WIDTHS - ALL 13 COLUMNS VISIBLE */
        .inventory-table th:nth-child(1), .inventory-table td:nth-child(1) { width: 6.5% !important; }
        .inventory-table th:nth-child(2), .inventory-table td:nth-child(2) { width: 6.5% !important; }
        .inventory-table th:nth-child(3), .inventory-table td:nth-child(3) { width: 7.5% !important; }
        .inventory-table th:nth-child(4), .inventory-table td:nth-child(4) { width: 6.5% !important; }
        .inventory-table th:nth-child(5), .inventory-table td:nth-child(5) { width: 6.5% !important; }
        .inventory-table th:nth-child(6), .inventory-table td:nth-child(6) { width: 9% !important; }
        .inventory-table th:nth-child(7), .inventory-table td:nth-child(7) { width: 6.5% !important; }
        .inventory-table th:nth-child(8), .inventory-table td:nth-child(8) { width: 6% !important; }
        .inventory-table th:nth-child(9), .inventory-table td:nth-child(9) { width: 6% !important; }
        .inventory-table th:nth-child(10), .inventory-table td:nth-child(10) { width: 10% !important; }
        .inventory-table th:nth-child(11), .inventory-table td:nth-child(11) { width: 11% !important; }
        .inventory-table th:nth-child(12), .inventory-table td:nth-child(12) { width: 10% !important; }
        .inventory-table th:nth-child(13), .inventory-table td:nth-child(13) { width: 8% !important; }

        /* ACTION BUTTONS IN TABLE */
        .btn-action-edit, .btn-action-delete {
                padding: 0.35rem 0.6rem !important;
                font-size: 0.7rem !important;
                border: none !important;
                border-radius: 6px !important;
                transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
                font-weight: 600 !important;
                box-shadow: 0 1px 3px rgba(0,0,0,0.1) !important;
        }

        .btn-action-edit {
                background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%) !important;
                color: white !important;
        }

        .btn-action-edit:hover {
                background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%) !important;
                transform: translateY(-2px) !important;
                box-shadow: 0 4px 8px rgba(59, 130, 246, 0.3) !important;
        }

        .btn-action-delete {
                background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%) !important;
                color: white !important;
        }

        .btn-action-delete:hover {
                background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%) !important;
                transform: translateY(-2px) !important;
                box-shadow: 0 4px 8px rgba(239, 68, 68, 0.3) !important;
        }

        .btn-group {
                gap: 0.35rem;
                display: flex;
        }
                color: white !important;
                transform: translateY(-1px);
        }

        .btn-group {
                gap: 0.25rem !important;
                display: flex !important;
        }

        /* BADGES */
        .badge {
                padding: 0.3rem 0.5rem !important;
                font-size: 0.65rem !important;
                font-weight: 600 !important;
                border-radius: 999px !important;
        }

        /* FOOTER */
        .card-footer {
                padding: 0.75rem 1rem !important;
                font-size: 0.8rem !important;
                background: #f8f9fa !important;
                border-top: 1px solid #e9ecef !important;
        }

        /* TEXT UTILITIES */
        .text-success { color: #10b981 !important; font-weight: 600; }
        .fw-500 { font-weight: 500; }
        .fw-600 { font-weight: 600; }
</style>
@endpush

@push('scripts')
<script>
  window.addEventListener('show-edit-property-modal', function() {
    const modalEl = document.getElementById('edit_property');
    if (modalEl && typeof bootstrap !== 'undefined') {
      const modal = new bootstrap.Modal(modalEl);
      modal.show();
    }
  });

  window.addEventListener('hide-edit-property-modal', function() {
    const modalEl = document.getElementById('edit_property');
    if (modalEl) {
      const modal = bootstrap.Modal.getInstance(modalEl);
      if (modal) modal.hide();
    }
  });

  document.addEventListener('livewire:load', function() {
    // Tooltip initialization for action buttons
    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(function(el) {
      if (typeof bootstrap !== 'undefined') {
        new bootstrap.Tooltip(el, {
          html: true,
          delay: { show: 200, hide: 100 }
        });
      }
    });

    // Add loading state to action buttons
    document.addEventListener('click', function(e) {
      const editBtn = e.target.closest('.btn-action-edit');
      const deleteBtn = e.target.closest('.btn-action-delete');
      
      if (editBtn || deleteBtn) {
        const btn = editBtn || deleteBtn;
        const icon = btn.querySelector('i');
        const originalHTML = btn.innerHTML;
        
        // Show loading state
        btn.disabled = true;
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i>';
        
        // Restore after Livewire processes
        setTimeout(() => {
          if (btn && btn.parentElement) {
            btn.disabled = false;
            btn.innerHTML = originalHTML;
          }
        }, 200);
      }
    });

    // Add loading state to filter and sort buttons
    const filterBtn = document.querySelector('[wire\\:click="openFilterModal"]');
    const resetBtn = document.querySelector('[wire\\:click="resetToFirstPage"]');
    
    if (filterBtn) {
      filterBtn.addEventListener('click', function() {
        addButtonLoading(this);
      });
    }
    
    if (resetBtn) {
      resetBtn.addEventListener('click', function() {
        addButtonLoading(this);
      });
    }

    // Sort button loading states
    document.querySelectorAll('th[wire\\:click*="sortBy"]').forEach(th => {
      th.addEventListener('click', function() {
        const icon = this.querySelector('i');
        if (icon) {
          icon.classList.add('fa-spin');
          setTimeout(() => {
            if (icon) icon.classList.remove('fa-spin');
          }, 300);
        }
      });
    });
  });

  // Add loading indicator to button
  function addButtonLoading(btn) {
    const originalHTML = btn.innerHTML;
    btn.disabled = true;
    btn.style.opacity = '0.7';
    
    setTimeout(() => {
      if (btn && btn.parentElement) {
        btn.disabled = false;
        btn.style.opacity = '';
        btn.innerHTML = originalHTML;
      }
    }, 200);
  }

  // Currency formatting
  document.addEventListener('DOMContentLoaded', function() {
    const editInput = document.getElementById('editUnitValueDisplay');
    const editHidden = document.getElementById('editUnitValueHidden');
    const editClearBtn = editInput?.closest('.input-group')?.querySelector('.currency-clear');

    if (editInput && editHidden) {
      if (editHidden.value) {
        const val = parseFloat(editHidden.value);
        if (!isNaN(val)) {
          editInput.value = val.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2});
        }
      }

      editInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/,/g, '');
        if (value === '' || value === '.') {
          editHidden.value = '';
          return;
        }
        const num = parseFloat(value);
        if (!isNaN(num)) {
          editHidden.value = num;
          e.target.value = num.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2});
        }
      });

      if (editClearBtn) {
        editClearBtn.addEventListener('click', function() {
          editInput.value = '';
          editHidden.value = '';
          editInput.focus();
        });
      }
    }
  });

  // Livewire hooks for better UX
  document.addEventListener('livewire:load', () => {
    if (!window.Livewire?.hook) return;
    Livewire.hook('message.processed', () => {
      // Re-initialize tooltips after Livewire updates
      if (typeof bootstrap !== 'undefined') {
        document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(function(el) {
          const tooltip = bootstrap.Tooltip.getInstance(el);
          if (!tooltip) {
            new bootstrap.Tooltip(el);
          }
        });
      }
    });
  });
</script>
@endpush

<!-- ARTICLE MANAGEMENT MODAL -->
<div wire:ignore.self class="modal modal-blur fade" id="article_modal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- Nav Tabs -->
            <div class="modal-header border-bottom">
                <ul class="nav nav-tabs w-100" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="add_article_tab" data-bs-toggle="tab" data-bs-target="#add_article_content" type="button" role="tab" aria-controls="add_article_content" aria-selected="true">
                            <i class="fa-solid fa-plus me-2"></i>Add Article
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="add_description_tab" data-bs-toggle="tab" data-bs-target="#add_description_content" type="button" role="tab" aria-controls="add_description_content" aria-selected="false">
                            <i class="fa-solid fa-align-left me-2"></i>Add Description
                        </button>
                    </li>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Tab Content -->
            <div class="modal-body">
                <div class="tab-content">
                    <!-- Add Article Tab -->
                    <div class="tab-pane fade show active" id="add_article_content" role="tabpanel">
                        <form wire:submit.prevent="addNewArticle" class="mt-3">
                            <div class="mb-3">
                                <label class="form-label fw-600">Article Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('new_article_name') is-invalid @enderror" 
                                       placeholder="Enter article name" wire:model.defer="new_article_name" autofocus>
                                @error('new_article_name')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-flex gap-2 justify-content-end">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                                    <span wire:loading.remove>Add Article</span>
                                    <span wire:loading><i class="spinner-border spinner-border-sm me-2"></i>Processing...</span>
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Add Description Tab -->
                    <div class="tab-pane fade" id="add_description_content" role="tabpanel">
                        <form wire:submit.prevent="addNewArticleDescription" class="mt-3">
                            <div class="mb-3">
                                <label class="form-label fw-600">Article Name <span class="text-danger">*</span></label>
                                <select class="form-select @error('new_article_id') is-invalid @enderror" wire:model.defer="new_article_id">
                                    <option value="">--- Choose Article Name ---</option>
                                    @forelse ($articles as $article)
                                        <option value="{{ $article->id }}">{{ $article->article_name }}</option>
                                    @empty
                                        <option disabled>No articles available</option>
                                    @endforelse
                                </select>
                                @error('new_article_id')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-600">Article Description <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('new_article_description') is-invalid @enderror" 
                                       placeholder="Enter article description" wire:model.defer="new_article_description">
                                @error('new_article_description')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex gap-2 justify-content-end">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                                    <span wire:loading.remove>Add Description</span>
                                    <span wire:loading><i class="spinner-border spinner-border-sm me-2"></i>Processing...</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>