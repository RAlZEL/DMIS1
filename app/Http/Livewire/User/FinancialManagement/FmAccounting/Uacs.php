<?php

namespace App\Http\Livewire\User\FinancialManagement\FmAccounting;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use App\Models\Admin\AdminPanel\Category\Office;
use App\Models\Admin\AdminPanel\Category\Division;
use App\Models\FinancialManagement\AccountTitle;
use App\Models\FinancialManagement\uacs as FinancialManagementUacs;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Uacs extends Component
{

    use AuthorizesRequests;
    use WithPagination;
    public $activity_id;
    public $uacs;
    public $selected_activity_id;
    public $selected_uacs_id;
    public $perPage;
    public $Search;
    public $updateUACS = false;


    protected $listeners = [
        'resetModalForm',
        'deleteUACSAction',
    ];

    public function mount() {
        $this->resetPage();
        $this->perPage = 10;
        $this->selected_activity_id = null;
        $this->selected_uacs_id = null;
    //    = $this->search;
    }

    public function updatingSearch() {
        $this->resetPage();
    }
    
    public function resetModalForm() {
        $this->resetErrorBag();
        $this->activity_id = null;
        $this->uacs = null;

    }   

    public function addUACS() {
        $this->authorize('addAccountingTitle',App\Models\FinancialManagement\voucher::class);
        $this->validate([
            'selected_activity_id' => 'required',
            'uacs' => ['required', Rule::unique('fm_a_uacs')
                ->where('a_activity_id', $this->activity_id)
                ->where('uacs', $this->uacs)],
        ],[
            'uacs.required' => 'UACS field must not be empty.',
            'selected_activity_id' =>  'Activity field must not be empty.',
        ]);

        $UACS = new FinancialManagementUacs();
        $UACS->a_activity_id = $this->selected_activity_id;
        $UACS->uacs = $this->uacs;
        $success = $UACS->save();

        if ($success)
        {
            $this->dispatchBrowserEvent('hideAddModal');
            $this->selected_activity_id = null;
            $this->uacs = null;
            $this->showToastr('New UACS added Successfully.','success');
        }
        else
        {
            $this->showToastr('Something went wrong. Please contact System Administrator','error');
        }

    }

    
    public function editUACS($id) {
        $this->authorize('updateAccountTitle',App\Models\FinancialManagement\voucher::class);
        $UACS = FinancialManagementUacs::findOrFail($id);
        $this->selected_uacs_id = $UACS->id;
        $this->selected_activity_id = $UACS->a_activity_id;
        $this->uacs = $UACS->uacs;
        $this->updateUACS = true;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showUpdateModal');
    }


    public function updateUACS() {
        $this->authorize('updateAccountTitle',App\Models\FinancialManagement\voucher::class);
        if ($this->selected_uacs_id) {

            $this->validate([
                'selected_activity_id' => 'required',
                'uacs' => ['required', Rule::unique('fm_a_uacs')
                    ->where('a_activity_id',$this->selected_activity_id)
                    ->where('uacs', $this->uacs)],
            ],[
                'uacs.required' => 'UACS field must not be empty.',
                'selected_activity_id' =>  'Activity field must not be empty.',
            ]);

            $UACS = FinancialManagementUacs::findOrFail($this->selected_uacs_id);
            if($UACS) {
                $UACS->uacs = $this->uacs;
                $UACS->a_activity_id = $this->selected_activity_id;
                $Success = $UACS->save();

                if ($Success)
                {
                    $this->dispatchBrowserEvent('hideAddModal');
                    $this->selected_uacs_id = null;
                    $this->selected_activity_id = null;
                    $this->uacs = null;
                    $this->updateUACS = false;
                    $this->showToastr('UACS has been successfully Updated.','success');
                }
                else{
                    $this->showToastr('Something went wrong. Please contact System Administrator','error');
                }
            }
        }
    }

    // public function deleteDivision($id) {
    //     $this->authorize('viewany', App\Models\User::class);
    //     $Division = Division::findOrFail($id);
    //     $this->selected_division_id = $Division->id;
    //     $this->resetErrorBag();
    //     $this->dispatchBrowserEvent('showDeleteModal');
    // }

    // public function destroyDivision() {
    //     $this->authorize('viewany', App\Models\User::class);
    //     if ($this->selected_division_id) {
    //         $Division = Division::findOrFail($this->selected_division_id);
            
    //         $Success = $Division->delete();

    //         if ($Success) {
    //             $this->dispatchBrowserEvent('hideDeleteDivisionModal');
    //             $this->selected_division_id = null;
    //             $this->showToastr('Division has been successfully Deleted.','success');
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





    public function render()
    {
        return view('livewire.user.financial-management.fm-accounting.uacs', [
            'UACSs' => FinancialManagementUacs::orderBy('id','asc')->search(trim($this->Search))->paginate($this->perPage),
            'Activities'=> AccountTitle::orderby('activity','asc')->get(),
        ]);
    }
}
