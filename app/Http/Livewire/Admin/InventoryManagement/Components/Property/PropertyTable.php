<?php

namespace App\Http\Livewire\Admin\InventoryManagement\Components\Property;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\InventoryManagement\Property;

class PropertyTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $pageName = 'propertyPage';

    public $search = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $perPage = 10;

    // Filter properties
    public $dateFrom = null;
    public $dateTo = null;
    public $valueMin = null;
    public $valueMax = null;
    public $remarks = '';
    public $office = '';

    protected $allowedPerPage = [10, 25, 50, 100];
    protected $listeners = ['filtersApplied' => 'applyFilters', 'propertyEdited', 'propertyDeleted'];

    public function updatingSearch()
    {
        $this->gotoPage(1, $this->pageName);
    }

    public function updatedPerPage()
    {
        $this->normalizePerPage();
        $this->gotoPage(1, $this->pageName);
    }

    public function sortBy($field)
    {
        $allowed = [
            'id', 'article_id', 'article_description', 'property_no',
            'unit_value', 'remarks', 'accountable_officer', 'date_acquired',
        ];

        if (!in_array($field, $allowed, true)) {
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

    public function applyFilters($filters)
    {
        $this->search = $filters['search'] ?? '';
        $this->dateFrom = $filters['dateFrom'] ?? null;
        $this->dateTo = $filters['dateTo'] ?? null;
        $this->valueMin = $filters['valueMin'] ?? null;
        $this->valueMax = $filters['valueMax'] ?? null;
        $this->remarks = $filters['remarks'] ?? '';
        $this->office = $filters['office'] ?? '';
        $this->gotoPage(1, $this->pageName);
    }

    public function editProperty($id)
    {
        $this->emit('editPropertyModal', $id);
    }

    public function deleteProperty($id)
    {
        $this->emit('confirmDelete', $id);
    }

    public function render()
    {
        $query = Property::with(['ArticleName', 'ArticleDescription', 'Employee', 'Office'])
            ->when($this->search, function ($q) {
                $s = '%' . $this->search . '%';
                $q->where(function($qq) use ($s) {
                    $qq->where('property_no', 'like', $s)
                       ->orWhere('remarks', 'like', $s)
                       ->orWhere('accountable_officer', 'like', $s)
                       ->orWhereHas('Employee', function ($qe) use ($s) {
                           $qe->where('firstname', 'like', $s)
                              ->orWhere('middlename', 'like', $s)
                              ->orWhere('lastname', 'like', $s)
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

        $properties = $query
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage, ['*'], $this->pageName);

        return view('livewire.admin.inventory-management.components.property.table', [
            'properties' => $properties,
            'filteredCount' => $filteredCount,
            'totalUnitValue' => $totalUnitValue,
        ]);
    }

    private function normalizePerPage()
    {
        $this->perPage = (int) $this->perPage;
        if (!in_array($this->perPage, $this->allowedPerPage, true)) {
            $this->perPage = 10;
        }
    }
}
