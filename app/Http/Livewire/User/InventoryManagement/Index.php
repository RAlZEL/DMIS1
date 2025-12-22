<?php

namespace App\Http\Livewire\User\InventoryManagement;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\InventoryManagement\property;
use App\Models\InventoryManagement\article\articlename;
use App\Models\InventoryManagement\article\articledescription;
use App\Models\Admin\AdminPanel\Category\Office;
use App\Models\Admin\EMS\Employee;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $pageName = 'inventoryPage';
    public $Search = '';
    public $perPage = 10;

    // Modal filter fields (temporary)
    public $modalSearch = '';
    public $modalDateFrom = null;
    public $modalDateTo = null;
    public $modalValueMin = null;
    public $modalValueMax = null;
    public $modalRemarks = '';
    public $modalOffice = '';

    // Sorting
    public $sortField = 'id';
    public $sortDirection = 'asc';

    // Filters
    public $dateFrom = null;
    public $dateTo = null;
    public $valueMin = null;
    public $valueMax = null;
    public $remarks = '';
    public $office = '';

    // Edit form state - all im_property fields
    public $editId = null;
    public $deleteId = null;
    public $edit_date_acquired = '';
    public $edit_article_id = '';
    public $edit_article_description = '';
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

    // Lists for dropdowns
    public $OfficeLists = [];
    public $EmployeeLists = [];
    public $ArticleNameLists = [];
    public $ArticleDescriptionLists = [];

    protected $rules = [
        'edit_date_acquired'        => 'nullable|date',
        'edit_article_id'           => 'nullable|string|max:255',
        'edit_article_description'  => 'nullable|string|max:255',
        'edit_specification'        => 'nullable|string|max:255',
        'edit_property_no'          => 'nullable|string|max:255',
        'edit_unit_of_measurement'  => 'nullable|string|max:255',
        'edit_unit_value'           => 'nullable|numeric|min:0',
        'edit_quantity_per_card'    => 'nullable|numeric|min:0',
        'edit_quantity_per_count'   => 'nullable|numeric|min:0',
        'edit_remarks'              => 'nullable|string|max:255',
        'edit_office'               => 'nullable|string|max:255',
        'edit_accountable_officer'  => 'nullable|string|max:255',
        'edit_article_desc_id'      => 'nullable',
        'edit_article_desc_text'    => 'nullable|string|max:255',
    ];

    public function mount()
    {
        $this->OfficeLists = Office::orderby('office','asc')->get();
        $this->EmployeeLists = Employee::where('empstatus', '=', 'PERMANENT')->where('is_retired',false)->orderby('firstname','asc')->get();
        $this->ArticleNameLists = articlename::orderby('article_name','asc')->get();

        // Initialize modal fields to current filters
        $this->syncFilterModal();
    }

    public function updatingSearch() { $this->gotoPage(1, $this->pageName); }
    public function updatedPerPage() { $this->gotoPage(1, $this->pageName); }
    public function updatingDateFrom() { $this->gotoPage(1, $this->pageName); }
    public function updatingDateTo() { $this->gotoPage(1, $this->pageName); }
    public function updatingValueMin() { $this->gotoPage(1, $this->pageName); }
    public function updatingValueMax() { $this->gotoPage(1, $this->pageName); }

    public function editProperty($id)
    {
        $p = property::findOrFail($id);

        $this->editId                      = $p->id;
        $this->edit_date_acquired          = $p->date_acquired;
        $this->edit_article_id             = $p->article_id;
        $this->edit_article_description    = $p->article_description;
        $this->edit_specification          = $p->specification;
        $this->edit_property_no            = $p->property_no;
        $this->edit_unit_of_measurement    = $p->unit_of_measurement;
        $this->edit_unit_value             = $p->unit_value;
        $this->edit_quantity_per_card      = $p->quantity_per_card;
        $this->edit_quantity_per_count     = $p->quantity_per_count;
        $this->edit_remarks                = $p->remarks;
        $this->edit_office                 = $p->office;
        $this->edit_accountable_officer    = $p->accountable_officer;

        // load descriptions list for selected article
        $this->ArticleDescriptionLists = articledescription::where('article_id', $this->edit_article_id)->orderBy('article_description','asc')->get();

        // set current description id/text if exists
        $this->edit_article_desc_id = $p->article_description;
        $currentDesc = articledescription::find($this->edit_article_desc_id);
        $this->edit_article_desc_text = $currentDesc ? $currentDesc->article_description : '';

        $this->dispatchBrowserEvent('show-edit-property-modal');
    }

    // When article changes in modal, refresh description list
    public function updatedEditArticleId($articleId)
    {
        $this->ArticleDescriptionLists = articledescription::where('article_id', $articleId)->orderBy('article_description','asc')->get();
        // reset selected description
        $this->edit_article_desc_id = '';
        $this->edit_article_desc_text = '';
    }

    public function updateProperty()
    {
        $this->validate();

        $p = property::findOrFail($this->editId);
        $p->date_acquired           = $this->edit_date_acquired;
        $p->article_id              = $this->edit_article_id;
        // If a description id is chosen, persist that and optionally update its text
        if ($this->edit_article_desc_id) {
            $p->article_description = $this->edit_article_desc_id;
        }
        $p->specification           = $this->edit_specification;
        $p->property_no             = $this->edit_property_no;
        $p->unit_of_measurement     = $this->edit_unit_of_measurement;
        $p->unit_value              = $this->edit_unit_value;
        $p->quantity_per_card       = $this->edit_quantity_per_card;
        $p->quantity_per_count      = $this->edit_quantity_per_count;
        $p->remarks                 = $this->edit_remarks;
        $p->office                  = $this->edit_office;
        $p->accountable_officer     = $this->edit_accountable_officer;
        $p->save();

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
        $this->modalSearch = '';
        $this->modalDateFrom = null;
        $this->modalDateTo = null;
        $this->modalValueMin = null;
        $this->modalValueMax = null;
        $this->modalRemarks = '';
        $this->modalOffice = '';
        $this->dispatchBrowserEvent('filters-cleared');
    }

    public function applyFilters()
    {
        // Copy modal values to actual filters and go to page 1
        $this->Search = $this->modalSearch;
        $this->dateFrom = $this->modalDateFrom;
        $this->dateTo = $this->modalDateTo;
        $this->valueMin = $this->modalValueMin;
        $this->valueMax = $this->modalValueMax;
        $this->remarks = $this->modalRemarks;
        $this->office = $this->modalOffice;
        $this->resetPage();
    }

    public function syncFilterModal()
    {
        $this->modalSearch = $this->Search;
        $this->modalDateFrom = $this->dateFrom;
        $this->modalDateTo = $this->dateTo;
        $this->modalValueMin = $this->valueMin;
        $this->modalValueMax = $this->valueMax;
        $this->modalRemarks = $this->remarks;
        $this->modalOffice = $this->office;
    }

    public function resetToFirstPage()
    {
        // Clear active filters/search
        $this->Search = '';
        $this->dateFrom = null;
        $this->dateTo = null;
        $this->valueMin = null;
        $this->valueMax = null;
        $this->remarks = '';
        $this->office = '';

        // Reflect cleared state in modal fields
        $this->syncFilterModal();

        // Go back to page 1 on the named paginator
        $this->gotoPage(1, $this->pageName);
    }

    // Open Filters modal with a fresh, cleared state
    public function openFilterModal()
    {
        $this->clearFilters();
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
    }

    public function deleteProperty()
    {
        if ($this->deleteId) {
            $property = property::find($this->deleteId);
            if ($property) {
                $property->delete();
                session()->flash('message', 'Property deleted successfully.');
            }
            $this->deleteId = null;
        }
    }

    public function render()
    {
        $query = property::with(['ArticleName','ArticleDescription','Employee','Office'])
            ->when($this->Search, function ($q) {
                $s = '%'.$this->Search.'%';
                $q->where(function($qq) use ($s) {
                    $qq->where('property_no','like',$s)
                       ->orWhere('remarks','like',$s)
                       ->orWhere('accountable_officer','like',$s)
                              ->orWhereHas('Employee', function ($qe) use ($s) {
                                     $qe->where('firstname','like',$s)
                                         ->orWhere('middlename','like',$s)
                                         ->orWhere('lastname','like',$s)
                                         ->orWhereRaw("CONCAT_WS(' ', firstname, middlename, lastname) like ?", [$s]);
                                });
                });
            })
            ->when($this->dateFrom, function ($q) {
                $q->whereDate('date_acquired', '>=', $this->dateFrom);
            })
            ->when($this->dateTo, function ($q) {
                $q->whereDate('date_acquired', '<=', $this->dateTo);
            })
            ->when($this->valueMin !== null && $this->valueMin !== '', function ($q) {
                $q->where('unit_value', '>=', $this->valueMin);
            })
            ->when($this->valueMax !== null && $this->valueMax !== '', function ($q) {
                $q->where('unit_value', '<=', $this->valueMax);
            })
            ->when($this->remarks, function ($q) {
                $q->where('remarks', 'like', '%' . $this->remarks . '%');
            })
            ->when($this->office, function ($q) {
                $q->where('office', $this->office);
            });

        $filteredCount = (clone $query)->count();
        $totalUnitValue = (clone $query)->sum('unit_value');
        $totalCountAll = property::count();

        $properties = $query
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage, ['*'], $this->pageName);

        return view('livewire.user.inventory-management.index', compact('properties', 'filteredCount', 'totalUnitValue', 'totalCountAll'));
    }
}