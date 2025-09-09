<?php

namespace App\Http\Livewire\Admin\AdminPanel\RouteOffice;


use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use App\Models\Admin\AdminPanel\Category\Unit;
use App\Models\Admin\AdminPanel\Category\Office;
use App\Models\Admin\AdminPanel\Category\Division;
use App\Models\FinancialManagement\office\routeOffice;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class Index extends Component
{ 
    use AuthorizesRequests;

    use WithPagination;
    public $office_id, $division_id, $unit_id;
    public $selected_office_id;
    public $updateOffice = false;
    public $perPage;
    public $Search;

    protected $listeners = [
        'resetModalForm',
        'deleteOfficeAction',
    ];

    public function mount() {
        $this->resetPage();
        $this->perPage = 10;
    }

    public function updatingSearch() {
        $this->resetPage();
    }
    
    public function resetModalForm() {
        $this->resetErrorBag();
        $this->office_id = null;
        $this->division_id = null;
        $this->unit_id = null;
    }   


    public function addOffice() {
        $this->authorize('viewany', App\Models\User::class);
        $this->validate([
            'office_id' => 'required',
            'division_id' => 'required',
            'unit_id' => ['required', Rule::unique('fm_office_group')
                                ->where('division_id', $this->division_id)
                                ->where('office_id', $this->office_id)
                                ->where('unit_id', $this->unit_id) ]
        ]);

        $office = new routeOffice();
        $office->office_id = $this->office_id;
        $office->division_id = $this->division_id;
        $office->unit_id = $this->unit_id;
        $success = $office->save();

        if ($success)
        {
            $this->dispatchBrowserEvent('hideOfficeModal');
            $this->office_id = null;
            $this->division_id = null;
            $this->unit_id = null;
            $this->showToastr('New Office added Successfully.','success');

        }
        else
        {
            $this->showToastr('Something went wrong. Please contact System Administrator','error');
        }

    }

    // public function editOffice($id) {
    //     $this->authorize('viewany', App\Models\User::class);
    //     $Office = OfficeGroup::findOrFail($id);
    //     $this->selected_office_id = $Office->id;
    //     $this->office_id = $Office->office_id;
    //     $this->division_id = $Office->division_id;
    //     $this->unit_id = $Office->unit_id;
    //     $this->updateOffice = true;
    //     $this->resetErrorBag();
    //     $this->dispatchBrowserEvent('showUpdateModal');
    // }


    // public function updateOffice() {
    //     $this->authorize('viewany', App\Models\User::class);
    //     if ($this->selected_office_id) {
    //         $this->validate([

    //             'office_id' => 'required',
    //             'division_id' => 'required',
    //             'unit_id' => ['required', Rule::unique('office_group')
    //                                 ->where('division_id', $this->division_id)
    //                                 ->where('office_id', $this->office_id)
    //                                 ->where('unit_id', $this->unit_id)]
    //         ]);

    //         $Office = OfficeGroup::findOrFail($this->selected_office_id);
    //         $Office->office_id = $this->office_id;
    //         $Office->division_id = $this->division_id;
    //         $Office->unit_id = $this->unit_id;
    //         $Success = $Office->save();

    //         if ($Success)
    //         {
    //             $this->dispatchBrowserEvent('hideOfficeModal');
    //             $this->office_id = null;
    //             $this->division_id = null;
    //             $this->unit_id = null;
    //             $this->updateOffice = false;
    //             $this->showToastr('Office has been successfully Updated.','success');
    //         }
    //         else{
    //             $this->showToastr('Something went wrong. Please contact System Administrator','error');
    //         }
    //     }
    // }

    // public function deleteOffice($id) {
    //     $this->authorize('viewany', App\Models\User::class);
    //     $Office = OfficeGroup::findOrFail($id);
    //     $this->selected_office_id = $Office->id;
    //     $this->resetErrorBag();
    //     $this->dispatchBrowserEvent('showDeleteModal');
    // }

    // public function destroyOffice() {
    //     $this->authorize('viewany', App\Models\User::class);
    //     if ($this->selected_office_id) {
    //         $Office = OfficeGroup::findOrFail($this->selected_office_id);
            
    //         $Success = $Office->delete();

    //         if ($Success) {
    //             $this->dispatchBrowserEvent('hideDeleteOfficeModal');
    //             $this->selected_office_id = null;
    //             $this->showToastr('Office has been successfully Deleted.','success');
    //         }
    //         else
    //         {
    //             $this->showToastr('Something went wrong. Please contact System Administrator','error');  
    //         }
        
    //     }

    // }

    public function showToastr($message, $type) {
        return $this->dispatchBrowserEvent('showToastr',[
            'type'=>$type,
            'message'=>$message
        ]);
    }

    // public function render()
    // {
    //     $this->authorize('viewany', App\Models\User::class);
    //     return view('livewire.admin.admin-panel.office.offices',[
    //         'OfficeGroups' => OfficeGroup::orderby('office_id','asc')->search(trim($this->Search))
    //         ->paginate($this->perPage),
    //       
    //      
    //     ]);

    // }
    public function render()
    {
        return view('livewire.admin.admin-panel.route-office.index',[
            'Offices' => Office::orderby('office','asc')->get(),
            'Divisions' => Division::orderby('division', 'asc')->get(),
                    'Units' => Unit::orderby('unit','asc')->get(),
                    'OfficeGroups' => routeOffice::orderby('office_id','asc')->search(trim($this->Search))
                            ->paginate($this->perPage),
        ]);
    }
}
