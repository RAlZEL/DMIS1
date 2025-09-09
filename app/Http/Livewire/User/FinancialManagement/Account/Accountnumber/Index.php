<?php

namespace App\Http\Livewire\User\FinancialManagement\Account\Accountnumber;

use App\Models\FinancialManagement\account\accountname;
use App\Models\FinancialManagement\account\accountno;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{

    use AuthorizesRequests;

    use WithPagination;
    
    public $updateAccount = false;
    public $selected_account_id;
    public $perPage;
    public $Search;
    public $acct_name, $bank_code, $bank_name,$acct_no;

    

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
        $this->bank_code = null;
        $this->bank_name = null;
        $this->acct_no = null;
        $this->updateAccount = false;

    }   

    public function addAccount() {
        $this->authorize('create', App\Models\FinancialManagement\account\accountno::class);
        $this->validate([
            'acct_name' => 'required',
            'bank_code' => 'required|max:5',
            'bank_name' => 'required|min:5',
            'acct_no' => 'required|unique:fm_account_number,acct_no,',
        ], [
            'acct_name.required' => 'Account Name Field is required',
            'bank_code.required' => 'Bank Code Field is required',
            'bank_name.required' => 'Bank Name Field is required',
            'acct_no.required' => 'Account Number Field is required',
            'acct_no.unique' => 'Account Number already taken',

        ]);

        $AccountName = new accountno();
        $AccountName->acct_id = $this->acct_name;
        $AccountName->bank_code = $this->bank_code;
        $AccountName->bank_name = $this->bank_name;
        $AccountName->acct_no = $this->acct_no;
        $success = $AccountName->save();

        if ($success)
        {
            
            $this->dispatchBrowserEvent('hideAddAccountModal');
            $this->resetModalForm();
            $this->showToastr('New Article Description added Successfully.','success');

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
        $Accountno = accountno::findOrFail($id);
        $this->authorize('update', $Accountno);
        $this->selected_account_id = $Accountno->id;


        $this->updateAccount = true;
        $this->acct_name = $Accountno->AccountName->acct_name;
        $this->bank_code = $Accountno->bank_code;
        $this->bank_name = $Accountno->bank_name;
        $this->acct_no = $Accountno->acct_no;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showUpdateAccountNumberModal');
    }


    public function updateAccount() {
        if ($this->selected_account_id) {
            $this->validate([
                'acct_name' => 'required',
                'bank_code' => 'required|max:5',
                'bank_name' => 'required|min:5',
                'acct_no' => 'required|unique:fm_account_number,acct_no,'.$this->selected_account_id,
            ], [
                'acct_name.required' => 'Account Name Field is required',
                'bank_code.required' => 'Bank Code Field is required',
                'bank_name.required' => 'Bank Name Field is required',
                'acct_no.required' => 'Account Number Field is required',
                'acct_no.unique' => 'Account Number already taken',
    
            ]);


            $Account = accountno::findOrFail($this->selected_account_id);
            $Account->bank_code = $this->bank_code;
            $Account->bank_name = $this->bank_name; 
            $Account->acct_no = $this->acct_no; 
            $Success = $Account->save();

            if ($Success)
            {
                $this->dispatchBrowserEvent('hideUpdatAccountNumbereModal');
                $this->resetModalForm();
                $this->showToastr('Account Number has been successfully Updated.','success');
            }
            else{
                $this->showToastr('Something went wrong. Please contact System Administrator','error');
            }
        }
    }




    public function render()
    {
        return view('livewire.user.financial-management.account.accountnumber.index',[
            'AccountNos' => accountno::orderby('id','asc')->search(trim($this->Search))->paginate($this->perPage),
            'Accounts' => accountname::orderby('acct_name','asc')->get(),
        ]);
    }
}
