<?php

namespace App\Http\Livewire\Admin\InventoryManagement\Components\Property;

use Livewire\Component;
use App\Models\InventoryManagement\Property;

class DeleteConfirmation extends Component
{
    public $deleteId = null;
    
    protected $listeners = ['confirmDelete' => 'confirmDelete'];

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteProperty()
    {
        if ($this->deleteId) {
            $property = Property::find($this->deleteId);
            if ($property) {
                $property->delete();
                $this->emit('propertyDeleted');
                session()->flash('message', 'Property deleted successfully.');
            }
            $this->deleteId = null;
            $this->dispatchBrowserEvent('hide-delete-confirmation');
        }
    }

    public function render()
    {
        return view('livewire.admin.inventory-management.components.property.delete-confirmation');
    }
}
