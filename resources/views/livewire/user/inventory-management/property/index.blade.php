<div>
    <form action="" method="POST" wire:submit.prevent='{{ $isEditing ? "updateProperty" : "createProperty" }}()'>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">{{ $isEditing ? 'Edit' : 'Create' }} Property Information</h3>
                                      
                    <div class="row g-3">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Office <span class="text-danger">*</span></label>
                                <select class="form-select" wire:model="SelectedOffice">
                                    <option value="">--- Choose Office ---</option>
                                    @forelse ($OfficeLists as $Office)
                                        <option value="{{ $Office->id }}">{{ $Office->office}}</option>
                                    @empty
                                        <option value="" disabled>No offices available</option>
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

                    <div class="row g-3">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Accountable Officer <span class="text-danger">*</span></label>
                                <div class="position-relative">
                                    <div class="input-group">
                                        <input type="text" class="form-control" wire:model.debounce.300ms="officerSearch" wire:focus="$set('showOfficerDropdown', true)" placeholder="Type officer name..." autocomplete="off">
                                        <button class="btn btn-outline-secondary" type="button" title="Clear officer" wire:click="$set('officerSearch','')">
                                            &times;
                                        </button>
                                    </div>
                                    @php
                                        $searchLower = strtolower(trim($officerSearch));
                                        // Get all employees
                                        $allEmployees = \App\Models\Admin\EMS\Employee::where('empstatus', '=', 'PERMANENT')
                                            ->where('is_retired', false)
                                            ->orderby('firstname', 'asc')
                                            ->get();
                                        
                                        $exactMatch = $allEmployees->contains(function($emp) use ($searchLower) {
                                            $fullName = strtolower(trim($emp->firstname . ' ' . $emp->middlename . ' ' . $emp->lastname));
                                            return $fullName === $searchLower;
                                        });
                                    @endphp
                                    @if($showOfficerDropdown && !$exactMatch)
                                        <div class="dropdown-menu show w-100" style="max-height: 220px; overflow-y: auto; z-index:1056;">
                                            @php
                                                if ($searchLower) {
                                                    $filtered = $allEmployees->filter(function($emp) use ($searchLower) {
                                                        $fullName = strtolower($emp->firstname . ' ' . $emp->middlename . ' ' . $emp->lastname);
                                                        return str_contains($fullName, $searchLower);
                                                    });
                                                } else {
                                                    $filtered = $allEmployees;
                                                }
                                            @endphp
                                            @forelse($filtered as $emp)
                                                <a href="#" class="dropdown-item" wire:click.prevent="selectOfficer({{ $emp->id }}, '{{ $emp->firstname }} {{ $emp->middlename }} {{ $emp->lastname }}')">
                                                    {{ $emp->firstname }} {{ $emp->middlename }} {{ $emp->lastname }}
                                                </a>
                                            @empty
                                                <span class="dropdown-item text-muted">No officers found</span>
                                            @endforelse
                                        </div>
                                    @endif
                                </div>
                                <span class="text-danger"> 
                                    @error('selectedEmployee')
                                    {{ $message }}   
                                    @enderror
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Date Acquired <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" wire:model="date_acquired">
                                <span class="text-danger"> 
                                    @error('date_acquired')
                                    {{ $message }}   
                                @enderror
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Property No.</label>
                                <input type="text" class="form-control" placeholder="Enter Property Number" wire:model.defer="propertynumber"> 
                                <span class="text-danger"> 
                                    @error('propertynumber')
                                    {{ $message }}   
                                    @enderror
                                </span>                                                       
                            </div>                   
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Article / Item <span class="text-danger">*</span></label>
                                <select class="form-select" wire:model="selectedArticle">
                                    <option value="">--- Choose Article ---</option>
                                    @forelse ($articleids as $Article)
                                        <option value="{{ $Article->id }}">{{ $Article->article_name}}</option>
                                    @empty
                                        <option value="" disabled>No articles available</option>
                                    @endforelse          
                                </select>
                                <span class="text-danger"> 
                                    @error('selectedArticle')
                                        {{ $message }}   
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
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
                                <span class="text-danger"> 
                                    @error('selectedArticleDescription')
                                    {{ $message }}   
                                    @enderror
                                </span>
                            </div>
                        </div>
                    </div>

                   
                    <div class="row g-3">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Specification <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="Enter Specification" wire:model.defer="specification">
                                <span class="text-danger"> 
                                    @error('specification')
                                    {{ $message }}   
                                    @enderror
                                </span>
                            </div>
                        </div>
                    </div>
                   


                    
                    <div class="row g-3">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Quantity Per Physical Count</label>
                                <input type="text" inputmode="decimal" class="form-control" placeholder="Enter Quantity Per Count" wire:model.defer="quantityphysicalcount"
                                  style="-moz-appearance: textfield; -webkit-appearance: none;" 
                                  onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46">
                                <span class="text-danger"> 
                                    @error('quantityphysicalcount')
                                    {{ $message }}   
                                    @enderror
                                </span>
                            </div>
                        </div>
                    </div>

                   
                    <div class="row g-3">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Remarks <span class="text-danger">*</span></label>
                                @if(!$useCustomRemarks)
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
                                    <div class="position-relative">
                                        <input type="text" class="form-select pe-5" wire:model.defer="remarks" placeholder="Type custom remarks..." style="cursor: text;">
                                        <button type="button" class="btn btn-sm position-absolute top-50 translate-middle-y end-0 me-1" wire:click="useRemarksList" style="font-size: 0.75rem; padding: 0.25rem 0.5rem;">
                                            Change
                                        </button>
                                    </div>
                                @endif
                                <span class="text-danger"> 
                                    @error('remarksSelection')
                                    {{ $message }}   
                                    @enderror
                                    @error('remarks')
                                    {{ $message }}   
                                    @enderror
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Unit Value <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">₱</span>
                                    <input type="text" inputmode="decimal" class="form-control currency-input" id="createUnitValueDisplay" data-target="createUnitValueHidden"
                                      placeholder="0.00" autocomplete="off" spellcheck="false" value="{{ $unitvalue }}">
                                    <button class="btn btn-outline-secondary currency-clear" type="button" title="Clear">&times;</button>
                                </div>
                                <input type="hidden" id="createUnitValueHidden" wire:model.defer="unitvalue" value="{{ $unitvalue }}">
                                <span class="text-danger"> 
                                    @error('unitvalue')
                                    {{ $message }}   
                                    @enderror
                                </span>
                            </div>
                        </div>
                    </div>

                   

                                   

                    <div class="d-flex gap-2 align-items-center">
                        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                            <span wire:loading.remove wire:target="createProperty,updateProperty">
                                {{ $isEditing ? 'Update Property' : 'Create Property' }}
                            </span>
                            <span wire:loading wire:target="createProperty,updateProperty">
                                <span class="spinner-border spinner-border-sm me-2" role="status"></span>
                                {{ $isEditing ? 'Updating...' : 'Creating...' }}
                            </span>
                        </button>
                        @if(!$isEditing)
                            <button type="button" class="btn btn-outline-secondary" wire:click="resetForm">
                                Clear Form
                            </button>
                        @endif
                    </div>
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

   

</div>

<style>
    /* Remove number input spinners for quantity fields */
    input[type="text"][inputmode="decimal"]::-webkit-outer-spin-button,
    input[type="text"][inputmode="decimal"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Currency formatter for Unit Value field
    function cleanCurrency(value) {
        return value.replace(/[^\d.]/g, '');
    }

    function formatTyping(value) {
        const clean = cleanCurrency(value);
        const parts = clean.split('.');
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        return parts.join('.');
    }

    function formatCurrency(value) {
        const num = parseFloat(cleanCurrency(value));
        if (isNaN(num)) return '';
        return num.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    function hiddenFor(displayId) {
        return document.getElementById(displayId)?.dataset.target;
    }

    function updateHiddenFromDisplay(displayId) {
        const display = document.getElementById(displayId);
        const hiddenId = display?.dataset.target;
        if (!hiddenId) return;
        
        const hidden = document.getElementById(hiddenId);
        if (hidden) {
            const clean = cleanCurrency(display.value);
            hidden.value = clean;
            hidden.dispatchEvent(new Event('input', { bubbles: true }));
        }
    }

    // Event delegation for currency inputs
    document.addEventListener('input', function(e) {
        if (e.target.classList.contains('currency-input')) {
            e.target.value = formatTyping(e.target.value);
            updateHiddenFromDisplay(e.target.id);
        }
    });

    document.addEventListener('blur', function(e) {
        if (e.target.classList.contains('currency-input')) {
            e.target.value = formatCurrency(e.target.value);
        }
    }, true);

    document.addEventListener('focus', function(e) {
        if (e.target.classList.contains('currency-input')) {
            e.target.value = cleanCurrency(e.target.value);
        }
    }, true);

    // Clear button handler
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('currency-clear')) {
            const inputGroup = e.target.closest('.input-group');
            const displayInput = inputGroup?.querySelector('.currency-input');
            if (displayInput) {
                displayInput.value = '';
                updateHiddenFromDisplay(displayInput.id);
                displayInput.focus();
            }
        }
    });
});

// Listen for clearCurrencyDisplay event from Livewire
window.addEventListener('clearCurrencyDisplay', function() {
    const currencyInput = document.getElementById('createUnitValueDisplay');
    if (currencyInput) {
        currencyInput.value = '';
    }
});
</script>
