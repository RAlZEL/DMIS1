<?php

namespace App\Http\Livewire\User\FinancialManagement\Report;

use App\Models\FinancialManagement\Charging\GaaChargingUACS;
use App\Models\FinancialManagement\gaa\allocation\uacs;;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Peruacs extends Component
{
    use AuthorizesRequests;

    public function GetReport() {
        $this->authorize('viewFinancialReport', \App\Models\FinancialManagement\voucher::class);

        $UACSs = uacs::orderby('id','desc')->get();
        
        $UACSReports = array();

        foreach ($UACSs as $UACS)
        {
            foreach ($UACS->Chargings as $Charging)
            {
                      
                $ObligationAmount = GaaChargingUACS::where('charging_id', '=', $UACS->id)->where('is_obligated','=', true)->with('FinancialManagement')->sum('amount');
                $DisbursementAmount = GaaChargingUACS::where('charging_id', '=', $UACS->id)->where('is_disbursed','=', true)->with('FinancialManagement')->sum('amount');
            
                if ( $ObligationAmount !=0) {
                    $DO = round(($DisbursementAmount / $ObligationAmount )*100,1);
                    $OA = round(($ObligationAmount / $UACS->amount) * 100, 1);
             }
             else
            {
                $DO = 0;
                $OA = 0;
            }
        
            if ( $Charging->amount !=0) {
                
                $DA = round(($DisbursementAmount / $UACS->amount) * 100, 1);
            }
            else
            {
                $DA = 0;
            }
        
            // $ActivityReports[] = array($UACS->year, $PAP->pap, number_format($Allocation->amount,2,'.',','), number_format($Allocation->rem_bal,2,'.',','), number_format($ObligationAmount,2,'.',','), $OA . ' %' ,$PAP->pap,number_format($DisbursementAmount,2,'.',','), $DO . ' %', $Allocation->office); 
                
            $UACSReports[] = array(number_format($ObligationAmount,2,'.',','), $OA . ' %' ,number_format($DisbursementAmount,2,'.',','), $DO . ' %', $DA . ' %',number_format($UACS->rem_bal,2,'.',','), $UACS->UACS->uacs, number_format($UACS->amount,2,'.',','),$UACS->PAPAllocation->Office->office,$UACS->PAPAllocation->ExpenseClass->expense_class, $UACS->PapAllocation->PAP->pap, $UACS->PapAllocation->year); 
        }
        }
        
        return $UACSReports;
        
    }
    
    public function render()
    {
        return view('livewire.user.financial-management.report.peruacs', [
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