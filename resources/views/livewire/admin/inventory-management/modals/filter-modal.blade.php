<!-- Filters Modal -->
<div wire:ignore.self class="modal fade ims-filter-modal" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header ims-filter-header">
                <div class="ims-filter-heading">
                    <h5 class="modal-title ims-filter-title" id="filterModalLabel">Filter Inventory</h5>
                    <p class="ims-filter-subtitle">Refine IMS records by office, officer, description, remarks, date acquired, and value classification.</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body ims-filter-body">
                <section class="ims-filter-section">
                    <div class="ims-filter-section-head">
                        <h6 class="ims-filter-section-title">Filter Options</h6>
                        <p class="ims-filter-section-subtitle">Apply any combination below, then click Apply Filters.</p>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label ims-filter-label">Office</label>
                            <select class="form-select ims-filter-control" wire:model="modalOffice">
                                <option value="">All Offices</option>
                                @forelse($OfficeLists as $off)
                                    <option value="{{ $off->id }}">{{ $off->office }}</option>
                                @empty
                                    <option value="" disabled>No offices available</option>
                                @endforelse
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label ims-filter-label">Accountable Officer</label>
                            <div class="position-relative js-ims-officer-picker">
                                <div class="input-group">
                                    <input
                                        type="text"
                                        class="form-control ims-filter-control"
                                        aria-label="Accountable Officer"
                                        wire:model.debounce.300ms="modalOfficer"
                                        wire:focus="$set('showModalDropdown', true)"
                                        wire:keydown.escape="$set('showModalDropdown', false)"
                                        placeholder="Type officer name..."
                                        autocomplete="off"
                                    >
                                    <button class="btn btn-outline-secondary ims-filter-clear-btn" type="button" title="Clear officer" wire:click="clearModalOfficerSearch">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                </div>

                                @if($showModalDropdown && ! $this->modalOfficerExactMatch)
                                    <div class="dropdown-menu show w-100 ims-filter-officer-dropdown">
                                        @forelse($this->modalOfficerOptions as $emp)
                                            <a href="#" class="dropdown-item" wire:mousedown.prevent="selectModalOfficer({{ $emp->id }})">
                                                {{ trim(collect([$emp->firstname, $emp->middlename, $emp->lastname])->filter()->implode(' ')) }}
                                            </a>
                                        @empty
                                            <span class="dropdown-item text-muted">No officers found</span>
                                        @endforelse
                                    </div>
                                @endif
                            </div>
                            <div class="ims-filter-helper">Pick from the list for exact officer filtering.</div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label ims-filter-label">Description</label>
                            <select class="form-select ims-filter-control" wire:model.defer="modalDescription">
                                <option value="">All Descriptions</option>
                                @forelse($descriptionFilterOptions as $descOption)
                                    <option value="{{ $descOption->id }}">
                                        {{ $descOption->ArticleName->article_name ?? 'N/A' }} - {{ $descOption->article_description }}
                                    </option>
                                @empty
                                    <option value="" disabled>No descriptions available</option>
                                @endforelse
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label ims-filter-label">Remarks</label>
                            <select class="form-select ims-filter-control" wire:model.defer="modalRemarks">
                                <option value="">All Remarks</option>
                                @forelse ($RemarksList as $remark)
                                    <option value="{{ $remark->remark_name }}">{{ $remark->remark_name }}</option>
                                @empty
                                    <option value="" disabled>No remarks available</option>
                                @endforelse
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label ims-filter-label">Date Acquired</label>
                            <input type="date" id="dateFromInput" class="form-control ims-filter-control" wire:model.lazy="modalDateFrom">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label ims-filter-label">Unit Value Range</label>
                            <select class="form-select ims-filter-control" wire:model.defer="modalUnitValueRange">
                                <option value="">All Unit Values</option>
                                <option value="below_50k">SEMI-EXPENDABLE - BELOW 50K</option>
                                <option value="ppe_50k_and_above">PPE (PLANTS AND EQUIPMENTS) - 50K AND ABOVE</option>
                            </select>
                        </div>
                    </div>
                </section>
            </div>

            <div class="modal-footer ims-filter-footer">
                <button type="button" class="btn btn-outline-secondary ims-btn-tertiary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-link ims-filter-clear-link" wire:click="clearFilters" wire:loading.attr="disabled" wire:target="clearFilters">Clear Filters</button>
                <button type="button" class="btn btn-primary ims-btn-secondary" wire:click="applyFilters" wire:loading.attr="disabled" wire:target="applyFilters">
                    <span wire:loading.remove wire:target="applyFilters">Apply Filters</span>
                    <span wire:loading wire:target="applyFilters"><i class="spinner-border spinner-border-sm me-1"></i>Applying...</span>
                </button>
            </div>
        </div>
    </div>
</div>
