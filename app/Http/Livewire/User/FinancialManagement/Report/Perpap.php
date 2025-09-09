<?php

namespace App\Http\Livewire\User\FinancialManagement\Report;

use App\Models\FinancialManagement\Charging\GaaChargingPAP;
use App\Models\FinancialManagement\gaa\allocation\pap;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Perpap extends Component
{
    use AuthorizesRequests;

    public function GetReport() {
        $this->authorize('viewFinancialReport', \App\Models\FinancialManagement\voucher::class);

        $PAPs = pap::orderby('id','desc')->get();
        
        $PAPReports = array();

        foreach ($PAPs as $PAP)
        {
            foreach ($PAP->Chargings as $Charging)
            {
                      
                $ObligationAmount = GaaChargingPAP::where('charging_id', '=', $PAP->id)->where('is_obligated','=', true)->with('FinancialManagement')->sum('amount');
                $DisbursementAmount = GaaChargingPAP::where('charging_id', '=', $PAP->id)->where('is_disbursed','=', true)->with('FinancialManagement')->sum('amount');
            
                if ( $ObligationAmount !=0) {
                    $DO = round(($DisbursementAmount / $ObligationAmount )*100,1);
                    $OA = round(($ObligationAmount / $PAP->amount) * 100, 1);
             }
             else
            {
                $DO = 0;
                $OA = 0;
            }
        
            if ( $Charging->amount !=0) {
                
                $DA = round(($DisbursementAmount / $PAP->amount) * 100, 1);
            }
            else
            {
                $DA = 0;
            }
        
            // $ActivityReports[] = array($Charging->year, $PAP->pap, number_format($Allocation->amount,2,'.',','), number_format($Allocation->rem_bal,2,'.',','), number_format($ObligationAmount,2,'.',','), $OA . ' %' ,$PAP->pap,number_format($DisbursementAmount,2,'.',','), $DO . ' %', $Allocation->office); 
                
            //$PAPReports[] = array($PAP->year,$PAP->pap, $PAP->office,number_format($PAP->amount,2,'.',','),number_format($ObligationAmount,2,'.',','),number_format($DisbursementAmount,2,'.',','), $OA . ' %' , $DO . ' %',$PAP->expense_class , $DA . ' %');
           $PAPReports[] = array(number_format($ObligationAmount,2,'.',','), $OA . ' %' ,number_format($DisbursementAmount,2,'.',','), $DO . ' %', $DA . ' %',number_format($PAP->rem_bal,2,'.',','), $PAP->PAP->pap, number_format($PAP->amount,2,'.',','),$PAP->PAPAllocation->Office->office,$PAP->PAPAllocation->ExpenseClass->expense_class, $PAP->PapAllocation->PAP->pap, $PAP->PapAllocation->year); 
               
            }
        }
        
        return $PAPReports;
        
    }
    public function render()
    {
        return view('livewire.user.financial-management.report.perpap', [
            'Reports' => $this->GetReport(),
        ]);
    }
}



// $this->authorize('viewFinancialReport', \App\Models\FinancialManagement\voucher::class);

// $Activities = activity::orderby('id','desc')->get();


// $ActivityReports = array();


// foreach($Activities as $Activity)
// {
//     foreach ($Activity->Chargings as $Charging)
//     {
   
//         $ObligationAmount = GaaCharging::where('charging_id', '=', $Activity->id)->where('is_obligated','=', true)->sum('amount');
//         $DisbursementAmount = GaaCharging::where('charging_id', '=', $Activity->id)->where('is_disbursed','=', true)->sum('amount');
       

//          if ( $ObligationAmount !=0) {
//             $DO = round(($DisbursementAmount / $ObligationAmount )*100,1);
//             $OA = round(($ObligationAmount / $Activity->amount) * 100, 1);
       
//          }
//          else
//         {
//             $DO = 0;
//             $OA = 0;

//         }   

//         if ( $Charging->amount !=0) {
        
//             $DA = round(($DisbursementAmount / $Activity->amount) * 100, 1);
//         }
//         else
//         {
//             $DA = 0;
//         }

//         $ActivityReports[] = array(number_format($ObligationAmount,2,'.',','), $OA . ' %' ,number_format($DisbursementAmount,2,'.',','), $DO . ' %', $DA . ' %',number_format($Activity->rem_bal,2,'.',','), $Activity->Activity->activity, number_format($Activity->amount,2,'.',','),$Activity->PAPAllocation->Office->office,$Activity->PAPAllocation->ExpenseClass->expense_class, $Activity->PapAllocation->PAP->pap, $Activity->PapAllocation->year); 
        
//     }

// }    

// return $ActivityReports;
// }




