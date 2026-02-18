<?php

namespace App\Http\Livewire\Admin\InventoryManagement\Components\Property;

use Livewire\Component;
use App\Models\Admin\AdminPanel\Category\Office;
use App\Models\InventoryManagement\article\Remark;

class FilterModal extends Component
{
    public $modalSearch = '';
    public $modalDateFrom = null;
    public $modalDateTo = null;
    public $modalValueMin = null;
    public $modalValueMax = null;
    public $modalRemarks = '';
    public $modalOffice = '';

    public $OfficeLists = [];
    public $RemarksList = [];

    protected $listeners = ['syncFilters'];

    public function mount()
    {
        $this->OfficeLists = Office::orderBy('office', 'asc')->get();
        $this->RemarksList = Remark::orderBy('remark_name', 'asc')->get();
    }

    public function applyFilters()
    {
        $this->emit('filtersApplied', [
            'search' => $this->modalSearch,
            'dateFrom' => $this->modalDateFrom,
            'dateTo' => $this->modalDateTo,
            'valueMin' => $this->modalValueMin,
            'valueMax' => $this->modalValueMax,
            'remarks' => $this->modalRemarks,
            'office' => $this->modalOffice,
        ]);
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

    public function syncFilters($filters)
    {
        $this->modalSearch = $filters['search'] ?? '';
        $this->modalDateFrom = $filters['dateFrom'] ?? null;
        $this->modalDateTo = $filters['dateTo'] ?? null;
        $this->modalValueMin = $filters['valueMin'] ?? null;
        $this->modalValueMax = $filters['valueMax'] ?? null;
        $this->modalRemarks = $filters['remarks'] ?? '';
        $this->modalOffice = $filters['office'] ?? '';
    }

    public function render()
    {
        return view('livewire.admin.inventory-management.components.property.filter-modal');
    }
}
