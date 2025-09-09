<?php

namespace App\Http\Livewire\User\Mail\FinancialManagement;

use Livewire\Component;
use App\Models\Admin\EMS\Employee;
use App\Models\FinancialManagement\CheckADA;
use App\Models\FinancialManagement\voucher;

class Ada extends Component
{

    public function AdaList() {


   

            $adanos = CheckADA::distinct()->select('adano')->get();
            // dd($adanos->);
            // $Lists = [];
            // foreach ($adanos as $adano) {
            //     $Pap = CheckADA::where('adano', $adano->adano)->get()->first();

            //             $Lists[] = array($Pap->id,$Pap->pap);
            // }
            // if ($ids)
            // {
            //     $Lists = [];
            //     foreach ($ids as $id)
            //     {

            //         $Pap = PAP::where('id', $id->papid)->get()->first();

            //         $Lists[] = array($Pap->id,$Pap->pap);
            //     }

            //     $this->pap_ids =  $Lists;
            //     $this->selectedPAP = NULL;
            //     $this->selectedYear = NULL;
            //     $this->rem_bal = null;
            //     $this->amount = null;
            //     $this->temp_bal = null;
            //     $this->selectedUACS = NULL;
            // }
       
            return $adanos;

            
        
    }


    public function render()
    {
    

        $ADA = $this->AdaList();
 
        return view('livewire.user.mail.financial-management.ada', [
      
            $Employee = Employee:: where('email', auth('web')->user()->email )->get()->first(),
            'incomingCount' => voucher::orderby('created_at','desc')->get()->where('is_forwarded',true)->where('officeid', $Employee->officeid)->where('divisionid', $Employee->divisionid)->where('unitid', $Employee->unitid)->count(),
            'processingCount' => voucher::orderby('created_at','desc')->get()->where('is_accepted',true)->where('officeid', $Employee->officeid)->where('divisionid', $Employee->divisionid)->where('unitid', $Employee->unitid)->count(),
            'outgoingCount' => voucher::orderby('created_at','desc')->get()->where('is_forwarded',true)->where('from_officeid', $Employee->officeid)->where('from_divisionid', $Employee->divisionid)->where('from_unitid', $Employee->unitid)->count(),
            'rejectedCount' => voucher::orderby('created_at','desc')->get()->where('is_rejected',true)->where('officeid', $Employee->officeid)->where('divisionid', $Employee->divisionid)->where('unitid', $Employee->unitid)->count(),
            'closedCount' => voucher::orderby('created_at','desc')->get()->where('is_active',false)->where('officeid', $Employee->officeid)->where('divisionid', $Employee->divisionid)->where('unitid', $Employee->unitid)->count(),
            'ADALists' => $ADA, 
        ]);
    }
}
