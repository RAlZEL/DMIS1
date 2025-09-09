<?php

namespace App\Http\Controllers\Mail\User;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Admin\EMS\Employee;
use App\Http\Controllers\Controller;
use App\Models\DocumentTracking\Document;
use App\Models\FinancialManagement\voucher;

class MailController extends Controller
{
    public function printIncoming($id) {

        $documentids = explode(',',str_replace(['"','[',']'], '', $id));

        if(auth('web')->check());
        
        {
        

            foreach ($documentids as $documentid)
            {
                $Document = Document::where('id', $documentid)->with('Office','Unit','Division')->get()->first();
        
                // 
                $incomingLists[] = array($Document->PDN,$Document->subject, $Document->Office->office, $Document->Division->division ,$Document->Unit->unit);
            }
            $Date = Carbon::now()->format('Y-m-d');
        $User = Employee::where('email', auth('web')->user()->email)->get()->first();
     
        return view('back.pages.user.mail.print.printIncoming', compact('incomingLists', 'User','Date'));            

        }

       
    }

    public function printFMManifest($id) {

        $documentids = explode(',',str_replace(['"','[',']'], '', $id));
        if(auth('web')->check());
        
        {

            foreach ($documentids as $documentid)
            {
            
                $Document = voucher::where('id', $documentid)->with('Office','Unit','Division')->get()->first();
                $incomingLists[] = array($Document->sequenceid,$Document->particulars, $Document->amount, $Document->Office->office, $Document->Division->division ,$Document->Unit->unit);
            }
            $Date = Carbon::now()->format('Y-m-d');
        $User = Employee::where('email', auth('web')->user()->email)->get()->first();
     
        return view('back.pages.user.mail.print.printFMManifest', compact('incomingLists', 'User','Date'));            

        }

       
    }

    

    public function outgoingIndex() {
        // $this->authorize('viewany', App\Models\User::class);

        return view('back.pages.user.mail.outgoing');

    }

    public function processingIndex() {
        // $this->authorize('viewany', App\Models\User::class);

        return view('back.pages.user.mail.processing');

    }

    public function rejectedIndex() {
        // $this->authorize('viewany', App\Models\User::class);

        return view('back.pages.user.mail.rejected');

    }

    public function closedIndex() {
        // $this->authorize('viewany', App\Models\User::class);

        return view('back.pages.user.mail.closed');

    }

    
    public function assignedTask() {
        // $this->authorize('viewany', App\Models\User::class);

        return view('back.pages.user.mail.task');

    }
    
    public function processingIndexFM() {
        $this->authorize('viewMail', App\Models\FinancialManagement\voucher::class);

        return view('back.pages.user.mail.financial-management.processing');

    }

    public function rejectedIndexFM() {
        $this->authorize('viewMail', App\Models\FinancialManagement\voucher::class);

        return view('back.pages.user.mail.financial-management.rejected');

    }

    public function outgoingIndexFM() {
        $this->authorize('viewMail', App\Models\FinancialManagement\voucher::class);

        return view('back.pages.user.mail.financial-management.outgoing');

    }

    public function ADAFM() {
        $this->authorize('viewADAFM', App\Models\FinancialManagement\voucher::class);

        return view('back.pages.user.mail.financial-management.ada');

    }
    


}
