<?php

namespace App\Http\Livewire\User\InventoryManagement;

use Livewire\Component;
use App\Models\InventoryManagement\property;

class Index extends Component
{
    public $Search = '';

    // Edit form state
    public $editId = null;
    public $edit_article_name = '';
    public $edit_description = '';
    public $edit_property_no = '';
    public $edit_unit_value = '';
    public $edit_remarks = '';
    public $edit_accountable_officer = '';

    protected $rules = [
        'edit_property_no'         => 'nullable|string|max:255',
        'edit_unit_value'          => 'nullable|numeric|min:0',
        'edit_remarks'             => 'nullable|string|max:255',
        'edit_accountable_officer' => 'nullable|string|max:255',
    ];

    public function updatingSearch()
    {
        // If later you add pagination, reset page here.
    }

    public function editProperty($id)
    {
        $p = property::with(['ArticleName','ArticleDescription'])->findOrFail($id);

        $this->editId                   = $p->id;
        $this->edit_article_name        = ($p->ArticleName->name ?? $p->ArticleName->article_name ?? '') ?? '';
        $this->edit_description         = ($p->ArticleDescription->description ?? $p->ArticleDescription->article_description ?? '') ?? '';
        $this->edit_property_no         = $p->property_no;
        $this->edit_unit_value          = $p->unit_value;   // change to unit_cost if your column is unit_cost
        $this->edit_remarks             = $p->remarks;
        $this->edit_accountable_officer = $p->accountable_officer;

        $this->dispatchBrowserEvent('show-edit-property-modal');
    }

    public function updateProperty()
    {
        $this->validate();

        $p = property::findOrFail($this->editId);
        $p->property_no         = $this->edit_property_no;
        $p->unit_value          = $this->edit_unit_value; // adjust if unit_cost
        $p->remarks             = $this->edit_remarks;
        $p->accountable_officer = $this->edit_accountable_officer;
        $p->save();

        $this->dispatchBrowserEvent('hide-edit-property-modal');
        session()->flash('message', 'Updated.');
    }

    public function render()
    {
        $properties = property::with(['ArticleName','ArticleDescription'])
            ->when($this->Search, function ($q) {
                $s = '%'.$this->Search.'%';
                $q->where(function($qq) use ($s) {
                    $qq->where('property_no','like',$s)
                       ->orWhere('remarks','like',$s)
                       ->orWhere('accountable_officer','like',$s);
                });
            })
            ->orderBy('id')
            ->get();

        return view('livewire.user.inventory-management.index', compact('properties'));
    }
}