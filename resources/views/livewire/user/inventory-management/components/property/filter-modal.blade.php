<div wire:ignore.self class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterModalLabel">Filters</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Remarks</label>
                        <select class="form-select" wire:model.defer="modalRemarks">
                            <option value="">All Remarks</option>
                            @forelse ($RemarksList as $remark)
                                <option value="{{ $remark->remark_name }}">{{ $remark->remark_name }}</option>
                            @empty
                                <option value="" disabled>No remarks available</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Office</label>
                        <select class="form-select" wire:model.defer="modalOffice">
                            <option value="">All Offices</option>
                            @forelse($OfficeLists as $off)
                                <option value="{{ $off->id }}">{{ $off->office }}</option>
                            @empty
                                <option value="" disabled>No offices available</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Date Acquired (From)</label>
                        <input type="date" class="form-control" wire:model.lazy="modalDateFrom">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Date Acquired (To)</label>
                        <input type="date" class="form-control" wire:model.lazy="modalDateTo">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Unit Value Min (₱)</label>
                        <input type="number" class="form-control" step="0.01" wire:model.lazy="modalValueMin" placeholder="₱ 0.00">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Unit Value Max (₱)</label>
                        <input type="number" class="form-control" step="0.01" wire:model.lazy="modalValueMax" placeholder="₱ 0.00">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Search</label>
                        <input type="text" class="form-control" wire:model.debounce.300ms="modalSearch" placeholder="Search by property no, remarks, or officer...">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link" wire:click="clearFilters">Clear Filters</button>
                <button type="button" class="btn btn-primary" wire:click="applyFilters" data-bs-dismiss="modal">Apply</button>
            </div>
        </div>
    </div>
</div>
