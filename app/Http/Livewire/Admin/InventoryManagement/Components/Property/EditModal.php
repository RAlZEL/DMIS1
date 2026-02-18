<?php

namespace App\Http\Livewire\Admin\InventoryManagement\Components\Property;

use Livewire\Component;
use App\Models\InventoryManagement\Property;
use App\Models\InventoryManagement\article\ArticleName;
use App\Models\InventoryManagement\article\ArticleDescription;
use App\Models\Admin\AdminPanel\Category\Office;
use App\Models\Admin\EMS\Employee;

class EditModal extends Component
{
    public $editId = null;
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

    public $OfficeLists = [];
    public $EmployeeLists = [];
    public $ArticleNameLists = [];
    public $ArticleDescriptionLists = [];

    protected $listeners = ['editPropertyModal' => 'loadProperty'];

    protected $rules = [
        'edit_date_acquired' => 'nullable|date',
        'edit_article_id' => 'nullable|string|max:255',
        'edit_article_description' => 'nullable|string|max:255',
        'edit_specification' => 'nullable|string|max:255',
        'edit_property_no' => 'nullable|string|max:255',
        'edit_unit_of_measurement' => 'nullable|string|max:255',
        'edit_unit_value' => 'nullable|numeric|min:0',
        'edit_quantity_per_card' => 'nullable|numeric|min:0',
        'edit_quantity_per_count' => 'nullable|numeric|min:0',
        'edit_remarks' => 'nullable|string|max:255',
        'edit_office' => 'nullable|string|max:255',
        'edit_accountable_officer' => 'nullable|string|max:255',
        'edit_article_desc_id' => 'nullable',
        'edit_article_desc_text' => 'nullable|string|max:255',
    ];

    public function mount()
    {
        $this->OfficeLists = Office::orderBy('office', 'asc')->get();
        $this->EmployeeLists = Employee::where('empstatus', '=', 'PERMANENT')
            ->where('is_retired', false)
            ->orderBy('firstname', 'asc')
            ->get();
        $this->ArticleNameLists = ArticleName::orderBy('article_name', 'asc')->get();
    }

    public function loadProperty($id)
    {
        $p = Property::findOrFail($id);

        $this->editId = $p->id;
        $this->edit_date_acquired = $p->date_acquired;
        $this->edit_article_id = $p->article_id;
        $this->edit_article_description = $p->article_description;
        $this->edit_specification = $p->specification;
        $this->edit_property_no = $p->property_no;
        $this->edit_unit_of_measurement = $p->unit_of_measurement;
        $this->edit_unit_value = $p->unit_value;
        $this->edit_quantity_per_card = $p->quantity_per_card;
        $this->edit_quantity_per_count = $p->quantity_per_count;
        $this->edit_remarks = $p->remarks;
        $this->edit_office = $p->office;
        $this->edit_accountable_officer = $p->accountable_officer;

        $this->ArticleDescriptionLists = ArticleDescription::where('article_id', $this->edit_article_id)->orderBy('article_description', 'asc')->get();

        $this->edit_article_desc_id = $p->article_description;
        $currentDesc = ArticleDescription::find($this->edit_article_desc_id);
        $this->edit_article_desc_text = $currentDesc ? $currentDesc->article_description : '';

        $this->dispatchBrowserEvent('show-edit-property-modal');
    }

    public function updatedEditArticleId($articleId)
    {
        $this->ArticleDescriptionLists = ArticleDescription::where('article_id', $articleId)->orderBy('article_description', 'asc')->get();
        $this->edit_article_desc_id = '';
        $this->edit_article_desc_text = '';
    }

    public function updateProperty()
    {
        $this->validate();

        $p = Property::findOrFail($this->editId);
        $p->date_acquired = $this->edit_date_acquired;
        $p->article_id = $this->edit_article_id;
        if ($this->edit_article_desc_id) {
            $p->article_description = $this->edit_article_desc_id;
        }
        $p->specification = $this->edit_specification;
        $p->property_no = $this->edit_property_no ?: null;
        $p->unit_of_measurement = $this->edit_unit_of_measurement;
        $p->unit_value = $this->edit_unit_value;
        $p->quantity_per_card = $this->edit_quantity_per_card;
        $p->quantity_per_count = $this->edit_quantity_per_count;
        $p->remarks = $this->edit_remarks;
        $p->office = $this->edit_office;
        $p->accountable_officer = $this->edit_accountable_officer;
        $p->save();

        $this->dispatchBrowserEvent('hide-edit-property-modal');
        $this->emit('propertyUpdated');
        session()->flash('message', 'Property updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.inventory-management.components.property.edit-modal');
    }
}
