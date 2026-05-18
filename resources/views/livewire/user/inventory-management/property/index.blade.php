<div class="ims-form-shell ims-create-property-form-shell">
    <form id="imsCreatePropertyForm" class="ims-create-property-form" wire:submit.prevent="{{ $isEditing ? 'updateProperty' : 'createProperty' }}">
        <div class="ims-create-property-card">
            <div class="ims-form-panel">
                <div class="ims-form-panel-head">
                    <div>
                        <h3 class="ims-create-property-title">Assignment</h3>
                        <p class="ims-form-panel-subtitle">Capture assignment details first so the correct officer and office pair stay aligned.</p>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-lg-6">
                        <label class="form-label">Office <span class="text-danger">*</span></label>
                        <select class="form-select" wire:model="SelectedOffice">
                            <option value="">--- Choose Office ---</option>
                            @forelse ($OfficeLists as $Office)
                                <option value="{{ $Office->id }}">{{ $Office->office }}</option>
                            @empty
                                <option value="" disabled>No offices available</option>
                            @endforelse
                        </select>
                        @error('SelectedOffice')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-lg-6">
                        <label class="form-label">Accountable Officer <span class="text-danger">*</span></label>
                        <div class="position-relative">
                            <div class="input-group">
                                <input
                                    type="text"
                                    class="form-control"
                                    wire:model.debounce.200ms="officerSearch"
                                    wire:focus="openOfficerDropdown"
                                    wire:keydown.escape="hideOfficerDropdown"
                                    placeholder="{{ $SelectedOffice ? 'Type officer name...' : 'Select office first' }}"
                                    autocomplete="off"
                                    @if(! $SelectedOffice) disabled @endif
                                >
                                <button class="btn btn-outline-secondary" type="button" title="Clear officer" wire:click="clearOfficerSearch" wire:loading.attr="disabled">&times;</button>
                            </div>

                            @if($showOfficerDropdown)
                                <div class="dropdown-menu show w-100 ims-officer-dropdown">
                                    @forelse($officerOptions as $emp)
                                        <button type="button" class="dropdown-item" wire:mousedown.prevent="selectOfficer({{ $emp->id }})">
                                            {{ trim(collect([$emp->firstname, $emp->middlename, $emp->lastname])->filter()->implode(' ')) }}
                                        </button>
                                    @empty
                                        <span class="dropdown-item text-muted">No officers found</span>
                                    @endforelse
                                </div>
                            @endif
                        </div>
                        <div class="form-text ims-helper-text">
                            @if($SelectedOffice)
                                Search and select one officer from the selected office.
                            @else
                                Choose an office first to load available officers.
                            @endif
                        </div>
                        @error('selectedEmployee')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-lg-6">
                        <label class="form-label">Date Acquired <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" wire:model="date_acquired">
                        @error('date_acquired')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-lg-6">
                        <label class="form-label">Property No.</label>
                        <input type="text" class="form-control" placeholder="Enter Property Number" wire:model.defer="propertynumber">
                        <div class="form-text ims-helper-text">Optional. Leave blank if not available.</div>
                        @error('propertynumber')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="ims-form-panel">
                <div class="ims-form-panel-head">
                    <div>
                        <h6 class="ims-form-panel-title">Asset Details</h6>
                        <p class="ims-form-panel-subtitle">Pick the article and description, then complete the value and specification details.</p>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-lg-6">
                        <label class="form-label">Article / Item <span class="text-danger">*</span></label>
                        <select class="form-select" wire:model="selectedArticle">
                            <option value="">--- Choose Article ---</option>
                            @forelse ($articleids as $Article)
                                <option value="{{ $Article->id }}">{{ $Article->article_name }}</option>
                            @empty
                                <option value="" disabled>No articles available</option>
                            @endforelse
                        </select>
                        @error('selectedArticle')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-lg-6">
                        <label class="form-label">Description <span class="text-danger">*</span></label>
                        <select class="form-select" wire:model="selectedArticleDescription">
                            <option value="">--- Choose Description ---</option>
                            @if($selectedArticle)
                                @forelse ($articledesciptions as $Description)
                                    <option value="{{ $Description->id }}">{{ $Description->article_description }}</option>
                                @empty
                                    <option value="" disabled>No descriptions found for this article</option>
                                @endforelse
                            @endif
                        </select>
                        @error('selectedArticleDescription')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">Specification <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter Specification" wire:model.defer="specification">
                        @error('specification')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-lg-6">
                        <label class="form-label">Unit of Measurement</label>
                        <input type="text" class="form-control" placeholder="Enter Unit of Measurement" wire:model.defer="unitofmeasurement">
                        @error('unitofmeasurement')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    @php
                        $unitValueAmount = is_numeric($unitvalue) ? (float) $unitvalue : null;
                        $unitValueThreshold = is_null($unitValueAmount) ? 'empty' : ($unitValueAmount >= 50000 ? 'ppe' : 'semi');
                    @endphp
                    <div class="col-lg-6">
                        <label class="form-label">Unit Value <span class="text-danger">*</span></label>
                        <div class="ims-currency-field">
                            <div class="input-group ims-currency-input-group @error('unitvalue') is-invalid @enderror">
                                <span class="input-group-text">&#8369;</span>
                                <input type="text" inputmode="decimal" class="form-control text-end" id="createUnitValueDisplay" placeholder="0.00" autocomplete="off" spellcheck="false">
                                <button class="btn ims-currency-clear" id="createUnitValueClear" type="button" title="Clear unit value" aria-label="Clear unit value">&times;</button>
                            </div>
                            <input type="hidden" id="createUnitValueHidden" wire:model.defer="unitvalue">
                            <div class="ims-currency-meta">
                                <span class="form-text ims-helper-text mb-0">Numbers only. This amount decides whether IMS uses the Semi-ex or PPE UACS mapping.</span>
                                @if($unitValueThreshold === 'ppe')
                                    <span class="ims-unit-value-chip is-ppe">PPE (50,000 and above)</span>
                                @elseif($unitValueThreshold === 'semi')
                                    <span class="ims-unit-value-chip is-semi">Semi-ex (below 50,000)</span>
                                @else
                                    <span class="ims-unit-value-chip is-neutral">Waiting for amount</span>
                                @endif
                            </div>
                        </div>
                        @error('unitvalue')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="ims-form-panel">
                <div class="ims-form-panel-head">
                    <div>
                        <h6 class="ims-form-panel-title">Classification and Remarks</h6>
                        <p class="ims-form-panel-subtitle">Review UACS suggestions and add remarks before saving the IMS record.</p>
                    </div>
                </div>

                <div class="row g-3 ims-classification-grid">
                    <div class="col-lg-4">
                        <label class="form-label d-flex align-items-center gap-2">UACS <span class="ims-field-chip">Auto</span></label>
                        <input type="text" class="form-control ims-readonly-field" wire:model="uacs" placeholder="No matching UACS for the current threshold" readonly>
                        @error('uacs')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-4">
                        <label class="form-label">Fund Cluster</label>
                        <input type="text" class="form-control" placeholder="Enter Fund Cluster" wire:model.defer="fundCluster">
                        @error('fundCluster')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-4">
                        <label class="form-label">Estimated Useful Life</label>
                        <input type="text" class="form-control" placeholder="Enter Estimated Useful Life" wire:model.defer="estimatedUsefulLife">
                        @error('estimatedUsefulLife')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12">
                        <div class="ims-inline-helper-card">Auto-filled from the selected article and unit value inside IMS.</div>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Remarks <span class="text-danger">*</span></label>
                        @if(! $useCustomRemarks)
                            <select class="form-select" wire:model="remarksSelection">
                                <option value="">--- Choose Remarks ---</option>
                                @forelse ($RemarksList as $Remark)
                                    <option value="{{ $Remark->remark_name }}">{{ $Remark->remark_name }}</option>
                                @empty
                                    <option value="" disabled>No remarks available</option>
                                @endforelse
                                <option value="OTHERS">Others (Specify)</option>
                            </select>
                        @else
                            <div class="position-relative ims-remarks-custom">
                                <input type="text" class="form-control pe-5" wire:model.defer="remarks" placeholder="Type custom remarks...">
                                <button type="button" class="btn btn-sm position-absolute top-50 translate-middle-y end-0 me-1" wire:click="useRemarksList">Change</button>
                            </div>
                        @endif
                        @error('remarksSelection')
                            <span class="text-danger d-block">{{ $message }}</span>
                        @enderror
                        @error('remarks')
                            <span class="text-danger d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2 align-items-center ims-create-actions">
                <button id="createPropertySubmitBtn" type="submit" class="btn ims-create-primary" wire:loading.attr="disabled" wire:target="createProperty,updateProperty">
                    <span wire:loading.remove wire:target="createProperty,updateProperty">{{ $isEditing ? 'Update Property' : 'Create Property' }}</span>
                    <span wire:loading wire:target="createProperty,updateProperty"><span class="spinner-border spinner-border-sm me-2" role="status"></span>{{ $isEditing ? 'Updating...' : 'Creating...' }}</span>
                </button>

                @if(! $isEditing)
                    <button id="createPropertyClearBtn" type="button" class="btn ims-create-clear" wire:click="resetForm" wire:loading.attr="disabled" wire:target="resetForm,createProperty,updateProperty">Clear Form</button>
                @endif
            </div>
        </div>
    </form>
</div>
