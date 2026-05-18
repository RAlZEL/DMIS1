<div class="ims-page" id="imsInventoryPageRoot">
    <div class="row ims-page-row">
        <div class="col-12 ims-page-col">
            <div class="card ims-main-card">
                <!-- Header Section -->
                <div class="card-body border-bottom ims-toolbar">
                    <div class="d-flex flex-wrap gap-3 align-items-center">
                        <!-- Left: Entries Per Page -->
                        <div class="text-muted d-flex align-items-center ims-toolbar-meta">
                            <span class="me-2 fw-500"><i class="fa-solid fa-list me-1"></i>Show</span>
                            <div class="mx-2 d-inline-block">
                                <select class="form-select form-select-sm ims-per-page-select" wire:model="perPage">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                            <span class="text-sm">entries</span>
                        </div>

                        <!-- Right: Action Buttons -->
                        <div class="ms-auto d-flex gap-2 flex-wrap ims-toolbar-actions">
                            <button type="button" class="btn btn-outline-info btn-sm gap-2 ims-btn-secondary" data-bs-toggle="modal" data-bs-target="#article_modal" title="Manage articles">
                                <i class="fa-solid fa-tags"></i>
                                <span>Add Article</span>
                            </button>
                            <button type="button" class="btn btn-success btn-sm gap-2 ims-btn-primary" data-bs-toggle="modal" data-bs-target="#create_property_modal" title="Add a new property">
                                <i class="fa-solid fa-plus"></i>
                                <span>Add Property</span>
                            </button>
                            <button type="button" class="btn btn-outline-secondary btn-sm gap-2 ims-btn-tertiary js-ims-print-current-page" title="Print the current table page">
                                <i class="fa-solid fa-print"></i>
                                <span>Print</span>
                            </button>
                            <button type="button" class="btn btn-outline-secondary btn-sm gap-2 ims-btn-tertiary" wire:click="resetToFirstPage" title="Reset filters and pagination">
                                <i class="fa-solid fa-rotate-left"></i>
                                <span>Reset</span>
                            </button>
                            <button type="button" class="btn btn-primary btn-sm gap-2 ims-btn-secondary" wire:click="openFilterModal" data-bs-toggle="modal" data-bs-target="#filterModal" title="Apply filters to properties">
                                <i class="fa-solid fa-filter"></i>
                                <span>Filters</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Statistics Cards -->
                <div class="px-3 py-2 bg-light ims-stats-wrap">
                    <div class="row g-3">
                        <div class="col-sm-4 col-12">
                            <div class="card h-100 shadow-sm border-0 ims-stat-card">
                                <div class="card-body ims-stat-card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <div class="text-muted text-sm mb-1 ims-stat-label">
                                                <i class="fa-solid fa-box me-1 text-primary"></i>Total Items (All)
                                            </div>
                                            <div class="h3 mb-0 fw-bold text-primary ims-stat-value">{{ number_format($totalCountAll) }}</div>
                                        </div>
                                        <div class="text-primary opacity-50 ims-stat-icon">
                                            <i class="fa-solid fa-inbox fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-12">
                            <div class="card h-100 shadow-sm border-0 ims-stat-card">
                                <div class="card-body ims-stat-card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <div class="text-muted text-sm mb-1 ims-stat-label">
                                                <i class="fa-solid fa-filter me-1 text-info"></i>Filtered Items
                                            </div>
                                            <div class="h3 mb-0 fw-bold text-info ims-stat-value">{{ number_format($filteredCount) }}</div>
                                        </div>
                                        <div class="text-info opacity-50 ims-stat-icon">
                                            <i class="fa-solid fa-list-check fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-12">
                            <div class="card h-100 shadow-sm border-0 ims-stat-card">
                                <div class="card-body ims-stat-card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <div class="text-muted text-sm mb-1 ims-stat-label">
                                                <i class="fa-solid fa-peso-sign me-1 text-success"></i>Total Unit Value (Filtered)
                                            </div>
                                            <div class="h3 mb-0 fw-bold text-success ims-stat-value"><span class="currency-inline">&#8369;&nbsp;{{ number_format($totalUnitValue, 2) }}</span></div>
                                        </div>
                                        <div class="text-success opacity-50 ims-stat-icon">
                                            <i class="fa-solid fa-calculator fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @php
                    $selectedOffice = $office !== '' ? $OfficeLists->firstWhere('id', (int) $office) : null;
                    $selectedDescription = $description !== '' ? $descriptionFilterOptions->firstWhere('id', (int) $description) : null;
                    $unitValueRangeLabels = [
                        'below_50k' => 'SEMI-EXPENDABLE - BELOW 50K',
                        'ppe_50k_and_above' => 'PPE (PLANTS AND EQUIPMENTS) - 50K AND ABOVE',
                    ];
                    $activeFilters = [];

                    if ($selectedOffice) {
                        $activeFilters[] = ['label' => 'Office', 'value' => $selectedOffice->office];
                    }

                    if ($officer !== '') {
                        $activeFilters[] = ['label' => 'Officer', 'value' => $officer];
                    }

                    if ($selectedDescription) {
                        $activeFilters[] = [
                            'label' => 'Description',
                            'value' => trim(($selectedDescription->ArticleName->article_name ?? 'N/A') . ' - ' . $selectedDescription->article_description),
                        ];
                    }

                    if ($remarks !== '') {
                        $activeFilters[] = ['label' => 'Remarks', 'value' => $remarks];
                    }

                    if ($dateFrom) {
                        $activeFilters[] = ['label' => 'Date', 'value' => \Carbon\Carbon::parse($dateFrom)->format('Y-m-d')];
                    }

                    if ($unitValueRange !== '') {
                        $activeFilters[] = ['label' => 'Unit Value', 'value' => $unitValueRangeLabels[$unitValueRange] ?? $unitValueRange];
                    }
                @endphp

                @if (count($activeFilters))
                    <div class="ims-filter-summary-strip">
                        <div class="ims-filter-summary-head">
                            <div>
                                <div class="ims-filter-summary-title">Active Filters</div>
                                <div class="ims-filter-summary-subtitle">
                                    {{ count($activeFilters) . ' filter(s) applied' }}
                                </div>
                            </div>

                            <button type="button" class="btn ims-summary-clear-btn" wire:click="resetToFirstPage">
                                <i class="fa-solid fa-rotate-left"></i>
                                <span>Clear all</span>
                            </button>
                        </div>

                        <div class="ims-filter-chip-row">
                            @foreach ($activeFilters as $filter)
                                <span class="ims-filter-chip">
                                    <span class="ims-filter-chip-label">{{ $filter['label'] }}</span>
                                    <span class="ims-filter-chip-value">{{ $filter['value'] }}</span>
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                @include('livewire.admin.inventory-management.modals.filter-modal')
                @include('livewire.admin.inventory-management.modals.create-property-modal')
                <!-- Table Section -->
                <div class="ims-records-shell">

                    <div class="d-none d-md-flex flex-column ims-table-panel">
                        <div class="table-responsive ims-table-wrap">
                    <table id="imsCurrentTable" class="table table-vcenter table-mobile-md card-table table-striped inventory-table mb-0" style="--ims-visible-rows: {{ max($properties->count(), 1) }};">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-center fw-bold">
                                <span>ARTICLE/ITEM</span>
                            </th>
                            <th class="text-center fw-bold">
                                <span>DESCRIPTION</span>
                            </th>
                            <th class="text-center fw-bold">
                                <span>SPECIFICATION</span>
                            </th>
                            <th class="text-center fw-bold">
                                <span>PROPERTY NO.</span>
                            </th>
                            <th class="text-center fw-bold">
                                <span>UNIT OF MEASUREMENT</span>
                            </th>
                            <th class="text-center fw-bold">
                                <span>UNIT VALUE</span>
                            </th>
                            <th class="text-center fw-bold">
                                <span>REMARKS</span>
                            </th>
                            <th class="text-center fw-bold">
                                <span>ACCOUNTABLE OFFICER</span>
                            </th>
                            <th class="text-center fw-bold">
                                <span>UACS</span>
                            </th>
                            <th class="text-center fw-bold">
                                <span>FUND CLUSTER</span>
                            </th>
                            <th class="text-center fw-bold">
                                <span>ESTIMATED USEFUL LIFE</span>
                            </th>
                            <th class="text-center fw-bold">
                                <span>DATE ACQUIRED</span>
                            </th>
                            <th class="text-center fw-bold">
                                <span>OFFICE</span>
                            </th>
                            <th class="text-center fw-bold ims-action-col">
                                <span>ACTIONS</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($properties as $Index => $property)
                        @php
                            $specificationText = trim(str_replace(["\r", "\n"], ' ', (string) ($property->specification ?? '')));
                            $hasLongSpecification = strlen($specificationText) > 80;
                        @endphp
                        <tr class="table-row-hover">
                            <td class="text-center fw-500">{{ $property->ArticleName->article_name ?? 'N/A' }}</td>
                            <td class="text-center text-muted">{{ $property->ArticleDescription->article_description ?? 'N/A' }}</td>
                            <td class="text-center text-muted specification-cell">
                                @if ($specificationText !== '')
                                    <div class="specification-content">
                                        <span class="specification-cell-text" title="{{ $specificationText }}">
                                            {{ $specificationText }}
                                        </span>
                                        @if ($hasLongSpecification)
                                            <button type="button" class="specification-toggle-btn" aria-expanded="false">
                                                More
                                            </button>
                                        @endif
                                    </div>
                                @else
                                    <span class="specification-cell-text" title="N/A">N/A</span>
                                @endif
                            </td>
                            <td class="text-center fw-500">{{ $property->property_no ?: 'N/A' }}</td>
                            <td class="text-center text-muted">{{ $property->unit_of_measurement ?: 'N/A' }}</td>
                            <td class="text-center fw-600 text-success">
                                @if($property->unit_value !== null)
                                    <span class="currency-inline">&#8369;&nbsp;{{ number_format($property->unit_value, 2) }}</span>
                                @else
                                    N/A
                                @endif
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
                                    <span class="text-muted" title="{{ trim($property->Employee->firstname . ' ' . ($property->Employee->middlename ? $property->Employee->middlename . ' ' : '') . $property->Employee->lastname) }}">{{ $property->Employee->firstname . ' ' . substr($property->Employee->middlename, 0, 1) . '. ' . $property->Employee->lastname }}</span>
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>
                            <td class="text-center text-muted">{{ $this->displayPropertyUacs($property) }}</td>
                            <td class="text-center text-muted">{{ $property->fund_cluster ?: 'N/A' }}</td>
                            <td class="text-center text-muted">{{ $property->estimated_useful_life ?: 'N/A' }}</td>
                            <td class="text-center date-cell">
                              <span class="badge bg-light text-dark date-badge">{{ $property->date_acquired ? \Carbon\Carbon::parse($property->date_acquired)->format('Y-m-d') : 'N/A' }}</span>
                            </td>
                            <td class="text-center text-sm">
                                <span class="text-muted" title="{{ $property->Office->office ?? 'N/A' }}">{{ $property->Office->office ?? 'N/A' }}</span>
                            </td>
                            <td class="text-center ims-action-cell">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-success dropdown-toggle action-dropdown-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Actions
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end action-dropdown-menu">
                                        <li>
                                            <a class="dropdown-item text-primary" href="#" wire:click.prevent="editProperty({{ $property->id }})">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                                <span>Edit</span>
                                            </a>
                                        </li>

                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <a class="dropdown-item text-danger" href="#" wire:click.prevent="confirmDelete({{ $property->id }})">
                                                <i class="fa-regular fa-trash-can"></i>
                                                <span>Delete</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="14" class="text-center py-4">
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
                    </div>

                    <div class="ims-mobile-list d-md-none">
                        @forelse ($properties as $property)
                            @php
                                $specificationText = trim(str_replace(["\r", "\n"], ' ', (string) ($property->specification ?? '')));
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
                                $employeeFullName = $property->Employee
                                    ? trim($property->Employee->firstname . ' ' . ($property->Employee->middlename ? $property->Employee->middlename . ' ' : '') . $property->Employee->lastname)
                                    : 'N/A';
                            @endphp
                            <article class="ims-mobile-card">
                                <div class="ims-mobile-card-top">
                                    <div class="ims-mobile-card-copy">
                                        <span class="ims-mobile-card-kicker">ARTICLE/ITEM</span>
                                        <h3 class="ims-mobile-card-title">{{ $property->ArticleName->article_name ?? 'N/A' }}</h3>
                                        <p class="ims-mobile-card-subtitle">{{ $property->ArticleDescription->article_description ?? 'N/A' }}</p>
                                    </div>

                                    <div class="ims-mobile-card-value">
                                        <span class="ims-mobile-card-kicker">UNIT VALUE</span>
                                        <strong class="text-success">
                                            @if($property->unit_value !== null)
                                                <span class="currency-inline">&#8369;&nbsp;{{ number_format($property->unit_value, 2) }}</span>
                                            @else
                                                N/A
                                            @endif
                                        </strong>
                                    </div>
                                </div>

                                <div class="ims-mobile-card-grid">
                                    <div class="ims-mobile-meta">
                                        <span class="ims-mobile-meta-label">Property No.</span>
                                        <span class="ims-mobile-meta-value">{{ $property->property_no ?: 'N/A' }}</span>
                                    </div>
                                    <div class="ims-mobile-meta">
                                        <span class="ims-mobile-meta-label">Officer</span>
                                        <span class="ims-mobile-meta-value">{{ $employeeFullName }}</span>
                                    </div>
                                    <div class="ims-mobile-meta">
                                        <span class="ims-mobile-meta-label">Date Acquired</span>
                                        <span class="ims-mobile-meta-value">{{ $property->date_acquired ? \Carbon\Carbon::parse($property->date_acquired)->format('Y-m-d') : 'N/A' }}</span>
                                    </div>
                                    <div class="ims-mobile-meta">
                                        <span class="ims-mobile-meta-label">Office</span>
                                        <span class="ims-mobile-meta-value">{{ $property->Office->office ?? 'N/A' }}</span>
                                    </div>
                                </div>

                                <div class="ims-mobile-card-remarks">
                                    <span class="badge {{ $badgeClass }} px-2 py-1">{{ $remarksText }}</span>
                                </div>

                                <details class="ims-mobile-card-details">
                                    <summary>More details</summary>
                                    <div class="ims-mobile-card-extra">
                                        <div class="ims-mobile-meta">
                                            <span class="ims-mobile-meta-label">Specification</span>
                                            <span class="ims-mobile-meta-value">{{ $specificationText !== '' ? $specificationText : 'N/A' }}</span>
                                        </div>
                                        <div class="ims-mobile-meta">
                                            <span class="ims-mobile-meta-label">Unit of Measurement</span>
                                            <span class="ims-mobile-meta-value">{{ $property->unit_of_measurement ?: 'N/A' }}</span>
                                        </div>
                                        <div class="ims-mobile-meta">
                                            <span class="ims-mobile-meta-label">UACS</span>
                                            <span class="ims-mobile-meta-value">{{ $this->displayPropertyUacs($property) }}</span>
                                        </div>
                                        <div class="ims-mobile-meta">
                                            <span class="ims-mobile-meta-label">Fund Cluster</span>
                                            <span class="ims-mobile-meta-value">{{ $property->fund_cluster ?: 'N/A' }}</span>
                                        </div>
                                        <div class="ims-mobile-meta">
                                            <span class="ims-mobile-meta-label">Estimated Useful Life</span>
                                            <span class="ims-mobile-meta-value">{{ $property->estimated_useful_life ?: 'N/A' }}</span>
                                        </div>
                                    </div>
                                </details>

                                <div class="ims-mobile-card-actions">
                                    <button type="button" class="btn btn-primary btn-sm" wire:click.prevent="editProperty({{ $property->id }})">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                        <span>Edit</span>
                                    </button>

                                    <button type="button" class="btn btn-outline-danger btn-sm" wire:click.prevent="confirmDelete({{ $property->id }})">
                                        <i class="fa-regular fa-trash-can"></i>
                                        <span>Delete</span>
                                    </button>
                                </div>
                            </article>
                        @empty
                            <div class="ims-mobile-empty">
                                <i class="fa-solid fa-inbox"></i>
                                <span>No properties found.</span>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Pagination Footer -->
                <div class="card-footer px-4 py-3 bg-light ims-table-footer">
                    <div class="d-flex align-items-center justify-content-end ims-table-footer-inner">
                        {{ $properties->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Removed legacy office modals; IMS page now uses property-focused flows only --}}

    @include('livewire.admin.inventory-management.property.edit')

    <!-- Delete Confirmation Modal -->
    <div wire:ignore.self class="modal modal-blur fade ims-modal-shell ims-confirm-modal" id="deletePropertyModal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <form class="modal-content ims-modal-content" method="POST" wire:submit.prevent="deleteProperty()">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-status bg-danger"></div>
                <div class="modal-body text-center py-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v2m0 4v.01" /><path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" /></svg>
                    <h3 class="ims-confirm-title">Delete this property?</h3>
                    <div class="text-muted ims-confirm-copy">This action removes the inventory record from IMS.</div>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <div class="row">
                            <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">Cancel</a></div>
                            <div class="col">
                                <button type="submit" class="btn btn-danger w-100" wire:loading.attr="disabled" wire:target="deleteProperty">
                                    <span wire:loading.remove wire:target="deleteProperty">Delete</span>
                                    <span wire:loading wire:target="deleteProperty"><i class="spinner-border spinner-border-sm me-1"></i>Deleting...</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
<!-- ARTICLE MANAGEMENT MODAL -->
<div wire:ignore.self class="modal modal-blur fade ims-modal-shell" id="article_modal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content ims-modal-content ims-article-modal">
            <div class="modal-header border-bottom ims-article-header">
                <div class="ims-article-heading">
                    <h5 class="ims-article-heading-title">Article Management</h5>
                    <p class="ims-article-heading-subtitle">Create and maintain article names, descriptions, and reusable remarks.</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body ims-article-body">
                <ul class="nav nav-pills ims-article-tabs" role="tablist">
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
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="manage_remarks_tab" data-bs-toggle="tab" data-bs-target="#manage_remarks_content" type="button" role="tab" aria-controls="manage_remarks_content" aria-selected="false">
                            <i class="fa-solid fa-comment-dots me-2"></i>Remarks
                        </button>
                    </li>
                </ul>

                <div class="tab-content ims-article-tab-content">
                    <div class="tab-pane fade show active ims-article-tab-pane" id="add_article_content" role="tabpanel">
                        <section class="ims-article-section-card ims-article-form-card">
                            <div class="ims-article-section-head">
                                <h6 class="ims-article-section-title">Create Article Name</h6>
                                <p class="ims-article-section-subtitle">Add a unique article label used in IMS property records.</p>
                            </div>

                        <form wire:submit.prevent="addNewArticle" class="ims-article-form">
                            <div class="row g-3">
                                <div class="col-lg-4">
                                    <label class="form-label fw-600">Article Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('new_article_name') is-invalid @enderror"
                                           id="imsNewArticleName" maxlength="255" placeholder="Enter article name" wire:model.defer="new_article_name" autofocus>
                                    @error('new_article_name')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label fw-600">PPE UACS</label>
                                    <input type="text" class="form-control @error('new_article_ppe_uacs') is-invalid @enderror" id="imsNewArticlePpeUacs" maxlength="255" placeholder="Optional PPE UACS" wire:model.defer="new_article_ppe_uacs">
                                    @error('new_article_ppe_uacs')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label fw-600">Semi-ex UACS</label>
                                    <input type="text" class="form-control @error('new_article_semi_ex_uacs') is-invalid @enderror" id="imsNewArticleSemiExUacs" maxlength="255" placeholder="Optional Semi-ex UACS" wire:model.defer="new_article_semi_ex_uacs">
                                    @error('new_article_semi_ex_uacs')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mt-3">
                                <small class="text-muted">Optional fields. Leave either UACS blank if no code applies.</small>
                                <div class="d-flex gap-2 justify-content-end ims-article-form-actions">
                                    <button type="button" class="btn btn-outline-secondary ims-btn-tertiary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary ims-btn-secondary" wire:loading.attr="disabled" wire:target="addNewArticle">
                                        <span wire:loading.remove wire:target="addNewArticle">Add Article</span>
                                        <span wire:loading wire:target="addNewArticle"><i class="spinner-border spinner-border-sm me-2"></i>Processing...</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                        </section>

                        <section class="ims-article-section-card ims-article-list-card">
                        <div class="ims-article-list-toolbar">
                            <div class="ims-article-list-title">
                                <h6 class="mb-0 ims-article-section-title">Existing Article Names</h6>
                                <span class="badge bg-light text-dark">{{ number_format($articleNameTotal) }}</span>
                            </div>
                            <div class="input-group input-group-sm ims-article-search-group">
                                <input type="text" class="form-control ims-article-search" placeholder="Search article names..." wire:model.debounce.300ms="articleSearch">
                                <button type="button" class="btn btn-outline-secondary" wire:click="$set('articleSearch','')" {{ $articleSearch === '' ? 'disabled' : '' }}>Clear</button>
                            </div>
                        </div>

                        <div class="table-responsive ims-article-table-wrap">
                            <table class="table table-sm table-striped align-middle mb-0 ims-article-table">
                                <thead>
                                    <tr>
                                        <th>Article Name</th>
                                        <th>PPE UACS</th>
                                        <th>Semi-ex UACS</th>
                                        <th class="text-end" style="width: 220px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($articleNameResults as $articleItem)
                                        <tr wire:key="article-item-{{ $articleItem->id }}" class="{{ (int) $editingArticleId === (int) $articleItem->id ? 'ims-article-edit-row' : ((int) $confirmingArticleDeleteId === (int) $articleItem->id ? 'ims-article-delete-target-row' : ((int) $recentArticleId === (int) $articleItem->id ? 'ims-recent-row' : '')) }}">
                                            <td>
                                                @if((int) $editingArticleId === (int) $articleItem->id)
                                                    <input type="text" class="form-control form-control-sm ims-article-edit-input @error('editingArticleName') is-invalid @enderror" wire:model.defer="editingArticleName">
                                                    @error('editingArticleName')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                @else
                                                    <span class="fw-600">{{ $articleItem->article_name }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if((int) $editingArticleId === (int) $articleItem->id)
                                                    <input type="text" class="form-control form-control-sm ims-article-edit-input @error('editingArticlePpeUacs') is-invalid @enderror" wire:model.defer="editingArticlePpeUacs" maxlength="255" placeholder="Optional PPE UACS">
                                                    @error('editingArticlePpeUacs')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                @else
                                                    <span class="text-muted">{{ $articleItem->ppe_uacs ?: 'N/A' }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if((int) $editingArticleId === (int) $articleItem->id)
                                                    <input type="text" class="form-control form-control-sm ims-article-edit-input @error('editingArticleSemiExUacs') is-invalid @enderror" wire:model.defer="editingArticleSemiExUacs" maxlength="255" placeholder="Optional Semi-ex UACS">
                                                    @error('editingArticleSemiExUacs')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                @else
                                                    <span class="text-muted">{{ $articleItem->semi_ex_uacs ?: 'N/A' }}</span>
                                                @endif
                                            </td>
                                            <td class="text-end ims-inline-actions">
                                                @if((int) $editingArticleId === (int) $articleItem->id)
                                                    <div class="ims-inline-actions-group ims-inline-actions-group-edit">
                                                        <button type="button" class="btn btn-success btn-sm" data-ims-article-row-action="save" wire:click.prevent="saveEditArticle" wire:loading.attr="disabled" wire:target="saveEditArticle">
                                                            Save
                                                        </button>
                                                        <button type="button" class="btn btn-outline-secondary btn-sm" data-ims-article-row-action="cancel-edit" wire:click.prevent="cancelEditArticle" wire:loading.attr="disabled" wire:target="cancelEditArticle">
                                                            Cancel
                                                        </button>
                                                    </div>
                                                @else
                                                    <div class="ims-inline-actions-group">
                                                        <button type="button" class="btn btn-primary btn-sm" data-ims-article-row-action="edit" wire:click.prevent="startEditArticle({{ $articleItem->id }})" wire:loading.attr="disabled" wire:target="startEditArticle">
                                                            Edit
                                                        </button>
                                                        <button type="button" class="btn btn-danger btn-sm" data-ims-article-row-action="delete" wire:click.prevent="promptDeleteArticle({{ $articleItem->id }})" wire:loading.attr="disabled" wire:target="promptDeleteArticle">
                                                            Delete
                                                        </button>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="py-3">
                                                <div class="ims-article-empty">
                                                    <i class="fa-solid fa-inbox"></i>
                                                    <span>No article names found.</span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        @if($confirmingArticleDeleteId)
                            <div class="ims-article-confirm-overlay" wire:key="article-delete-popup-{{ $confirmingArticleDeleteId }}">
                                <div class="ims-article-confirm-card" role="alertdialog" aria-modal="true" aria-labelledby="imsArticleDeleteTitle">
                                    <div class="ims-article-confirm-icon">
                                        <i class="fa-solid fa-triangle-exclamation"></i>
                                    </div>
                                    <div class="ims-article-confirm-copy-wrap">
                                        <h6 id="imsArticleDeleteTitle" class="ims-article-confirm-title">Delete Article Name</h6>
                                        <p class="ims-article-confirm-text">
                                            Delete <strong>{{ $confirmingArticleDeleteName ?: 'this article' }}</strong> from Existing Article Names?
                                        </p>
                                        <span class="ims-article-confirm-subtext">This action removes the article name if it is not currently in use.</span>
                                    </div>
                                    <div class="ims-article-confirm-actions">
                                        <button type="button" class="btn btn-outline-secondary" data-ims-article-row-action="cancel-delete" wire:click.prevent="cancelDeleteArticle" wire:loading.attr="disabled" wire:target="cancelDeleteArticle,deleteArticle">
                                            Cancel
                                        </button>
                                        <button type="button" class="btn btn-danger" data-ims-article-row-action="confirm-delete" wire:click.prevent="deleteArticle({{ $confirmingArticleDeleteId }})" wire:loading.attr="disabled" wire:target="deleteArticle">
                                            Confirm Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif
                        </section>
                    </div>

                    <!-- Add Description Tab -->
                    <div class="tab-pane fade ims-article-tab-pane" id="add_description_content" role="tabpanel">
                        @php
                            $hasArticleOptions = collect($articles)->isNotEmpty();
                        @endphp
                        <section class="ims-article-section-card ims-article-form-card">
                            <div class="ims-article-section-head">
                                <h6 class="ims-article-section-title">Create Article Description</h6>
                                <p class="ims-article-section-subtitle">Attach descriptions to an existing article for better inventory detail.</p>
                            </div>

                            @if(! $hasArticleOptions)
                                <div class="ims-article-guard">
                                    <i class="fa-solid fa-circle-info"></i>
                                    <span>Add an article name first.</span>
                                </div>
                            @endif

                            <form wire:submit.prevent="addNewArticleDescription" class="ims-article-form">
                                <div class="mb-3">
                                    <label class="form-label fw-600">Article Name <span class="text-danger">*</span></label>
                                    <select class="form-select @error('new_article_id') is-invalid @enderror" wire:model.defer="new_article_id" {{ $hasArticleOptions ? '' : 'disabled' }}>
                                        <option value="">--- Choose Article Name ---</option>
                                        @forelse ($articles as $articleOption)
                                            <option value="{{ $articleOption->id }}">{{ $articleOption->article_name }}</option>
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
                                           id="newArticleDescriptionInput" maxlength="255" placeholder="Enter article description" wire:model.defer="new_article_description" {{ $hasArticleOptions ? '' : 'disabled' }}>
                                    @error('new_article_description')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex gap-2 justify-content-end ims-article-form-actions">
                                    <button type="button" class="btn btn-outline-secondary ims-btn-tertiary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary ims-btn-secondary" wire:loading.attr="disabled" wire:target="addNewArticleDescription" {{ $hasArticleOptions ? '' : 'disabled' }}>
                                        <span wire:loading.remove wire:target="addNewArticleDescription">Add Description</span>
                                        <span wire:loading wire:target="addNewArticleDescription"><i class="spinner-border spinner-border-sm me-2"></i>Processing...</span>
                                    </button>
                                </div>
                            </form>
                        </section>

                        <section class="ims-article-section-card ims-article-list-card">
                            <div class="ims-article-list-toolbar">
                                <div class="ims-article-list-title">
                                    <h6 class="mb-0 ims-article-section-title">Existing Descriptions</h6>
                                    <span class="badge bg-light text-dark">{{ number_format($articleDescriptionTotal) }}</span>
                                </div>
                                <div class="input-group input-group-sm ims-article-search-group">
                                    <input type="text" class="form-control ims-article-search" placeholder="Search descriptions..." wire:model.debounce.300ms="articleDescriptionSearch">
                                    <button type="button" class="btn btn-outline-secondary" wire:click="$set('articleDescriptionSearch','')" {{ $articleDescriptionSearch === '' ? 'disabled' : '' }}>Clear</button>
                                </div>
                            </div>

                            <div class="table-responsive ims-article-table-wrap">
                                <table class="table table-sm table-striped align-middle mb-0 ims-article-table">
                                    <thead>
                                        <tr>
                                            <th>Article Name</th>
                                            <th>Description</th>
                                            <th class="text-end" style="width: 220px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($articleDescriptionResults as $descItem)
                                            <tr wire:key="description-item-{{ $descItem->id }}" class="{{ (int) $editingDescriptionId === (int) $descItem->id ? 'ims-article-edit-row' : ((int) $recentDescriptionId === (int) $descItem->id ? 'ims-recent-row' : '') }}">
                                                <td>{{ $descItem->ArticleName->article_name ?? 'N/A' }}</td>
                                                <td>
                                                    @if((int) $editingDescriptionId === (int) $descItem->id)
                                                        <input type="text" class="form-control form-control-sm @error('editingDescriptionText') is-invalid @enderror" wire:model.defer="editingDescriptionText">
                                                        @error('editingDescriptionText')
                                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                                        @enderror
                                                    @else
                                                        {{ $descItem->article_description }}
                                                    @endif
                                                </td>
                                                <td class="text-end ims-inline-actions">
                                                    @if((int) $editingDescriptionId === (int) $descItem->id)
                                                        <button type="button" class="btn btn-success btn-sm" wire:click="saveEditArticleDescription" wire:loading.attr="disabled" wire:target="saveEditArticleDescription">
                                                            Save
                                                        </button>
                                                        <button type="button" class="btn btn-outline-secondary btn-sm" wire:click="cancelEditArticleDescription" wire:loading.attr="disabled" wire:target="cancelEditArticleDescription">
                                                            Cancel
                                                        </button>
                                                    @elseif((int) $confirmingDescriptionDeleteId === (int) $descItem->id)
                                                        <span class="ims-inline-confirm-copy">Delete this description?</span>
                                                        <button type="button" class="btn btn-danger btn-sm" wire:click.prevent="deleteArticleDescription({{ $descItem->id }})" wire:loading.attr="disabled" wire:target="deleteArticleDescription">
                                                            Confirm
                                                        </button>
                                                        <button type="button" class="btn btn-outline-secondary btn-sm" wire:click.prevent="cancelDeleteArticleDescription" wire:loading.attr="disabled" wire:target="cancelDeleteArticleDescription">
                                                            Cancel
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-primary btn-sm" wire:click.prevent="startEditArticleDescription({{ $descItem->id }})" wire:loading.attr="disabled" wire:target="startEditArticleDescription">
                                                            Edit
                                                        </button>
                                                        <button type="button" class="btn btn-danger btn-sm" wire:click.prevent="promptDeleteArticleDescription({{ $descItem->id }})" wire:loading.attr="disabled" wire:target="promptDeleteArticleDescription">
                                                            Delete
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="py-3">
                                                    <div class="ims-article-empty">
                                                        <i class="fa-solid fa-inbox"></i>
                                                        <span>No article descriptions found.</span>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </section>
                    </div>

                    <!-- Remarks Tab -->
                    <div class="tab-pane fade ims-article-tab-pane" id="manage_remarks_content" role="tabpanel">
                        <section class="ims-article-section-card ims-article-form-card">
                            <div class="ims-article-section-head">
                                <h6 class="ims-article-section-title">Create Remark</h6>
                                <p class="ims-article-section-subtitle">Manage reusable remarks used in inventory records.</p>
                            </div>

                            <form wire:submit.prevent="addNewRemark" class="ims-article-form">
                                <div class="mb-3">
                                    <label class="form-label fw-600">Remark Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('new_remark_name') is-invalid @enderror"
                                           maxlength="100" placeholder="Enter remark name" wire:model.defer="new_remark_name">
                                    @error('new_remark_name')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex gap-2 justify-content-end ims-article-form-actions">
                                    <button type="button" class="btn btn-outline-secondary ims-btn-tertiary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary ims-btn-secondary" wire:loading.attr="disabled" wire:target="addNewRemark">
                                        <span wire:loading.remove wire:target="addNewRemark">Add Remark</span>
                                        <span wire:loading wire:target="addNewRemark"><i class="spinner-border spinner-border-sm me-2"></i>Processing...</span>
                                    </button>
                                </div>
                            </form>
                        </section>

                        <section class="ims-article-section-card ims-article-list-card">
                            <div class="ims-article-list-toolbar">
                                <div class="ims-article-list-title">
                                    <h6 class="mb-0 ims-article-section-title">Existing Remarks</h6>
                                    <span class="badge bg-light text-dark">{{ number_format($remarkTotal) }}</span>
                                </div>
                                <div class="input-group input-group-sm ims-article-search-group">
                                    <input type="text" class="form-control ims-article-search" placeholder="Search remarks..." wire:model.debounce.300ms="remarkSearch">
                                    <button type="button" class="btn btn-outline-secondary" wire:click="$set('remarkSearch','')" {{ $remarkSearch === '' ? 'disabled' : '' }}>Clear</button>
                                </div>
                            </div>

                            <div class="table-responsive ims-article-table-wrap">
                                <table class="table table-sm table-striped align-middle mb-0 ims-article-table">
                                    <thead>
                                        <tr>
                                            <th>Remark</th>
                                            <th class="text-end" style="width: 220px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($remarkResults as $remarkItem)
                                            <tr wire:key="remark-item-{{ $remarkItem->id }}" class="{{ (int) $editingRemarkId === (int) $remarkItem->id ? 'ims-article-edit-row' : ((int) $recentRemarkId === (int) $remarkItem->id ? 'ims-recent-row' : '') }}">
                                                <td>
                                                    @if((int) $editingRemarkId === (int) $remarkItem->id)
                                                        <input type="text" class="form-control form-control-sm @error('editingRemarkName') is-invalid @enderror" wire:model.defer="editingRemarkName">
                                                        @error('editingRemarkName')
                                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                                        @enderror
                                                    @else
                                                        <span class="fw-600">{{ $remarkItem->remark_name }}</span>
                                                    @endif
                                                </td>
                                                <td class="text-end ims-inline-actions">
                                                    @if((int) $editingRemarkId === (int) $remarkItem->id)
                                                        <button type="button" class="btn btn-success btn-sm" wire:click="saveEditRemark" wire:loading.attr="disabled" wire:target="saveEditRemark">
                                                            Save
                                                        </button>
                                                        <button type="button" class="btn btn-outline-secondary btn-sm" wire:click="cancelEditRemark" wire:loading.attr="disabled" wire:target="cancelEditRemark">
                                                            Cancel
                                                        </button>
                                                    @elseif((int) $confirmingRemarkDeleteId === (int) $remarkItem->id)
                                                        <span class="ims-inline-confirm-copy">Delete this remark?</span>
                                                        <button type="button" class="btn btn-danger btn-sm" wire:click.prevent="deleteRemark({{ $remarkItem->id }})" wire:loading.attr="disabled" wire:target="deleteRemark">
                                                            Confirm
                                                        </button>
                                                        <button type="button" class="btn btn-outline-secondary btn-sm" wire:click.prevent="cancelDeleteRemark" wire:loading.attr="disabled" wire:target="cancelDeleteRemark">
                                                            Cancel
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-primary btn-sm" wire:click.prevent="startEditRemark({{ $remarkItem->id }})" wire:loading.attr="disabled" wire:target="startEditRemark">
                                                            Edit
                                                        </button>
                                                        <button type="button" class="btn btn-danger btn-sm" wire:click.prevent="promptDeleteRemark({{ $remarkItem->id }})" wire:loading.attr="disabled" wire:target="promptDeleteRemark">
                                                            Delete
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="py-3">
                                                    <div class="ims-article-empty">
                                                        <i class="fa-solid fa-inbox"></i>
                                                        <span>No remarks found.</span>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
@include('livewire.admin.inventory-management.page-styles')
@endpush

@push('scripts')
@include('livewire.admin.inventory-management.page-scripts')
@endpush
