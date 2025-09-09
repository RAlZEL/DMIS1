<?php

namespace App\Http\Livewire\User\FinancialManagement\Account\Accountname;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\FinancialManagement\account\accountname;
use App\Policies\FinancialManagement\Account\AccountPolicy;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{

    use AuthorizesRequests;

    use WithPagination;
    
    public $updateAccount = false;
    public $selected_account_id;
    public $perPage;
    public $Search;
    public $acct_name, $address, $tinno,$is_active;

    


    protected $listeners = [
        'resetModalForm',
        'deleteAccountAction',
    ];

    public function mount() {
        $this->resetPage();
        $this->perPage = 10;
    }

    public function updateperPage() {
        $this->perPage = $this->perPage;
    }

    public function updatingSearch() {
        $this->resetPage();
    }
    
    public function resetModalForm() {
        $this->resetErrorBag();
        $this->acct_name = null;
        $this->address = null;
        $this->tinno = null;
        $this->is_active = null;
        $this->updateAccount = false;

    }   

    public function addAccount() {
        $this->authorize('create', App\Models\FinancialManagement\account\accountname::class);
        $this->validate([
            'acct_name' => 'required|max:50|unique:fm_account_name,acct_name',
            'address' => 'required|max:50',
            'tinno' => 'required',
        ], [
            'acct_name.required' => 'Account Name Field is required',
            'acct_name.unique' => 'Account Name is already taken',
            'address.required' => 'Address Field is required',
            'tinno.required' => 'TIN Number Field is required',

        ]);
        $AccountName = new accountname();
        $AccountName->acct_name = $this->acct_name;
        $AccountName->address = $this->address;
        $AccountName->tinno = $this->tinno;
        if($this->is_active == true)
        {
            $AccountName->is_active = true;
        }
        else {
            $AccountName->is_active = false;
        }
     
        $success = $AccountName->save();

        if ($success)
        {
            
            $this->dispatchBrowserEvent('hideAddModal');
            $this->resetModalForm();
            $this->showToastr('New Account added Successfully.','success');

        }
        else
        {
            $this->showToastr('Something went wrong. Please contact System Administrator','error');
        }

    }


    public function showToastr($message, $type) {
        return $this->dispatchBrowserEvent('showToastr',[
            'type'=>$type,
            'message'=>$message
        ]);
    }


    public function editAccount($id) {
        $Account = accountname::findOrFail($id);
        $this->authorize('update', $Account);
        $this->selected_account_id = $Account->id;
        $this->updateAccount = true;
        $this->acct_name = $Account->acct_name;
        $this->address = $Account->address;
        $this->tinno = $Account->tinno;
        if($Account->is_active == true)
        {
           $this->is_active = true;
        }
        else {
            $this->is_active = false;
        }
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showUpdateModal');
    }


    public function updateAccount() {
        if ($this->selected_account_id) {
            $this->validate([
                'acct_name' => 'required|max:50|unique:fm_account_name,acct_name,'.$this->selected_account_id,
                'address' => 'required|max:50',
                'tinno' => 'required',
            ], [
                'acct_name.required' => 'Account Name Field is required',
                'acct_name.unique' => 'Account Name is already taken',
                'address.required' => 'Address Field is required',
                'tinno.required' => 'TIN Number Field is required',
    
            ]);

            $Account = accountname::findOrFail($this->selected_account_id);
            $Account->acct_name = $this->acct_name;
            $Account->address = $this->address;
            $Account->tinno = $this->tinno; 
            if($this->is_active == true)
            {
                $Account->is_active = true;
            }
            else {
                $Account->is_active = false;
            }
            $Success = $Account->save();

            if ($Success)
            {
                $this->dispatchBrowserEvent('hideUpdateModal');
                $this->resetModalForm();
                $this->showToastr('Account has been successfully Updated.','success');
            }
            else{
                $this->showToastr('Something went wrong. Please contact System Administrator','error');
            }
        }
    }



    // public function deletePAP($id) {
    //     $this->authorize('updateAllocation', App\Models\FinancialManagement\voucher::class);
    //     $PAP = PAP::findOrFail($id);
    //     $this->selected_pap_id = $PAP->id;
    //     $this->resetErrorBag();
    //     $this->dispatchBrowserEvent('showDeleteModal');
    // }

    // public function destroyPAP() {
    //     $this->authorize('updateAllocation', App\Models\FinancialManagement\voucher::class);
    //     if ($this->selected_pap_id) {
    //         $PAP = PAP::findOrFail($this->selected_pap_id);
            
    //         $withAllocation = AllocationPap::where('papid', $PAP->id )->count();
            
    //         if ($withAllocation) 
    //         {
    //             $this->dispatchBrowserEvent('hideDeleteModal');
    //             $this->showToastr('Unable to Delete. PAP has allocation.','error');  

    //         }
    //         else {
    //             $Success = $PAP->delete();

    //             if ($Success) {
    //                 $this->dispatchBrowserEvent('hideDeleteModal');
    //                 $this->selected_pap_id = null;
    //                 $this->showToastr('PAP has been successfully Deleted.','success');
    //             }
    //             else
    //             {
    //                 $this->showToastr('Something went wrong. Please contact System Administrator','error');  
    //             }
            
    //         }
           
    //     }

    // }




    public function render()
    {
        return view('livewire.user.financial-management.account.accountname.index', [
            'AccountNames' => accountname::orderby('id','asc')->search(trim($this->Search))->paginate($this->perPage),
        ]);
    }
}
