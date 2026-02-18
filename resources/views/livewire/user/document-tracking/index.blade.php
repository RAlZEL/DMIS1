<div style="margin: 0; padding: 0; overflow: hidden; width: 100%;">
    <div class="row" style="margin: 0; width: 100%;">
        <div class="col-12" style="padding: 0;">
            <div class="card" style="margin: 0; border-radius: 0; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <!-- Header Section -->
                <div class="card-body border-bottom" style="padding: 0.6rem 0.75rem !important; background: linear-gradient(180deg, #ffffff 0%, #f8f9fa 100%) !important; border-bottom: 2px solid #e9ecef !important;">
                    <div class="d-flex flex-wrap gap-3 align-items-center">
                        <!-- Left: Entries Per Page -->
                        <div class="text-muted d-flex align-items-center" style="font-size: 0.85rem;">
                            <span class="me-2 fw-500" style="font-size: 0.75rem;"><i class="fa-solid fa-list me-1"></i>Show</span>
                            <div class="mx-2 d-inline-block">
                                <select class="form-select form-select-sm" wire:model="perPage" style="min-width: 80px; padding: 0.35rem 0.5rem !important; font-size: 0.75rem !important; border: 1px solid #d1d5db !important; border-radius: 0.375rem !important;">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                            <span class="text-sm" style="font-size: 0.75rem;">entries</span>
                        </div>

                        <!-- Right: Search & Buttons -->
                        <div class="ms-auto d-flex gap-2 flex-wrap align-items-center">
                            <div class="text-muted d-flex align-items-center" style="font-size: 0.85rem;">
                                <span class="me-2" style="font-size: 0.75rem;"><i class="fa-solid fa-magnifying-glass me-1"></i>Search:</span>
                                <input type="text" class="form-control form-control-sm" placeholder="Search documents..." aria-label="Search" wire:model='Search' style="min-width: 150px; padding: 0.35rem 0.5rem !important; font-size: 0.75rem !important;">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Table Section -->
                <div class="table-responsive" style="overflow-x: auto !important; overflow-y: auto !important;">
                    <table class="table table-vcenter table-mobile-md card-table dt-table" style="width: 100% !important; table-layout: auto !important; border-collapse: collapse !important;">
                        <thead class="bg-light" style="background: linear-gradient(180deg, #f1f3f5 0%, #e9ecef 100%) !important;">
                            <tr>
                                <th class="text-center fw-bold" style="padding: 0.5rem 0.3rem !important; font-size: 0.65rem !important; text-transform: uppercase; letter-spacing: 0.3px; border-bottom: 2px solid #dee2e6 !important; color: #495057 !important; white-space: nowrap;">
                                    <span>#</span>
                                </th>
                                <th class="text-center fw-bold" style="padding: 0.5rem 0.3rem !important; font-size: 0.65rem !important; text-transform: uppercase; letter-spacing: 0.3px; border-bottom: 2px solid #dee2e6 !important; color: #495057 !important;">
                                    <span>Tracking #</span>
                                </th>
                                <th class="text-center fw-bold" style="padding: 0.5rem 0.3rem !important; font-size: 0.65rem !important; text-transform: uppercase; letter-spacing: 0.3px; border-bottom: 2px solid #dee2e6 !important; color: #495057 !important;">
                                    <span>Document Type</span>
                                </th>
                                <th class="text-center fw-bold" style="padding: 0.5rem 0.3rem !important; font-size: 0.65rem !important; text-transform: uppercase; letter-spacing: 0.3px; border-bottom: 2px solid #dee2e6 !important; color: #495057 !important;">
                                    <span>Subject</span>
                                </th>
                                <th class="text-center fw-bold" style="padding: 0.5rem 0.3rem !important; font-size: 0.65rem !important; text-transform: uppercase; letter-spacing: 0.3px; border-bottom: 2px solid #dee2e6 !important; color: #495057 !important;">
                                    <span>Originating Office</span>
                                </th>
                                <th class="text-center fw-bold" style="padding: 0.5rem 0.3rem !important; font-size: 0.65rem !important; text-transform: uppercase; letter-spacing: 0.3px; border-bottom: 2px solid #dee2e6 !important; color: #495057 !important;">
                                    <span>Sender</span>
                                </th>
                                <th class="text-center fw-bold" style="padding: 0.5rem 0.3rem !important; font-size: 0.65rem !important; text-transform: uppercase; letter-spacing: 0.3px; border-bottom: 2px solid #dee2e6 !important; color: #495057 !important;">
                                    <span>Date Received</span>
                                </th>
                                <th class="text-center fw-bold w-1" style="padding: 0.5rem 0.3rem !important; font-size: 0.65rem !important; text-transform: uppercase; letter-spacing: 0.3px; border-bottom: 2px solid #dee2e6 !important; color: #495057 !important;">
                                    <span>Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($Documents as $Index => $Document)
                            <tr style="transition: all 0.15s ease; border-bottom: 1px solid #e9ecef !important;">
                                <td class="text-center fw-500" style="padding: 0.5rem 0.3rem !important; font-size: 0.7rem !important; line-height: 1.3; color: #374151 !important;">{{ $Index + 1 }}</td>
                                <td class="text-center fw-500" style="padding: 0.5rem 0.3rem !important; font-size: 0.7rem !important; line-height: 1.3; color: #374151 !important;">{{ $Document->PDN }}</td>
                                <td class="text-center" style="padding: 0.5rem 0.3rem !important; font-size: 0.7rem !important; line-height: 1.3; color: #374151 !important;">{{ $Document->doc_type }}</td>
                                <td class="text-center" style="padding: 0.5rem 0.3rem !important; font-size: 0.7rem !important; line-height: 1.3; color: #374151 !important;">
                                    <span>{{ $Document->subject }}</span>
                                    @if ($Document->is_urgent == true)
                                        <span class="badge bg-danger ms-1" style="font-size: 0.6rem; padding: 0.25rem 0.4rem;">Urgent</span>
                                    @endif
                                    @if ($Document->is_paperless == true)
                                        <span class="badge bg-success ms-1" style="font-size: 0.6rem; padding: 0.25rem 0.4rem;">Paperless</span>
                                    @endif
                                </td>
                                <td class="text-center" style="padding: 0.5rem 0.3rem !important; font-size: 0.7rem !important; line-height: 1.3; color: #374151 !important;">{{ $Document->originatingoffice }}</td>
                                <td class="text-center" style="padding: 0.5rem 0.3rem !important; font-size: 0.7rem !important; line-height: 1.3; color: #374151 !important;">{{ $Document->sendername }}</td>
                                <td class="text-center" style="padding: 0.5rem 0.3rem !important; font-size: 0.7rem !important; line-height: 1.3; color: #374151 !important;">
                                    @if ($Document->datereceived)
                                        <span class="badge bg-light text-dark" style="font-size: 0.65rem; font-weight: 700; padding: 0.35rem 0.5rem;">{{ \Carbon\Carbon::parse($Document->datereceived)->format('M d, Y') }}</span>
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td class="text-center" style="padding: 0.5rem 0.3rem !important;">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="user/document-tracking/view/{{ $Document->id }}" class="btn btn-sm btn-outline-primary" title="View document" style="padding: 0.25rem 0.5rem; font-size: 0.7rem; border-radius: 0.25rem;">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-4" style="color: #999;">
                                    <div style="padding: 20px;">
                                        <i class="fa-solid fa-inbox fa-2x mb-2 opacity-50 d-block"></i>
                                        <span class="fw-500" style="font-size: 0.85rem;">No documents found</span>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Footer -->
                <div class="card-footer px-4 py-3 bg-light">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="text-muted text-sm">
                            <i class="fa-solid fa-list me-2"></i>
                            @if($Documents->total() > 0)
                                Showing <strong>{{ number_format($Documents->firstItem()) }}</strong> – <strong>{{ number_format($Documents->lastItem()) }}</strong> of <strong>{{ number_format($Documents->total()) }}</strong> documents
                            @else
                                No documents to display
                            @endif
                        </div>
                        <div class="ms-auto">
                            {{ $Documents->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* TABLE STYLING - Same as Inventory Management */
    .dt-table {
        width: 100% !important;
        table-layout: fixed !important;
        border-collapse: collapse !important;
    }

    .dt-table tbody tr {
        transition: all 0.15s ease;
        background: #fff;
    }

    .dt-table tbody tr:nth-child(even) {
        background: #f9fafb;
    }

    .dt-table tbody tr:hover {
        background: #eff6ff !important;
        box-shadow: inset 0 0 0 1px #bfdbfe;
    }

    /* Badge styling */
    .badge {
        font-weight: 600;
        border-radius: 0.25rem;
        display: inline-block;
    }

    /* Button styling */
    .btn-group-sm .btn {
        transition: all 0.2s ease;
        border-radius: 0.25rem;
    }

    .btn-group-sm .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 6px rgba(0,0,0,0.15);
    }

    /* Form controls */
    .form-control-sm, .form-select-sm {
        transition: all 0.2s ease;
        border-color: #d1d5db;
    }

    .form-control-sm:focus, .form-select-sm:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
</style>
@endpush

