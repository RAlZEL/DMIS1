<?php

namespace App\Http\Livewire\User\FinancialManagement\FmAccounting;

use App\Models\FinancialManagement\AccountTitle;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Admin\AdminPanel\Category\Office;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Accountingentry extends Component
{

    use AuthorizesRequests;

    use WithPagination;
    public $activity;
    public $selected_activity_id;
    public $updateActivity = false;
    public $perPage;
    public $Search;

    protected $listeners = [
        'resetModalForm',
        'deleteActivityAction',
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
        $this->activity = null;
    }   

    public function addActivity() {
        $this->authorize('addAccountingTitle',App\Models\FinancialManagement\voucher::class);
        $this->validate([
            'activity' => 'required|unique:fm_a_activity,activity',
        ]);

        $AccountingEntry = new AccountTitle();
        $AccountingEntry->activity = $this->activity;
        $success = $AccountingEntry->save();

        if ($success)
        {
            $this->dispatchBrowserEvent('hideAddeModal');
            $this->activity = null;
            $this->showToastr('New Activity added Successfully.','success');

        }
        else
        {
            $this->showToastr('Something went wrong. Please contact System Administrator','error');
        }

    }

    // public function deleteOffice($id) {
    //     $this->authorize('viewany', App\Models\User::class);
    //     $Office = Office::findOrFail($id);
    //     $this->selected_office_id = $Office->id;
    //     $this->resetErrorBag();
    //     $this->dispatchBrowserEvent('showDeleteModal');
    // }

    // public function destroyOffice() {
    //     $this->authorize('viewany', App\Models\User::class);
    //     if ($this->selected_office_id) {
    //         $Office = Office::findOrFail($this->selected_office_id);
            
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
 
    

    public function editAccount($id) {
        $this->authorize('updateAccountTitle',App\Models\FinancialManagement\voucher::class);
        $AccountingEntry = AccountTitle::findOrFail($id);
        $this->selected_activity_id = $AccountingEntry->id;
        $this->activity = $AccountingEntry->activity;
        $this->updateActivity = true;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showUpdateModal');
    }


    public function updateActivity() {
        $this->authorize('updateAccountTitle',App\Models\FinancialManagement\voucher::class);
        if ($this->selected_activity_id) {
            $this->validate([
                'activity' => 'required|unique:fm_a_activity,activity,'.$this->selected_activity_id,
            ]);

            $AccountingEntry = AccountTitle::findOrFail($this->selected_activity_id);
            $AccountingEntry->activity = $this->activity;
            $Success = $AccountingEntry->save();

            if ($Success)
            {
                $this->dispatchBrowserEvent('hideAddeModal');
                $this->activity = null;
                $this->updateActivity = false;
                $this->showToastr('Activity has been successfully Updated.','success');
            }
            else{
                $this->showToastr('Something went wrong. Please contact System Administrator','error');
            }
        }
    }


    public function showToastr($message, $type) {
        return $this->dispatchBrowserEvent('showToastr',[
            'type'=>$type,
            'message'=>$message
        ]);
    }

    // public function render()
    // {
    //     $this->authorize('viewany', App\Models\User::class);
    //     return view('livewire.admin.admin-panel.category.offices',[
    //         'Offices' => Office::orderby('office','asc')->search(trim($this->Search))
    //                         ->paginate($this->perPage),
    //     ]); 
    // }



    public function render()
    {
        return view('livewire.user.financial-management.fm-accounting.accountingentry',[
            'AccountTitltes' => AccountTitle::orderby('id', 'asc')->search(trim($this->Search))
                                    ->paginate($this->perPage),
        ]);
    }
}
