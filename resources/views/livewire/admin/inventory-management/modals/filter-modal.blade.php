<!-- Filters Modal -->
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
                        <label class="form-label">Accountable Officer</label>
                        <div class="position-relative">
                            <div class="input-group">
                                <input type="text" class="form-control" aria-label="Accountable Officer" wire:model.debounce.300ms="modalSearch" wire:focus="$set('showModalDropdown', true)" wire:blur="$set('showModalDropdown', false)" placeholder="Type officer name..." autocomplete="off">
                                <button class="btn btn-outline-secondary" type="button" title="Clear officer" wire:click="$set('modalSearch','')">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                            @php
                                $searchLower = strtolower(trim($modalSearch));
                                $exactMatch = $EmployeeLists->contains(function($emp) use ($searchLower) {
                                    $fullName = strtolower(trim($emp->firstname . ' ' . $emp->middlename . ' ' . $emp->lastname));
                                    return $fullName === $searchLower;
                                });
                            @endphp
                            @if($showModalDropdown && !$exactMatch)
                                <div class="dropdown-menu show w-100" style="max-height: 220px; overflow-y: auto; z-index:1056;">
                                    @php
                                        if ($searchLower) {
                                            $filtered = $EmployeeLists->filter(function($emp) use ($searchLower) {
                                                $fullName = strtolower($emp->firstname . ' ' . $emp->middlename . ' ' . $emp->lastname);
                                                return str_contains($fullName, $searchLower);
                                            });
                                        } else {
                                            $filtered = $EmployeeLists;
                                        }
                                    @endphp
                                    @forelse($filtered as $emp)
                                        <a href="#" class="dropdown-item" wire:click.prevent="$set('modalSearch', '{{ $emp->firstname }} {{ $emp->middlename }} {{ $emp->lastname }}')">
                                            {{ $emp->firstname }} {{ $emp->middlename }} {{ $emp->lastname }}
                                        </a>
                                    @empty
                                        <span class="dropdown-item text-muted">No officers found</span>
                                    @endforelse
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Remarks</label>
                        <select class="form-select" wire:model.defer="modalRemarks">
                            <option value="">All Remarks</option>
                            @forelse ($RemarksList as $Remark)
                                <option value="{{ $Remark->remark_name }}">{{ $Remark->remark_name }}</option>
                            @empty
                                <option value="" disabled>No remarks available</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Date Acquired</label>
                        <input type="date" id="dateFromInput" class="form-control" wire:model.lazy="modalDateFrom">
                    </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Unit Value Min (₱)</label>
                                            <div class="input-group">
                                                <input type="text" inputmode="decimal" class="form-control currency-input" 
                                                       id="currencyMinDisplay" data-currency="min" placeholder="₱ 0.00" autocomplete="off" spellcheck="false"
                                                       value="{{ $modalValueMin }}">
                                                <button class="btn btn-outline-secondary currency-clear" type="button" title="Clear min">&times;</button>
                                            </div>
                                            <input type="hidden" id="modalValueMinHidden" wire:model.defer="modalValueMin" value="{{ $modalValueMin }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Unit Value Max (₱)</label>
                                            <div class="input-group">
                                                <input type="text" inputmode="decimal" class="form-control currency-input" 
                                                       id="currencyMaxDisplay" data-currency="max" placeholder="₱ 0.00" autocomplete="off" spellcheck="false"
                                                       value="{{ $modalValueMax }}">
                                                <button class="btn btn-outline-secondary currency-clear" type="button" title="Clear max">&times;</button>
                                            </div>
                                            <input type="hidden" id="modalValueMaxHidden" wire:model.defer="modalValueMax" value="{{ $modalValueMax }}">
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

<script>
// Currency input: blocks letters, formats while typing, syncs hidden Livewire fields
(function(){
    if (window.__currencyInputsInit) return; window.__currencyInputsInit = true;

    function clean(val){
        val = (val || '').toString().replace(/[^0-9.]/g, '');
        const firstDot = val.indexOf('.');
        if (firstDot !== -1) {
            // keep only first dot
            val = val.slice(0, firstDot + 1) + val.slice(firstDot + 1).replace(/\./g, '');
        }
        // limit to 2 decimals
        const parts = val.split('.');
        if (parts.length === 2) {
            parts[1] = parts[1].slice(0, 2);
            val = parts[0] + (parts[1].length ? '.' + parts[1] : '');
        }
        // strip leading zeros but keep single 0
        val = val.replace(/^0+(\d)/, '$1');
        return val;
    }

    function formatTyping(val){
        if (!val) return '';
        const parts = val.split('.');
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        return parts.length > 1 ? parts[0] + '.' + parts[1] : parts[0];
    }

    function formatCurrency(val){
        const num = parseFloat(val);
        if (isNaN(num)) return '';
        return '₱ ' + num.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2});
    }

    function hiddenFor(display){
        const explicit = display.getAttribute('data-target');
        if (explicit) return document.getElementById(explicit);
        const which = display.getAttribute('data-currency');
        if (which === 'min') return document.getElementById('modalValueMinHidden');
        if (which === 'max') return document.getElementById('modalValueMaxHidden');
        if (which === 'edit') return document.getElementById('editUnitValueHidden');
        return null;
    }

    function updateHiddenFromDisplay(display){
        const hidden = hiddenFor(display); if (!hidden) return;
        hidden.value = clean(display.value);
        hidden.dispatchEvent(new Event('input', { bubbles: true }));
    }

    document.addEventListener('keydown', function(e){
        const el = e.target.closest('.currency-input'); if (!el) return;
        const allowed = ['Backspace','Delete','Tab','Escape','Enter','ArrowLeft','ArrowRight','Home','End'];
        if (allowed.includes(e.key)) return;
        if ((e.ctrlKey||e.metaKey) && ['a','c','v','x'].includes(e.key.toLowerCase())) return;
        if (e.key === '.' && clean(el.value).includes('.')) { e.preventDefault(); return; }
        if (!/^[0-9.]$/.test(e.key)) { e.preventDefault(); }
    });

    document.addEventListener('input', function(e){
        const el = e.target.closest('.currency-input'); if (!el) return;
        const raw = clean(el.value);
        el.value = formatTyping(raw);
        updateHiddenFromDisplay(el);
    });

    document.addEventListener('paste', function(e){
        const el = e.target.closest('.currency-input'); if (!el) return;
        e.preventDefault();
        const text = (e.clipboardData || window.clipboardData).getData('text');
        const cleaned = clean(text);
        document.execCommand('insertText', false, cleaned);
    });

    document.addEventListener('focusin', function(e){
        const el = e.target.closest('.currency-input'); if (!el) return;
        const hidden = hiddenFor(el);
        const raw = clean(hidden && hidden.value ? hidden.value : el.value);
        el.value = formatTyping(raw);
    });

    document.addEventListener('focusout', function(e){
        const el = e.target.closest('.currency-input'); if (!el) return;
        const raw = clean(el.value);
        el.value = raw ? formatCurrency(raw) : '';
        updateHiddenFromDisplay(el);
    });

    window.addEventListener('load', function(){
        document.querySelectorAll('.currency-input').forEach(function(el){
            const hidden = hiddenFor(el);
            const raw = clean(hidden && hidden.value ? hidden.value : el.value);
            el.value = raw ? formatCurrency(raw) : '';
        });

        // Sync date min/max for better UX
        const from = document.getElementById('dateFromInput');
        const to = document.getElementById('dateToInput');
        if (from && to) {
            const sync = () => {
                if (from.value) to.min = from.value; else to.removeAttribute('min');
                if (to.value) from.max = to.value; else from.removeAttribute('max');
            };
            from.addEventListener('change', sync);
            to.addEventListener('change', sync);
            sync();
        }

        // Clear buttons for currency inputs
        document.querySelectorAll('.currency-clear').forEach(function(btn){
            btn.addEventListener('click', function(){
                const input = this.parentElement.querySelector('.currency-input');
                if (!input) return;
                input.value = '';
                updateHiddenFromDisplay(input);
            });
        });
    });

    // Handle Livewire 'Clear Filters' action to visually reset currency inputs
    window.addEventListener('filters-cleared', function(){
        document.querySelectorAll('.currency-input').forEach(function(el){
            el.value = '';
            updateHiddenFromDisplay(el);
        });
    });
})();
</script>
