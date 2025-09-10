<?php

namespace App\Http\Controllers;

// Core imports
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Domain: Financial
use App\Models\Announcement;
use App\Models\DocumentTracking\Document;
use App\Models\FinancialManagement\account\accountname;
use App\Models\FinancialManagement\voucher;
use App\Models\Task\Task;
use App\Models\User;

// Domain: Inventory
use App\Models\DTR;
use App\Models\Event;
use App\Models\Admin\EMS\Employee;
use App\Models\InventoryManagement\article\articlename;
use App\Models\InventoryManagement\property;

class MenuController extends Controller
{
    public function userindex (Request $request){

        if (auth('web')->check()) {
            $Employee = Employee::where('email', auth('web')->user()->email)->get()->first();
            $myTaskCount = Task::where('employee_id', $Employee->id)->where('is_assigned', true)->count();
              $myTaskCountProcessing = Task::where('employee_id', $Employee->id)->where('is_accepted', true)->count();
         $DateNow = Carbon::now();
         $Announcements = Announcement::where('end_date' , '>=', Carbon::now())->where('start_date', '<=', Carbon::now())->orderby('created_at', 'desc')->get();
    
            return view('back.pages.user.home', compact('myTaskCount','Announcements','Employee','myTaskCountProcessing','DateNow'));
        }
        else {
            return redirect()->route('user.login');
        }
      
    }

    public function adminindex (Request $request){
    $this->authorize('viewany', User::class);
        return view('back.pages.admin.home');
    }

    public function adminlogout() {
        Auth::guard('web')->logout();
        return redirect()->route('admin.login');
    }

    public function userlogout() {
        Auth::guard('web')->logout();
        return redirect()->route('user.login');
    }

    public function adminEMS() {
    $this->authorize('viewany', User::class);

        return view('back.pages.admin.EMS.index');

    }

    public function userEMS() {
    $this->authorize('viewany', Employee::class);

        return view('back.pages.user.EMS.index');

    }

    public function adminUMS() {
    $this->authorize('viewany', User::class);

        return view('back.pages.admin.UMS.index');

    }


    public function adminUserRole() {
    $this->authorize('viewany', User::class);

        return view('back.pages.admin.UMS.roles.index');
    }


    public function userMail() {
    // $this->authorize('viewany', User::class);

        return view('back.pages.user.mail.index');

    }

    public function userFMMail() {
    $this->authorize('viewMail', voucher::class);

        return view('back.pages.user.mail.financial-management.index');

    }

    public function adminDocumentTracking() {
    $this->authorize('adminView', Document::class);
        return view('back.pages.admin.document-tracking.index');
    }

    public function userFM() {
    $this->authorize('viewany', voucher::class);
        return view('back.pages.user.financial-management.index');
    }

    public function userIM() {
    $this->authorize('viewany', property::class);
        return view('back.pages.user.inventory-management.index');
    }

    public function InventoryManagementCreateProperty() {
    $this->authorize('create', property::class);
        return view('back.pages.user.inventory-management.property.create');
    }

    public function InventoryManagementArticle() {
    $this->authorize('viewAny', articlename::class);
        return view('back.pages.user.inventory-management.article.index');
    }

    public function UserInventoryPrint() {
        
        return view('back.pages.user.inventory-management.print.print');
    }

    
    public function userAllocationPAP() {
    $this->authorize('createAllocation', voucher::class);
        return view('back.pages.user.financial-management.gaa.pap.index');
    }

    public function userAllocationActivity() {
    $this->authorize('createAllocation', voucher::class);
        return view('back.pages.user.financial-management.gaa.activity.index');
    }

    public function userAllocationUACS() {
    $this->authorize('createAllocation', voucher::class);
        return view('back.pages.user.financial-management.gaa.uacs.index');
    }


    public function userRealignmentUACS() {
    $this->authorize('createAllocation', voucher::class);
        return view('back.pages.user.financial-management.gaa.realignment.index');
    }
    
    public function FinancialManagementAccount() {
    $this->authorize('viewAny', accountname::class);
        return view('back.pages.user.financial-management.account.index');
    }
    


    public function adminFinancialManagement() {
        // $this->authorize('viewAny', App\Models\FinancialManagement\account\accountname::class);
        return view('back.pages.admin.financial-management.index');
    }




    public function FinancialManagementCreateVoucher() {
    $this->authorize('create', voucher::class);
        return view('back.pages.user.financial-management.voucher.create');
    }

    public function viewDocumentAdmin($id) {
       
        return view('back.pages.user.document-tracking.view',compact('id'));
    }


    public function SAAAllocation() {
    $this->authorize('createAllocation', voucher::class);
        return view('back.pages.user.financial-management.saa.index');
    }

    public function AccountingTitle() {
    $this->authorize('addAccountingTitle',voucher::class);
        return view('back.pages.user.financial-management.fm-accounting.accountingentry');
    }

    public function AccountingUACS() {
    $this->authorize('addAccountingTitle',voucher::class);
        return view('back.pages.user.financial-management.fm-accounting.uacs');
    }

    public function FinancialPerActivityReport() {
    $this->authorize('viewFinancialReport',voucher::class);
        return view('back.pages.user.financial-management.report.peractivity');
    }

    public function FinancialPerPAPReport() {
    $this->authorize('viewFinancialReport',voucher::class);
        return view('back.pages.user.financial-management.report.perpap');
    }

    public function FinancialPerUACSReport() {
    $this->authorize('viewFinancialReport',voucher::class);
        return view('back.pages.user.financial-management.report.peruacs');
    }
    
    public function FinancialPerRealignmentReport() {
    $this->authorize('viewFinancialReport',voucher::class);
        return view('back.pages.user.financial-management.report.perrealignment');
    }

        public function userInventoryReportOfficeArticle()
        {
            return view('back.pages.user.inventory-management.report.office-article');
        }

    public function UserEvent() {
    $this->authorize('viewAny',Event::class);
        return view('back.pages.user.event.index');
    }

    public function UserAnnouncement() {
    $this->authorize('viewAny',Announcement::class);
        return view('back.pages.user.announcement.index');
    }

    public function MemoCreator() {
    // $this->authorize('viewAny',Announcement::class);
        return view('back.pages.user.memo-creator.index');
    }
        
    public function UserTask() {
    $this->authorize('viewAny',Task::class);
        return view('back.pages.user.task.index');
    }

    public function UserDailyTimeRecord() {
    $this->authorize('create',DTR::class);
        return view('back.pages.user.dtr.index');
    }

    public function UserMyDailyTimeRecord() {
    $this->authorize('viewMyDTR',DTR::class);
        return view('back.pages.user.dtr.mydtr.index');
    }
    



    public function UserDTRAdd() {
    $this->authorize('create',DTR::class);
        return view('back.pages.user.dtr.create.index');
    }

    public function UserDTRPrint() {
    $this->authorize('print',DTR::class);
        return view('back.pages.user.dtr.print.print');
    }

    public function financialDVPrint($id) {
    // $this->authorize('print',DTR::class);
        return view('back.pages.user.financial-management.printdv');
    }

    public function UserDTRUpload() {
    $this->authorize('upload',DTR::class);
        return view('back.pages.user.dtr.upload.index');
    }

    public function UserBio() {
    $this->authorize('Biometric',DTR::class);
        return view('back.pages.user.dtr.bio.index');
    }




    public function UserFinalPrint($id) {
  
    $this->authorize('print',DTR::class);

        $DTR = explode(',',str_replace(['"','[',']'], '', $id));

        $Employeeid = $DTR[0];
        $startdate = $DTR[1];
        $enddate = $DTR[2];
        $remarks = null;
        $totallate = null;
        $totalut = null;
   
        $UTHours = 0;
        $UTMinute =  0;
        $LateHours = 0;
        $LateMinute = 0;
         
            $EmployeeOffice = Employee::where('id', $Employeeid)->get()->first();
            $DTRLists = DTR::where('emp_id', $Employeeid)->whereBetween('date', [$startdate,$enddate])->get();
                if ($DTRLists) 
                {   
                    $startDate = new Carbon($startdate);
                    $endDate = new Carbon($enddate);
                    $time1 = $time = $time3 =  $time4 = null;
              
                    $all_dtr = array();
                    $Undetime = null;
                    $Late  = null;
                  
                    $finalLate = '00:00:00';
                    $finalUndertime = '00:00:00';
                    while ($startDate->lte($endDate)){
    
    
                        $Date = Carbon::createFromDate($startDate)->format('m/d/Y');

                        $Event = Event::where('office', $EmployeeOffice->officeid)->where('date', $startDate)->get()->first();

                        if ($Event) {
                            $time1 =   $time2 =   $time3 =   $time4 = $Event->remarks;
                            $Late = $Undetime =  null;
                            $remarks = $Event->event;
             
                        }
                        elseif(Carbon::createFromDate($startDate)->format('D') == 'Sat')
                    
                        {
            
                        $time1 =   $time2 =   $time3 =   $time4 = 'SATURDAY';
                        }
                            elseif(Carbon::createFromDate($startDate)->format('D') == 'Sun')
                            {
                                $time1 =   $time2 =   $time3 =   $time4 = 'SUNDAY';
                                
                    
                            }
                              
                                elseif($DTRLists)
                                {
                    
                                    $time1 = null;
                                    $time2 = null;   
                                    $time3 = null;
                                    $time4 = null;
                                    $lateMortning = intval('0');
                                    $lateAfternoon = intval('0');
                                    $totallate = intval('0');
                                    $totalut = intval('0');
                                    $Late = $Undetime = null;

                                    $DTRTime = DTR::where('emp_id', $Employeeid)->where('date', $startDate)->get();
                                
                                    if ($DTRTime) 
                                    {   
                                        $Undetime = null;
                                        $Late  = null;
    
                                        foreach ($DTRTime as $Time) {

                                            if($Time->schedule == 'TRAVEL ORDER')
                                            {
                                                $time1 =   $time2 = $time3 = $time4 = 'TRAVEL ORDER';
                                                $remarks = $Time->remarks;
                                            }
                                            if($Time->schedule == 'LEAVE')
                                            {
                                                $time1 =   $time2 = $time3 = $time4 = 'LEAVE';
                                                $remarks = $Time->remarks;
                                            }
                                            if($Time->schedule == 'HOLIDAY')
                                            {
                                                $time1 =   $time2 = $time3 = $time4 = 'HOLIDAY';
                                                $remarks = $Time->remarks;
                                            }

                                            
                                    
                                            if($Time->schedule == 'TimeInM')
                                            {
                                                $time1 = date('g:i A', strtotime($Time->time));
                                                $lateMortning = $Time->late;
                                            }
                                            if ($Time->schedule == 'TimeOutM') {
                                               
                                                $time2 = date('g:i A', strtotime($Time->time));
                                                $UndertimeMorning = $Time->undertime;
                                                
                                            }
                                            if ($Time->schedule == 'TimeInA') {
                    
                                                $lateAfternoon = $Time->late;
                                           
                                                $time3 = date('g:i A', strtotime($Time->time));
                                            
                                            }
                                            if ($Time->schedule == 'TimeOutA') {
                                          
                                                $time4 = date('g:i A', strtotime($Time->time));
                                                $UndertimeAfternoon = $Time->undertime;
                                            }
                                            
    
                                            if ($Time->remarks == 'ABSENT')
                                                {
                                                
                                                    if ($Time->schedule == '1stShift') {
                                                        $time1 =   $time2 = 'ABSENT';
                                                        $totallate = Carbon::make($Time->late)->timestamp;
                                                        $totallate = date("H:i", $totallate);
                                                    }
                        
                                                    if ($Time->schedule == '2ndShift') {
                                                        $time3 =   $time4 = 'ABSENT';
                                                        $totallate = Carbon::make($Time->late)->timestamp;
                                                        $totallate = date("H:i", $totallate);
                                                    }
    
                                                    if ($Time->schedule == 'WholeDay') {
                                                        $time1 =   $time2 =   $time3 =   $time4 = 'ABSENT';
                                                        $totallate = Carbon::make($Time->late)->timestamp;
                                                        $totallate = date("H:i", $totallate);
                                                    }
                            
                                                }
    
                                            if ($Time->remarks != 'ABSENT' && $Time->schedule == 'WholeDay') {
                                                $time1 =   $time2 =   $time3 =   $time4 = 'EVENT';
                                                $totallate = $Time->late;
                                                $remarks = $Time->remarks;
                                            }
                                            if ($Time->remarks != 'ABSENT' && $Time->schedule == '2ndShift') {
                                                 $time3 =   $time4 = 'EVENT';
                                                 $totallate = $Time->late;
                                                 $remarks = $Time->remarks;
                                            }
                                            if ($Time->remarks != 'ABSENT' && $Time->schedule == '1stShift') {
                                                $time1 =   $time2 = 'EVENT';
                                                $totallate = $Time->late;
                                                $remarks = $Time->remarks;
                                            }
                                                            
                                        }
                                    
                                            if (!empty($lateMortning) && (!empty($lateAfternoon)))
                                            {
                                            $totallate = Carbon::make($lateMortning)->timestamp + Carbon::make($lateAfternoon)->timestamp - 57600;
                                            $totallate = date("H:i", $totallate);
                                            }
    
                                            if(!empty($lateMortning) && empty($lateAfternoon)) {
                                                $totallate = Carbon::make($lateMortning)->timestamp;
                                            $totallate = date("H:i", $totallate);
                                            }
                                            if(empty($lateMortning) && !empty($lateAfternoon)) {
                                                $totallate = Carbon::make($lateAfternoon)->timestamp;
                                            $totallate = date("H:i", $totallate);
                                            }
    
                                            if (!empty($UndertimeMorning) && (!empty($UndertimeAfternoon)))
                                            {
                                            $totalut = Carbon::make($UndertimeMorning)->timestamp + Carbon::make($UndertimeAfternoon)->timestamp - 57600;
                                           
                                            $totalut = date("H:i", $totalut);
                                            }
                                            if(empty($UndertimeMorning) && !empty($UndertimeAfternoon)) {
                                                $totalut = Carbon::make($UndertimeAfternoon)->timestamp;
                                            $totalut = date("H:i", $totalut);
                                            }
    
                                            if(!empty($UndertimeMorning) && empty($UndertimeAfternoon)) {
                                                $totalut = Carbon::make($UndertimeMorning)->timestamp;
                                            $totalut = date("H:i", $totalut);
                                            }
    
                                        if ($totalut == null) 
                                        {
                                            $totalut = null;
                                        }
                                      
                                        
                                        if ($totallate == null) 
                                        {
                                            $totallate = null;
                                        }                               
                                    }
                                    
                                }
                           
                        $day    = Carbon::createFromDate($Date)->format('D');
                    
                        if (!is_null($totalut)) {
                            
                            $Undertime = explode(':',str_replace(['"'], '', $totalut));
                            $UTHours = $Undertime[0] + $UTHours;
                            $UTMinute =  $Undertime[1] + $UTMinute;
                           
                            
                            if ($LateMinute >= 60) {
                                $UTHours = $UTHours + 1;
                                $UTMinute = $UTMinute - 60;
                            }

                        }

                        if (!is_null($totallate)) {
                            
                            $Late = explode(':',str_replace(['"'], '', $totallate));
                            $LateHours = $Late[0] + $LateHours;
                            $LateMinute =  $Late[1] + $LateMinute;

                            if ($LateMinute >= 60) {
                                $LateHours = $LateHours + 1;
                                $LateMinute = $LateMinute - 60;
                            }
                           
                        }
              
                       
                        $all_dtr[] = array($Date,$time1, $time2, $time3, $time4, $totallate,$totalut, $remarks, $day );
                  
                        $lateMortning = intval('0');
                        $lateAfternoon = intval('0');
                        $UndertimeMorning = intval('0');
                        $UndertimeAfternoon = intval('0');
                        $totalut = null;
                        $totallate = null;
                        $remarks = null;
                        $startDate->addDay(); 
                    }
                }
                     $LatePublish =  $finalLate;
                      $UndertimePublish =  $finalLate;
   
                $EmployeeName = Employee::where('id', $Employeeid)->get()->first();
                $LatePublish = implode(':', [$LateHours, $LateMinute]);
                $UndertimePublish = implode(':', [$UTHours, $UTMinute]);
                return view('back.pages.user.dtr.print.final-print', compact('all_dtr', 'EmployeeName','startdate', 'enddate','LatePublish', 'UndertimePublish'));    

    }
    



    public function viewDocument($id) {
 
        $document = Document::findorfail($id);
        $this->authorize('viewDocumentOffice', $document);
        return view('back.pages.user.document-tracking.view',compact('id'));
    }

    public function viewVoucher($id) {
       
        return view('back.pages.user.financial-management.voucher.view',compact('id'));
    }
}
