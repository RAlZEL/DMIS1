<?php

namespace App\Http\Livewire\User\FinancialManagement\Report;

use App\Models\FinancialManagement\Charging\GaaCharging;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\FinancialManagement\gaa\allocation\activity;

class Peractivity extends Component
{
    // public $Reports;

    use AuthorizesRequests;

    public function mount() {
        // $Reports = $this->GetReport();
      


        // return view('financial-management.allocationreport',compact('ActivityReports'));
    }

    public function GetReport() {
        $this->authorize('viewFinancialReport', \App\Models\FinancialManagement\voucher::class);

        $Activities = activity::orderby('id','desc')->get();
     

        $ActivityReports = array();
        

        foreach($Activities as $Activity)
        {
            foreach ($Activity->Chargings as $Charging)
            {
           
                $ObligationAmount = GaaCharging::where('charging_id', '=', $Activity->id)->where('is_obligated','=', true)->sum('amount');
                $DisbursementAmount = GaaCharging::where('charging_id', '=', $Activity->id)->where('is_disbursed','=', true)->sum('amount');
               
      
                 if ( $ObligationAmount !=0) {
                    $DO = round(($DisbursementAmount / $ObligationAmount )*100,1);
                    $OA = round(($ObligationAmount / $Activity->amount) * 100, 1);
               
                 }
                 else
                {
                    $DO = 0;
                    $OA = 0;
        
                }   

                if ( $Charging->amount !=0) {
                
                    $DA = round(($DisbursementAmount / $Activity->amount) * 100, 1);
                }
                else
                {
                    $DA = 0;
                }
      
                $ActivityReports[] = array(number_format($ObligationAmount,2,'.',','), $OA . ' %' ,number_format($DisbursementAmount,2,'.',','), $DO . ' %', $DA . ' %',number_format($Activity->rem_bal,2,'.',','), $Activity->Activity->activity, number_format($Activity->amount,2,'.',','),$Activity->PAPAllocation->Office->office,$Activity->PAPAllocation->ExpenseClass->expense_class, $Activity->PapAllocation->PAP->pap, $Activity->PapAllocation->year); 
                
            }
    
        }    

        return $ActivityReports;
    }
    public function render()
    {

        return view('livewire.user.financial-management.report.peractivity', [
        'Reports' => $this->GetReport(),
        ]);
    }
}
