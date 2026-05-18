<?php

namespace App\Http\Livewire\Admin\InventoryManagement;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Models\InventoryManagement\Property;
use App\Models\InventoryManagement\article\ArticleName;
use App\Models\InventoryManagement\article\ArticleDescription;
use App\Models\InventoryManagement\article\Remark;
use App\Models\Admin\AdminPanel\Category\Office;
use App\Models\Admin\EMS\Employee;

class Index extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $pageName = 'inventoryPage';
    public $Search = '';
    public $perPage = 10;

    // Modal filter fields (temporary)
    public $modalOfficer = '';
    public $modalOfficerId = null;
    public $showModalDropdown = false; // Track dropdown visibility in filter modal
    public $modalDescription = '';
    public $modalUnitValueRange = '';
    public $modalDateFrom = null;
    public $modalRemarks = '';
    public $modalOffice = '';

    // Sorting
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    // Filters
    public $dateFrom = null;
    public $description = '';
    public $unitValueRange = '';
    public $remarks = '';
    public $office = '';
    public $officer = '';
    public $officerId = null;

    // Edit form state - all im_property fields
    public $editId = null;
    public $deleteId = null;
    public $edit_date_acquired = '';
    public $edit_article_id = '';
    public $edit_article_desc_id = '';
    public $edit_article_desc_text = '';
    public $edit_specification = '';
    public $edit_property_no = '';
    public $edit_unit_of_measurement = '';
    public $edit_unit_value = '';
    public $edit_quantity_per_card = '';
    public $edit_quantity_per_count = '';
    public $edit_remarks = '';
    public $edit_office = '';
    public $edit_accountable_officer = '';
    public $edit_uacs = '';
    public $edit_auto_suggested_uacs = '';
    public $edit_fund_cluster = '';
    public $edit_estimated_useful_life = '';

    // Article management modal properties
    public $new_article_name = '';
    public $new_article_ppe_uacs = '';
    public $new_article_semi_ex_uacs = '';
    public $new_article_id = '';
    public $new_article_description = '';
    public $articleSearch = '';
    public $articleDescriptionSearch = '';
    public $editingArticleId = null;
    public $editingArticleName = '';
    public $editingArticlePpeUacs = '';
    public $editingArticleSemiExUacs = '';
    public $confirmingArticleDeleteId = null;
    public $confirmingArticleDeleteName = '';
    public $editingDescriptionId = null;
    public $editingDescriptionText = '';
    public $editingDescriptionArticleId = null;
    public $confirmingDescriptionDeleteId = null;
    public $new_remark_name = '';
    public $remarkSearch = '';
    public $editingRemarkId = null;
    public $editingRemarkName = '';
    public $confirmingRemarkDeleteId = null;
    public $recentArticleId = null;
    public $recentDescriptionId = null;
    public $recentRemarkId = null;
    public $articles = [];

    // Lists for dropdowns
    public $OfficeLists = [];
    public $EmployeeLists = [];
    public $ArticleNameLists = [];
    public $ArticleDescriptionLists = [];
    public $RemarksList = [];

    // Allowed pagination sizes to prevent malformed values
    protected $allowedPerPage = [10, 25, 50, 100];
    protected $listeners = [
        'articleModalClosed' => 'resetArticleModalState',
        'ims-property-created' => 'refreshAfterPropertyCreate',
        'closeModalOfficerDropdown' => 'closeModalOfficerDropdown',
    ];

    protected $rules = [
        'edit_date_acquired'        => 'nullable|date',
        'edit_article_id'           => 'nullable|string|max:255',
        'edit_specification'        => 'nullable|string|max:255',
        'edit_property_no'          => 'nullable|string|max:255',
        'edit_unit_of_measurement'  => 'nullable|string|max:255',
        'edit_unit_value'           => 'nullable|numeric|min:0',
        'edit_quantity_per_card'    => 'nullable|numeric|min:0',
        'edit_quantity_per_count'   => 'nullable|numeric|min:0',
        'edit_remarks'              => 'nullable|string|max:255',
        'edit_office'               => 'nullable|string|max:255',
        'edit_accountable_officer'  => 'nullable|string|max:255',
        'edit_uacs'                 => 'nullable|string|max:255',
        'edit_fund_cluster'         => 'nullable|string|max:255',
        'edit_estimated_useful_life'=> 'nullable|string|max:255',
        'edit_article_desc_id'      => 'nullable|integer|exists:im_article_description,id',
        'edit_article_desc_text'    => 'nullable|string|max:255',
    ];

    public function mount()
    {
        $this->authorize('viewAny', Property::class);
        $this->normalizePerPage();
        $this->OfficeLists = Office::orderBy('office', 'asc')->get();
        $this->EmployeeLists = Employee::where('empstatus', '=', 'PERMANENT')
            ->where('is_retired', false)
            ->orderBy('firstname', 'asc')
            ->get();
        $this->reloadArticleNameLists();
        $this->reloadRemarksList();
        $this->syncFilterModal();
    }

    public function updatingSearch()
    {
        $this->gotoPage(1, $this->pageName);
    }

    public function updatedPerPage()
    {
        $this->normalizePerPage();
        $this->gotoPage(1, $this->pageName);
    }

    public function updatingDateFrom()
    {
        $this->gotoPage(1, $this->pageName);
    }

    public function editProperty($id)
    {
        $p = Property::findOrFail($id);

        $this->editId                      = $p->id;
        $this->edit_date_acquired          = $p->date_acquired;
        $this->edit_article_id             = $p->article_id;
        $this->edit_specification          = $p->specification;
        $this->edit_property_no            = $p->property_no;
        $this->edit_unit_of_measurement    = $p->unit_of_measurement;
        $this->edit_unit_value             = $p->unit_value;
        $this->edit_quantity_per_card      = $p->quantity_per_card;
        $this->edit_quantity_per_count     = $p->quantity_per_count;
        $this->edit_remarks                = $p->remarks;
        $this->edit_office                 = $p->office;
        $this->edit_accountable_officer    = $p->accountable_officer;
        $resolvedUacs = $p->uacs ?: $this->resolveArticleMappedUacs($p->article_id, $p->unit_value);
        $this->edit_uacs                   = $resolvedUacs;
        $this->edit_fund_cluster           = $p->fund_cluster ?? '';
        $this->edit_estimated_useful_life  = $p->estimated_useful_life ?? '';
        $this->edit_auto_suggested_uacs    = $resolvedUacs;

        // load descriptions list for selected article
        $this->ArticleDescriptionLists = ArticleDescription::where('article_id', $this->edit_article_id)->orderBy('article_description','asc')->get();

        // set current description id/text if exists
        $this->edit_article_desc_id = $p->article_description;
        $currentDesc = ArticleDescription::find($this->edit_article_desc_id);
        $this->edit_article_desc_text = $currentDesc ? $currentDesc->article_description : '';

        $this->dispatchBrowserEvent('show-edit-property-modal');
    }

    // When article changes in modal, refresh description list
    public function updatedEditArticleId($articleId)
    {
        $this->ArticleDescriptionLists = ArticleDescription::where('article_id', $articleId)->orderBy('article_description','asc')->get();
        // reset selected description
        $this->edit_article_desc_id = '';
        $this->edit_article_desc_text = '';
        $this->syncEditArticleUacsSuggestion();
    }

    public function updatedEditUnitValue($value): void
    {
        $this->edit_unit_value = $this->normalizeNumericValue($value);
        $this->syncEditArticleUacsSuggestion();
    }

    public function updateProperty()
    {
        $this->edit_unit_value = $this->normalizeNumericValue($this->edit_unit_value);
        $this->syncEditArticleUacsSuggestion();
        $this->validate();

        $p = Property::findOrFail($this->editId);
        $this->authorize('update', $p);
        $this->edit_specification = $this->normalizeText($this->edit_specification);
        $this->edit_property_no = $this->normalizeText($this->edit_property_no);
        $this->edit_unit_of_measurement = $this->normalizeText($this->edit_unit_of_measurement);
        $this->edit_fund_cluster = $this->normalizeText($this->edit_fund_cluster);
        $this->edit_estimated_useful_life = $this->normalizeText($this->edit_estimated_useful_life);

        $p->date_acquired           = $this->edit_date_acquired;
        $p->article_id              = $this->edit_article_id;
        // Always persist the selected description id (or null when cleared)
        $p->article_description     = $this->edit_article_desc_id ?: null;
        $p->specification           = $this->edit_specification;
        $p->property_no             = $this->edit_property_no ?: null;
        $p->unit_of_measurement     = $this->edit_unit_of_measurement ?: null;
        $p->unit_value              = $this->edit_unit_value;
        $p->quantity_per_card       = $this->edit_quantity_per_card !== '' ? $this->edit_quantity_per_card : null;
        $p->quantity_per_count      = $this->edit_quantity_per_count !== '' ? $this->edit_quantity_per_count : null;
        $p->remarks                 = $this->edit_remarks;
        $p->office                  = $this->edit_office;
        $p->accountable_officer     = $this->edit_accountable_officer;
        $p->uacs                    = $this->edit_uacs ?: null;
        $p->fund_cluster            = $this->edit_fund_cluster ?: null;
        $p->estimated_useful_life   = $this->edit_estimated_useful_life ?: null;
        $p->save();

        $this->resetEditState();
        $this->resetValidation();
        $this->dispatchBrowserEvent('hide-edit-property-modal');
        session()->flash('message', 'Property updated successfully.');
    }

    public function sortBy($field)
    {
        $allowed = [
            'id',
            'article_id',
            'article_description',
            'property_no',
            'unit_value',
            'remarks',
            'accountable_officer',
            'date_acquired',
        ];

        if (! in_array($field, $allowed, true)) {
            return;
        }

        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }

        $this->gotoPage(1, $this->pageName);
    }

    public function clearFilters()
    {
        $this->resetModalFilterState();
        $this->showModalDropdown = false;
        $this->dispatchBrowserEvent('filters-cleared');
    }

    public function applyFilters()
    {
        // Copy modal values to active filters
        $this->Search = '';
        $this->officer = trim((string) $this->modalOfficer);
        $this->officerId = $this->modalOfficerId ? (int) $this->modalOfficerId : null;
        if ($this->officer === '') {
            $this->officerId = null;
        }
        $this->description = $this->modalDescription;
        $this->unitValueRange = $this->modalUnitValueRange;
        $this->dateFrom = $this->modalDateFrom;
        $this->remarks = $this->modalRemarks;
        $this->office = $this->modalOffice;

        $this->showModalDropdown = false;
        $this->gotoPage(1, $this->pageName);
        $this->dispatchBrowserEvent('filters-applied');
    }

    public function syncFilterModal()
    {
        $this->modalOfficer = $this->officer;
        $this->modalOfficerId = $this->officerId;
        $this->modalDescription = $this->description;
        $this->modalUnitValueRange = $this->unitValueRange;
        $this->modalDateFrom = $this->dateFrom;
        $this->modalRemarks = $this->remarks;
        $this->modalOffice = $this->office;
    }

    public function resetToFirstPage()
    {
        $this->resetFilterState();
        $this->syncFilterModal();
        $this->showModalDropdown = false;
        $this->gotoPage(1, $this->pageName);
    }

    // Open Filters modal using current active filters
    public function openFilterModal()
    {
        $this->syncFilterModal();
        $this->showModalDropdown = false;
        $this->dispatchBrowserEvent('filters-modal-opened');
    }

    public function closeModalOfficerDropdown(): void
    {
        $this->showModalDropdown = false;
    }

    public function selectModalOfficer($employeeId): void
    {
        $employee = $this->EmployeeLists->firstWhere('id', (int) $employeeId);
        if (! $employee) {
            return;
        }

        $this->modalOfficerId = (int) $employee->id;
        $this->modalOfficer = $this->formatEmployeeName($employee);
        $this->showModalDropdown = false;
    }

    public function clearModalOfficerSearch(): void
    {
        $this->modalOfficer = '';
        $this->modalOfficerId = null;
        $this->showModalDropdown = false;
    }

    public function updatedModalOfficer($value): void
    {
        $normalized = trim((string) $value);
        if ($normalized === '') {
            $this->modalOfficerId = null;
            $this->showModalDropdown = false;
            return;
        }

        if ($this->modalOfficerId) {
            $selected = $this->EmployeeLists->firstWhere('id', (int) $this->modalOfficerId);
            if (! $selected || Str::lower($this->formatEmployeeName($selected)) !== Str::lower($normalized)) {
                $this->modalOfficerId = null;
            }
        }

        $this->showModalDropdown = true;
    }

    public function updatedModalOffice($value): void
    {
        if ($value === '' || ! $this->modalOfficerId) {
            return;
        }

        $selected = $this->EmployeeLists->firstWhere('id', (int) $this->modalOfficerId);
        if (! $selected || (string) $selected->officeid !== (string) $value) {
            $this->clearModalOfficerSearch();
        }
    }

    public function resetArticleModalState(): void
    {
        $this->new_article_name = '';
        $this->new_article_ppe_uacs = '';
        $this->new_article_semi_ex_uacs = '';
        $this->new_article_id = '';
        $this->new_article_description = '';
        $this->new_remark_name = '';
        $this->articleSearch = '';
        $this->articleDescriptionSearch = '';
        $this->remarkSearch = '';
        $this->recentArticleId = null;
        $this->recentDescriptionId = null;
        $this->recentRemarkId = null;
        $this->resetArticleEditState();
        $this->resetDescriptionEditState();
        $this->resetRemarkEditState();
        $this->resetValidation([
            'new_article_name',
            'new_article_ppe_uacs',
            'new_article_semi_ex_uacs',
            'new_article_id',
            'new_article_description',
            'new_remark_name',
            'editingArticleName',
            'editingArticlePpeUacs',
            'editingArticleSemiExUacs',
            'editingDescriptionText',
            'editingRemarkName',
        ]);
    }

    public function refreshAfterPropertyCreate(): void
    {
        $this->gotoPage(1, $this->pageName);
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->dispatchBrowserEvent('show-delete-property-modal');
    }

    public function deleteProperty()
    {
        if ($this->deleteId) {
            $property = Property::find($this->deleteId);
            if ($property) {
                $this->authorize('delete', $property);
                $property->delete();
                session()->flash('message', 'Property deleted successfully.');
            }
            $this->deleteId = null;
            $this->gotoPage(1, $this->pageName);
            $this->dispatchBrowserEvent('hide-delete-property-modal');
        }
    }

    public function render()
    {
        $query = Property::with(['ArticleName','ArticleDescription','Employee','Office'])
            ->when($this->officerId !== null && $this->officerId !== '', function ($q) {
                $q->where('accountable_officer', (int) $this->officerId);
            })
            ->when(($this->officerId === null || $this->officerId === '') && $this->officer !== '', function ($q) {
                $term = '%' . $this->officer . '%';
                $q->whereHas('Employee', function ($employeeQuery) use ($term) {
                    $employeeQuery->where('firstname', 'like', $term)
                        ->orWhere('middlename', 'like', $term)
                        ->orWhere('lastname', 'like', $term)
                        ->orWhereRaw("CONCAT_WS(' ', firstname, middlename, lastname) like ?", [$term]);
                });
            })
            ->when($this->description !== '', function ($q) {
                $q->where('article_description', (string) $this->description);
            })
            ->when($this->dateFrom, function ($q) {
                $q->whereDate('date_acquired', '=', $this->dateFrom);
            })
            ->when($this->unitValueRange === 'below_50k', function ($q) {
                $q->where('unit_value', '<', 50000);
            })
            // Keep legacy range values for compatibility, but treat PPE/Plants as one category.
            ->when(in_array($this->unitValueRange, ['ppe_50k_and_above', 'exact_50k', 'above_50k'], true), function ($q) {
                $q->where('unit_value', '>=', 50000);
            })
            ->when($this->remarks, function ($q) {
                $q->where('remarks', 'like', '%' . $this->remarks . '%');
            })
            ->when($this->office, function ($q) {
                $q->where('office', $this->office);
            });

        $filteredCount = (clone $query)->count();
        $totalUnitValue = (clone $query)->sum('unit_value');
        $totalCountAll = Property::count();

        $properties = $query
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage, ['*'], $this->pageName);

        $descriptionFilterOptions = ArticleDescription::with('ArticleName:id,article_name')
            ->orderBy('article_description', 'asc')
            ->get(['id', 'article_id', 'article_description']);

        $articleNameResults = ArticleName::query()
            ->when($this->articleSearch !== '', function ($q) {
                $q->where('article_name', 'like', '%' . $this->articleSearch . '%');
            })
            ->when($this->recentArticleId, function ($q) {
                $q->orderByRaw('CASE WHEN id = ? THEN 0 ELSE 1 END', [(int) $this->recentArticleId]);
            })
            ->orderBy('article_name', 'asc')
            ->limit(25)
            ->get();
        $articleNameTotal = ArticleName::count();

        $articleDescriptionResults = ArticleDescription::with('ArticleName')
            ->when($this->articleDescriptionSearch !== '', function ($q) {
                $term = '%' . $this->articleDescriptionSearch . '%';
                $q->where(function ($inner) use ($term) {
                    $inner->where('article_description', 'like', $term)
                        ->orWhereHas('ArticleName', function ($articleQuery) use ($term) {
                            $articleQuery->where('article_name', 'like', $term);
                        });
                });
            })
            ->when($this->recentDescriptionId, function ($q) {
                $q->orderByRaw('CASE WHEN id = ? THEN 0 ELSE 1 END', [(int) $this->recentDescriptionId]);
            })
            ->orderBy('article_description', 'asc')
            ->limit(25)
            ->get();
        $articleDescriptionTotal = ArticleDescription::count();

        $remarkResults = Remark::query()
            ->when($this->remarkSearch !== '', function ($q) {
                $q->where('remark_name', 'like', '%' . $this->remarkSearch . '%');
            })
            ->when($this->recentRemarkId, function ($q) {
                $q->orderByRaw('CASE WHEN id = ? THEN 0 ELSE 1 END', [(int) $this->recentRemarkId]);
            })
            ->orderBy('remark_name', 'asc')
            ->limit(25)
            ->get();
        $remarkTotal = Remark::count();

        return view('livewire.admin.inventory-management.index', compact(
            'properties',
            'filteredCount',
            'totalUnitValue',
            'totalCountAll',
            'descriptionFilterOptions',
            'articleNameResults',
            'articleDescriptionResults',
            'articleNameTotal',
            'articleDescriptionTotal',
            'remarkResults',
            'remarkTotal'
        ));
    }

    private function resetFilterState()
    {
        $this->Search = '';
        $this->officer = '';
        $this->officerId = null;
        $this->description = '';
        $this->unitValueRange = '';
        $this->dateFrom = null;
        $this->remarks = '';
        $this->office = '';
    }

    private function resetModalFilterState(): void
    {
        $this->modalOffice = '';
        $this->modalOfficer = '';
        $this->modalOfficerId = null;
        $this->modalDescription = '';
        $this->modalRemarks = '';
        $this->modalDateFrom = null;
        $this->modalUnitValueRange = '';
    }

    private function normalizePerPage()
    {
        $this->perPage = (int) $this->perPage;
        if (! in_array($this->perPage, $this->allowedPerPage, true)) {
            $this->perPage = 10;
        }
    }

    private function resetEditState()
    {
        $this->editId = null;
        $this->edit_date_acquired = '';
        $this->edit_article_id = '';
        $this->edit_article_desc_id = '';
        $this->edit_article_desc_text = '';
        $this->edit_specification = '';
        $this->edit_property_no = '';
        $this->edit_unit_of_measurement = '';
        $this->edit_unit_value = '';
        $this->edit_quantity_per_card = '';
        $this->edit_quantity_per_count = '';
        $this->edit_remarks = '';
        $this->edit_office = '';
        $this->edit_accountable_officer = '';
        $this->edit_uacs = '';
        $this->edit_auto_suggested_uacs = '';
        $this->edit_fund_cluster = '';
        $this->edit_estimated_useful_life = '';
    }

    private function normalizeText(?string $value): string
    {
        $value = trim((string) $value);
        if ($value === '') {
            return '';
        }

        return preg_replace('/\s+/u', ' ', $value) ?? '';
    }

    private function formatEmployeeName($employee): string
    {
        return trim(collect([
            $employee->firstname ?? null,
            $employee->middlename ?? null,
            $employee->lastname ?? null,
        ])->filter()->implode(' '));
    }

    public function getModalOfficerOptionsProperty()
    {
        $searchTerm = Str::lower(trim((string) $this->modalOfficer));
        $officeId = $this->modalOffice;

        return $this->EmployeeLists
            ->filter(function ($employee) use ($searchTerm, $officeId) {
                if ($officeId !== '' && (string) $employee->officeid !== (string) $officeId) {
                    return false;
                }

                if ($searchTerm === '') {
                    return true;
                }

                return str_contains(Str::lower($this->formatEmployeeName($employee)), $searchTerm);
            })
            ->take(30)
            ->values();
    }

    public function getModalOfficerExactMatchProperty(): bool
    {
        $searchTerm = Str::lower(trim((string) $this->modalOfficer));
        if ($searchTerm === '') {
            return false;
        }

        return $this->modalOfficerOptions->contains(function ($employee) use ($searchTerm) {
            return Str::lower($this->formatEmployeeName($employee)) === $searchTerm;
        });
    }

    private function reloadArticleNameLists(): void
    {
        $articleNames = ArticleName::orderBy('article_name', 'asc')->get();
        $this->articles = $articleNames;
        $this->ArticleNameLists = $articleNames;
    }

    private function reloadArticleDescriptionListsForSelectedArticle(): void
    {
        if (! $this->edit_article_id) {
            return;
        }

        $this->ArticleDescriptionLists = ArticleDescription::where('article_id', $this->edit_article_id)
            ->orderBy('article_description', 'asc')
            ->get();
    }

    private function resetArticleEditState(): void
    {
        $this->editingArticleId = null;
        $this->editingArticleName = '';
        $this->editingArticlePpeUacs = '';
        $this->editingArticleSemiExUacs = '';
        $this->confirmingArticleDeleteId = null;
        $this->confirmingArticleDeleteName = '';
    }

    private function resetDescriptionEditState(): void
    {
        $this->editingDescriptionId = null;
        $this->editingDescriptionText = '';
        $this->editingDescriptionArticleId = null;
        $this->confirmingDescriptionDeleteId = null;
    }

    private function resetRemarkEditState(): void
    {
        $this->editingRemarkId = null;
        $this->editingRemarkName = '';
        $this->confirmingRemarkDeleteId = null;
    }

    private function articleNameExists(string $normalizedName, ?int $ignoreId = null): bool
    {
        $query = ArticleName::query()
            ->whereRaw('LOWER(TRIM(article_name)) = ?', [Str::lower($normalizedName)]);

        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        return $query->exists();
    }

    private function articleDescriptionExists(string $articleId, string $normalizedDescription, ?int $ignoreId = null): bool
    {
        $query = ArticleDescription::query()
            ->where('article_id', $articleId)
            ->whereRaw('LOWER(TRIM(article_description)) = ?', [Str::lower($normalizedDescription)]);

        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        return $query->exists();
    }

    private function reloadRemarksList(): void
    {
        $this->RemarksList = Remark::orderBy('remark_name', 'asc')->get();
    }

    private function normalizeNumericValue($value): ?float
    {
        if ($value === null || $value === '') {
            return null;
        }

        $normalized = str_replace(',', '', (string) $value);
        if (! is_numeric($normalized)) {
            return null;
        }

        return (float) $normalized;
    }

    private function resolveArticleMappedUacs($articleId, $unitValue): string
    {
        $articleId = (int) $articleId;
        $unitValue = $this->normalizeNumericValue($unitValue);

        if ($articleId <= 0 || $unitValue === null) {
            return '';
        }

        $article = ArticleName::query()->select('ppe_uacs', 'semi_ex_uacs')->find($articleId);
        if (! $article) {
            return '';
        }

        $mappedUacs = $unitValue >= 50000
            ? ($article->ppe_uacs ?? '')
            : ($article->semi_ex_uacs ?? '');

        return $this->normalizeText($mappedUacs);
    }

    public function displayPropertyUacs(Property $property): string
    {
        $storedUacs = $this->normalizeText($property->uacs ?? '');
        if ($storedUacs !== '') {
            return $storedUacs;
        }

        $resolvedUacs = $this->resolveArticleMappedUacs($property->article_id, $property->unit_value);

        return $resolvedUacs !== '' ? $resolvedUacs : 'N/A';
    }

    private function syncEditArticleUacsSuggestion(): void
    {
        $suggestedUacs = $this->resolveArticleMappedUacs($this->edit_article_id, $this->edit_unit_value);
        $this->edit_uacs = $suggestedUacs;
        $this->edit_auto_suggested_uacs = $suggestedUacs;
    }

    private function remarkExists(string $normalizedName, ?int $ignoreId = null): bool
    {
        $query = Remark::query()
            ->whereRaw('LOWER(TRIM(remark_name)) = ?', [Str::lower($normalizedName)]);

        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        return $query->exists();
    }

    private function isDuplicateKeyException(QueryException $exception): bool
    {
        $sqlState = $exception->errorInfo[0] ?? null;
        $driverCode = (int) ($exception->errorInfo[1] ?? 0);

        return $sqlState === '23000' || $driverCode === 1062;
    }

    private function keepArticleModalOpen(string $tab, ?string $focusEvent = null): void
    {
        $this->dispatchBrowserEvent('ims-keep-article-modal-open', ['tab' => $tab]);

        if ($focusEvent) {
            $this->dispatchBrowserEvent($focusEvent);
        }
    }


    // Article management methods
    public function addNewArticle()
    {
        $this->authorize('create', ArticleName::class);
        $this->new_article_name = $this->normalizeText($this->new_article_name);
        $this->new_article_ppe_uacs = $this->normalizeText($this->new_article_ppe_uacs);
        $this->new_article_semi_ex_uacs = $this->normalizeText($this->new_article_semi_ex_uacs);

        if ($this->new_article_name !== '' && $this->articleNameExists($this->new_article_name)) {
            $this->addError('new_article_name', 'Article Name already exists');
            return;
        }

        $this->validate([
            'new_article_name' => 'required|string|max:255|unique:im_article_name,article_name',
            'new_article_ppe_uacs' => 'nullable|string|max:255',
            'new_article_semi_ex_uacs' => 'nullable|string|max:255',
        ], [
            'new_article_name.required' => 'Article Name is required',
            'new_article_name.unique' => 'Article Name already exists',
        ]);

        $article = new ArticleName();
        $article->article_name = $this->new_article_name;
        $article->ppe_uacs = $this->new_article_ppe_uacs ?: null;
        $article->semi_ex_uacs = $this->new_article_semi_ex_uacs ?: null;

        if ($article->save()) {
            $this->new_article_id = (string) $article->id;
            $this->new_article_name = '';
            $this->new_article_ppe_uacs = '';
            $this->new_article_semi_ex_uacs = '';
            $this->articleSearch = '';
            $this->recentArticleId = (int) $article->id;
            $this->resetValidation(['new_article_name', 'new_article_ppe_uacs', 'new_article_semi_ex_uacs']);
            $this->reloadArticleNameLists();
            $this->reloadArticleDescriptionListsForSelectedArticle();
            $this->emit('ims-article-name-updated', $article->id);
            $this->keepArticleModalOpen('add_article_tab', 'ims-focus-article-create-input');
            $this->dispatchBrowserEvent('showToastr', [
                'type' => 'success',
                'message' => 'Article added successfully!'
            ]);
        }
    }

    public function addNewArticleDescription()
    {
        $this->authorize('create', ArticleDescription::class);
        $this->new_article_description = $this->normalizeText($this->new_article_description);

        if ($this->new_article_id !== '' && $this->new_article_description !== '' &&
            $this->articleDescriptionExists((string) $this->new_article_id, $this->new_article_description)) {
            $this->addError('new_article_description', 'Article Description already exists for this article');
            return;
        }

        $this->validate([
            'new_article_id' => 'required|integer|exists:im_article_name,id',
            'new_article_description' => [
                'required',
                'string',
                'max:255',
                Rule::unique('im_article_description', 'article_description')
                    ->where(fn ($query) => $query->where('article_id', (string) $this->new_article_id)),
            ],
        ], [
            'new_article_id.required' => 'Article Name is required',
            'new_article_id.exists' => 'Selected article is invalid',
            'new_article_description.required' => 'Article Description is required',
            'new_article_description.unique' => 'Article Description already exists for this article',
        ]);

        $description = new ArticleDescription();
        $description->article_id = (string) $this->new_article_id;
        $description->article_description = $this->new_article_description;
        
        if ($description->save()) {
            $this->new_article_description = '';
            $this->articleDescriptionSearch = '';
            $this->recentDescriptionId = (int) $description->id;
            $this->resetValidation(['new_article_id', 'new_article_description']);
            $this->reloadArticleDescriptionListsForSelectedArticle();
            $this->emit('ims-article-description-updated', (int) $description->article_id);
            $this->keepArticleModalOpen('add_description_tab', 'ims-focus-description-input');
            $this->dispatchBrowserEvent('showToastr', [
                'type' => 'success',
                'message' => 'Article Description added successfully!'
            ]);
        }
    }

    public function startEditArticle($id): void
    {
        $article = ArticleName::findOrFail($id);
        $this->authorize('create', ArticleName::class);

        $this->confirmingArticleDeleteId = null;
        $this->editingArticleId = $article->id;
        $this->editingArticleName = $article->article_name;
        $this->editingArticlePpeUacs = $article->ppe_uacs ?? '';
        $this->editingArticleSemiExUacs = $article->semi_ex_uacs ?? '';
        $this->resetValidation(['editingArticleName', 'editingArticlePpeUacs', 'editingArticleSemiExUacs']);
        $this->dispatchBrowserEvent('ims-focus-article-edit-input');
    }

    public function promptDeleteArticle($id): void
    {
        $article = ArticleName::findOrFail($id);

        $this->confirmingArticleDeleteId = (int) $article->id;
        $this->confirmingArticleDeleteName = $article->article_name;
        $this->editingArticleId = null;
    }

    public function cancelDeleteArticle(): void
    {
        $this->confirmingArticleDeleteId = null;
        $this->confirmingArticleDeleteName = '';
    }

    public function saveEditArticle(): void
    {
        if (! $this->editingArticleId) {
            return;
        }

        $article = ArticleName::findOrFail($this->editingArticleId);
        $this->authorize('create', ArticleName::class);
        $this->editingArticleName = $this->normalizeText($this->editingArticleName);
        $this->editingArticlePpeUacs = $this->normalizeText($this->editingArticlePpeUacs);
        $this->editingArticleSemiExUacs = $this->normalizeText($this->editingArticleSemiExUacs);

        if ($this->editingArticleName !== '' && $this->articleNameExists($this->editingArticleName, (int) $article->id)) {
            $this->addError('editingArticleName', 'Article Name already exists');
            return;
        }

        $this->validate([
            'editingArticleName' => [
                'required',
                'string',
                'max:255',
                Rule::unique('im_article_name', 'article_name')->ignore($article->id),
            ],
            'editingArticlePpeUacs' => 'nullable|string|max:255',
            'editingArticleSemiExUacs' => 'nullable|string|max:255',
        ], [
            'editingArticleName.required' => 'Article Name is required',
            'editingArticleName.unique' => 'Article Name already exists',
        ]);

        $article->article_name = $this->editingArticleName;
        $article->ppe_uacs = $this->editingArticlePpeUacs ?: null;
        $article->semi_ex_uacs = $this->editingArticleSemiExUacs ?: null;
        $article->save();

        $this->articleSearch = '';
        $this->recentArticleId = null;
        $this->reloadArticleNameLists();
        $this->emit('ims-article-name-updated', $article->id);
        $this->resetArticleEditState();
        $this->resetValidation(['editingArticleName', 'editingArticlePpeUacs', 'editingArticleSemiExUacs']);
        $this->keepArticleModalOpen('add_article_tab', 'ims-focus-article-create-input');
        $this->dispatchBrowserEvent('showToastr', [
            'type' => 'success',
            'message' => 'Article updated successfully!'
        ]);
    }

    public function cancelEditArticle(): void
    {
        $this->resetArticleEditState();
        $this->resetValidation(['editingArticleName', 'editingArticlePpeUacs', 'editingArticleSemiExUacs']);
        $this->keepArticleModalOpen('add_article_tab');
    }

    public function deleteArticle($id): void
    {
        $article = ArticleName::findOrFail($id);
        $this->authorize('delete', $article);

        $hasDescriptions = ArticleDescription::where('article_id', (string) $article->id)->exists();
        $hasProperties = Property::where('article_id', $article->id)->exists();
        if ($hasDescriptions || $hasProperties) {
            $this->confirmingArticleDeleteId = null;
            $this->confirmingArticleDeleteName = '';
            $this->keepArticleModalOpen('add_article_tab');
            $this->dispatchBrowserEvent('showToastr', [
                'type' => 'error',
                'message' => 'Cannot delete article that is already in use.'
            ]);
            return;
        }

        $article->delete();

        if ((string) $this->new_article_id === (string) $id) {
            $this->new_article_id = '';
        }
        if ((int) $this->recentArticleId === (int) $id) {
            $this->recentArticleId = null;
        }
        $this->confirmingArticleDeleteId = null;
        $this->confirmingArticleDeleteName = '';
        if ((int) $this->editingArticleId === (int) $id) {
            $this->resetArticleEditState();
        }

        $this->reloadArticleNameLists();
        $this->emit('ims-article-name-updated');
        $this->keepArticleModalOpen('add_article_tab', 'ims-focus-article-create-input');
        $this->dispatchBrowserEvent('showToastr', [
            'type' => 'success',
            'message' => 'Article deleted successfully!'
        ]);
    }

    public function startEditArticleDescription($id): void
    {
        $description = ArticleDescription::findOrFail($id);
        $this->authorize('create', ArticleDescription::class);

        $this->confirmingDescriptionDeleteId = null;
        $this->editingDescriptionId = $description->id;
        $this->editingDescriptionArticleId = (string) $description->article_id;
        $this->editingDescriptionText = $description->article_description;
        $this->resetValidation(['editingDescriptionText']);
        $this->dispatchBrowserEvent('ims-focus-description-edit-input');
    }

    public function promptDeleteArticleDescription($id): void
    {
        $this->confirmingDescriptionDeleteId = (int) $id;
        $this->editingDescriptionId = null;
    }

    public function cancelDeleteArticleDescription(): void
    {
        $this->confirmingDescriptionDeleteId = null;
    }

    public function saveEditArticleDescription(): void
    {
        if (! $this->editingDescriptionId) {
            return;
        }

        $description = ArticleDescription::findOrFail($this->editingDescriptionId);
        $this->authorize('create', ArticleDescription::class);
        $this->editingDescriptionText = $this->normalizeText($this->editingDescriptionText);

        if ($this->editingDescriptionText !== '' &&
            $this->articleDescriptionExists((string) $this->editingDescriptionArticleId, $this->editingDescriptionText, (int) $description->id)) {
            $this->addError('editingDescriptionText', 'Article Description already exists for this article');
            return;
        }

        $this->validate([
            'editingDescriptionText' => [
                'required',
                'string',
                'max:255',
                Rule::unique('im_article_description', 'article_description')
                    ->ignore($description->id)
                    ->where(fn ($query) => $query->where('article_id', (string) $this->editingDescriptionArticleId)),
            ],
        ], [
            'editingDescriptionText.required' => 'Article Description is required',
            'editingDescriptionText.unique' => 'Article Description already exists for this article',
        ]);

        $description->article_description = $this->editingDescriptionText;
        $description->save();

        $this->articleDescriptionSearch = '';
        $this->recentDescriptionId = (int) $description->id;
        $this->reloadArticleDescriptionListsForSelectedArticle();
        $this->emit('ims-article-description-updated', (int) $description->article_id);
        $this->resetDescriptionEditState();
        $this->resetValidation(['editingDescriptionText']);
        $this->keepArticleModalOpen('add_description_tab', 'ims-focus-description-input');
        $this->dispatchBrowserEvent('showToastr', [
            'type' => 'success',
            'message' => 'Article Description updated successfully!'
        ]);
    }

    public function cancelEditArticleDescription(): void
    {
        $this->resetDescriptionEditState();
        $this->resetValidation(['editingDescriptionText']);
    }

    public function deleteArticleDescription($id): void
    {
        $description = ArticleDescription::findOrFail($id);
        $this->authorize('delete', $description);

        $hasProperties = Property::where('article_description', $description->id)->exists();
        if ($hasProperties) {
            $this->dispatchBrowserEvent('showToastr', [
                'type' => 'error',
                'message' => 'Cannot delete description that is already assigned to properties.'
            ]);
            return;
        }

        $articleId = (int) $description->article_id;
        $description->delete();

        if ((int) $this->recentDescriptionId === (int) $id) {
            $this->recentDescriptionId = null;
        }
        $this->confirmingDescriptionDeleteId = null;
        if ((int) $this->editingDescriptionId === (int) $id) {
            $this->resetDescriptionEditState();
        }

        $this->reloadArticleDescriptionListsForSelectedArticle();
        $this->emit('ims-article-description-updated', $articleId);
        $this->dispatchBrowserEvent('showToastr', [
            'type' => 'success',
            'message' => 'Article Description deleted successfully!'
        ]);
    }

    public function addNewRemark(): void
    {
        $this->authorize('create', Property::class);
        $this->new_remark_name = $this->normalizeText($this->new_remark_name);

        if ($this->new_remark_name !== '' && $this->remarkExists($this->new_remark_name)) {
            $this->addError('new_remark_name', 'Remark already exists');
            return;
        }

        $this->validate([
            'new_remark_name' => 'required|string|max:100',
        ], [
            'new_remark_name.required' => 'Remark is required',
            'new_remark_name.max' => 'Remark must not exceed 100 characters',
        ]);

        $remark = new Remark();
        $remark->remark_name = $this->new_remark_name;

        try {
            $remark->save();
        } catch (QueryException $exception) {
            if ($this->isDuplicateKeyException($exception)) {
                $this->addError('new_remark_name', 'Remark already exists');
                return;
            }

            throw $exception;
        }

        $this->new_remark_name = '';
        $this->remarkSearch = '';
        $this->recentRemarkId = (int) $remark->id;
        $this->resetValidation(['new_remark_name']);
        $this->reloadRemarksList();
        $this->emit('ims-remarks-updated');
        $this->keepArticleModalOpen('manage_remarks_tab', 'ims-focus-remark-create-input');
        $this->dispatchBrowserEvent('showToastr', [
            'type' => 'success',
            'message' => 'Remark added successfully!'
        ]);
    }

    public function startEditRemark($id): void
    {
        $this->authorize('create', Property::class);
        $remark = Remark::findOrFail($id);
        $this->confirmingRemarkDeleteId = null;
        $this->editingRemarkId = $remark->id;
        $this->editingRemarkName = $remark->remark_name;
        $this->resetValidation(['editingRemarkName']);
        $this->dispatchBrowserEvent('ims-focus-remark-edit-input');
    }

    public function promptDeleteRemark($id): void
    {
        $this->confirmingRemarkDeleteId = (int) $id;
        $this->editingRemarkId = null;
    }

    public function cancelDeleteRemark(): void
    {
        $this->confirmingRemarkDeleteId = null;
    }

    public function saveEditRemark(): void
    {
        if (! $this->editingRemarkId) {
            return;
        }

        $this->authorize('create', Property::class);
        $remark = Remark::findOrFail($this->editingRemarkId);
        $this->editingRemarkName = $this->normalizeText($this->editingRemarkName);

        if ($this->editingRemarkName !== '' && $this->remarkExists($this->editingRemarkName, (int) $remark->id)) {
            $this->addError('editingRemarkName', 'Remark already exists');
            return;
        }

        $this->validate([
            'editingRemarkName' => 'required|string|max:100',
        ], [
            'editingRemarkName.required' => 'Remark is required',
            'editingRemarkName.max' => 'Remark must not exceed 100 characters',
        ]);

        $remark->remark_name = $this->editingRemarkName;
        try {
            $remark->save();
        } catch (QueryException $exception) {
            if ($this->isDuplicateKeyException($exception)) {
                $this->addError('editingRemarkName', 'Remark already exists');
                return;
            }

            throw $exception;
        }

        $this->remarkSearch = '';
        $this->recentRemarkId = (int) $remark->id;
        $this->reloadRemarksList();
        $this->resetRemarkEditState();
        $this->resetValidation(['editingRemarkName']);
        $this->emit('ims-remarks-updated');
        $this->keepArticleModalOpen('manage_remarks_tab', 'ims-focus-remark-create-input');
        $this->dispatchBrowserEvent('showToastr', [
            'type' => 'success',
            'message' => 'Remark updated successfully!'
        ]);
    }

    public function cancelEditRemark(): void
    {
        $this->resetRemarkEditState();
        $this->resetValidation(['editingRemarkName']);
    }

    public function deleteRemark($id): void
    {
        $this->authorize('create', Property::class);
        $remark = Remark::findOrFail($id);
        $normalizedRemarkName = Str::lower($this->normalizeText($remark->remark_name));

        $isInUse = Property::whereRaw('LOWER(TRIM(remarks)) = ?', [$normalizedRemarkName])->exists();
        if ($isInUse) {
            $this->dispatchBrowserEvent('showToastr', [
                'type' => 'error',
                'message' => 'Cannot delete remark that is already used by properties.'
            ]);
            return;
        }

        $remark->delete();

        if ((int) $this->recentRemarkId === (int) $id) {
            $this->recentRemarkId = null;
        }
        $this->confirmingRemarkDeleteId = null;
        if ((int) $this->editingRemarkId === (int) $id) {
            $this->resetRemarkEditState();
        }

        $this->reloadRemarksList();
        $this->emit('ims-remarks-updated');
        $this->dispatchBrowserEvent('showToastr', [
            'type' => 'success',
            'message' => 'Remark deleted successfully!'
        ]);
    }
}
