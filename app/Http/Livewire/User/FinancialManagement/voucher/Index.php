<?php

namespace App\Http\Livewire\User\FinancialManagement\Voucher;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\AutoNumber;
use App\Models\Admin\EMS\Employee;
use App\Models\FinancialManagement\boxa;
use App\Models\FinancialManagement\Route;
use App\Models\FinancialManagement\voucher;
use App\Models\FinancialManagement\account\accountno;
use App\Models\FinancialManagement\account\accountname;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Admin\AdminPanel\FinancialManagement\Office;

class Index extends Component
{
    use AuthorizesRequests;

    public $accountids;
    public $accoutnumbers;
    public $selectedAccount = NULL;
    public $selectedAccountNo = NULL;

    public $perPage;
    public $Search;

    public $office, $address, $amount, $remarks, $particulars, $certified_by_ors, $certified_by_dv, $date_created;

    public $newVoucher;


    
    protected $listeners = [
        'resetModalForm',
        'deleteAccountAction',
    ];

    public function mount() {
        $this->perPage = 10;
        $this->accountids = accountname::orderby('acct_name','asc')->get();
        $this->accoutnumbers = collect();
        $this->date_created = Carbon::now()->format('Y-m-d');
   
    }


    public function updatedselectedAccount($Accountid) {
    

        if($this->selectedAccount)
        {    
             $this->accoutnumbers = accountno::where('acct_id', $this->selectedAccount)->get();
            $this->selectedAccountNo = NULL;

        }
   

    }

    public function updatedoffice($id) {
    

        if($this->office)
        {    
             $Office = Office::where('id', $id)->get()->first();
             $this->address = $Office->address;
        }
   

    }

    public function createVoucher() {
        $this->authorize('create', App\Models\FinancialManagement\voucher::class);
        $this->validate([
            'office' => 'required',
            'address' => 'required',
            'amount' => 'required',
            'particulars' => 'required|min:6',
            'certified_by_ors' => 'required', 
            'certified_by_dv' => 'required',
            'selectedAccount' => 'required',
            'selectedAccountNo' => 'required',
            'date_created' => 'required',
        ]);

        $Voucher = new voucher();

        $Voucher->office = $this->office;
        $Voucher->rem_bal_charging = $this->amount;
        $Voucher->rem_bal_uacs = $this->amount;
        $Voucher->rem_bal_saa = $this->amount;
        $Voucher->amount = $this->amount;
        $Voucher->particulars = $this->particulars;
        $Voucher->certified_by_ors = $this->certified_by_ors;
        $Voucher->certified_by_dv = $this->certified_by_dv;
        $Voucher->date_created = $this->date_created;
        $Voucher->acct_id = $this->selectedAccount;
        $Voucher->acct_no = $this->selectedAccountNo;
        $Voucher->remarks = $this->remarks;
        $Voucher->userid = auth('web')->user()->id;

        $Employee = Employee::where('email', auth('web')->user()->email)->get()->first();

        $Voucher->officeid = $Employee->officeid;
        $Voucher->divisionid = $Employee->divisionid;
        $Voucher->unitid = $Employee->unitid;
        $Voucher->from_officeid = $Employee->officeid;
        $Voucher->from_divisionid = $Employee->divisionid;
        $Voucher->from_unitid = $Employee->unitid;
        $Voucher->from_userid = auth('web')->user()->id;



        $EndNo = AutoNumber::where('code','=', 'FM')->get()->first();
        $Voucher->sequenceid = 'FM'.'-'.date('Y') .'-'. str_pad($EndNo->end_no, 8, '0', STR_PAD_LEFT) ;
        $NewEndNo = AutoNumber::where('code','=', 'FM')->get()->first();



        $NewEndNo->end_no = $NewEndNo->end_no + 1; 
        $Success = $NewEndNo->save();
        $success = $Voucher->save();

        if ($success && $Success)
        {
            $Route = new Route();
            $Route->actiondate = Carbon::now()->format('Y-m-d');
            $Route->sequenceid =  'FM'.'-'.date('Y') .'-'. str_pad($EndNo->end_no, 8, '0', STR_PAD_LEFT) ;
            $User = Employee::where('email', auth('web')->user()->email)->get()->first();

            $Route->officeid = $User->officeid;
            $Route->divisionid = $User->divisionid;
            $Route->unitid = $User->unitid;
            $Route->action = 'VOUCHER CREATED';
            $Route->is_active = true;
            $Route->is_accepted = false;
            $Route->is_rejected = false;
            $Route->is_forwarded = false;
            $Route->remarks = NULL;
            $Route->userid = auth('web')->user()->id;
            $Route->from_office = $User->officeid;
            $Route->from_division = $User->divisionid;
            $Route->from_unit = $User->unitid;

            $Success = $Route->save();

            if ($Success)
            {
                $this->newVoucher = voucher::where('particulars', $this->particulars)->where('amount', $this->amount)->where('acct_id', $this->selectedAccount)->where('acct_no', $this->selectedAccountNo)->get()->first();
                $this->office = null;
                $this->amount= null;
                $this->particulars= null;
                $this->certified_by_ors= null;
                $this->certified_by_dv = null;
                $this->selectedAccount= null;
                $this->selectedAccountNo= null;
                $this->remarks = null;
            
                $this->dispatchBrowserEvent('viewVoucher');
                $this->showToastr('New Voucher added Successfully.','success');
    
            }
            else
            {
                $this->showToastr('Something went wrong. Please contact System Administrator','error');
            }
        }
        else
        {
            $this->showToastr('Something went wrong. Please contact System Administrator','error');
        }

    }

    public function viewVoucher($id)
    {
   
        return redirect()->route('user.viewVoucher',$id);
  
    }


    public function showToastr($message, $type) {
        return $this->dispatchBrowserEvent('showToastr',[
            'type'=>$type,
            'message'=>$message
        ]);
    }
    
    public function render()
    {
        return view('livewire.user.financial-management.voucher.index',[
            'Offices' => Office::orderby('office','asc')->get(),
            'certfiedBys' => boxa::orderby('certified_by', 'asc')->get(),
         
        ]);
    }
}
