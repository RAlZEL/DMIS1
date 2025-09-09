<?php

namespace App\Http\Controllers\DocumentTracking\User;

use Illuminate\Http\Request;
use App\Models\Admin\EMS\Employee;
use App\Http\Controllers\Controller;
use App\Models\DocumentTracking\Route;
use App\Models\DocumentTracking\Document;
use App\Models\DocumentTracking\Attachment;

class HomeController extends Controller
{
    public function index (Request $request){
        // $this->authorize('viewany', App\Models\User::class);
        return view('back.pages.user.document-tracking.index');
    }

    public function viewAttachment($id) {

        $attach = Attachment::findorFail($id);

        return response()->file(public_path($attach->attachment));

    } 


    public function printDocument($id) {

        if(auth('web')->check());
        
        {

            $Document = Document::where('id', $id)->get()->first();
           
            $Routes = Route::where('documentid', '=', $Document->PDN)->orderBy('created_at', 'asc')->with('Office', 'Unit', 'Division','fromOffice', 'fromDivision','fromUnit')->get();
      
            $Employees = Employee::with('Office', 'Unit', 'Division')->get();
        
            $AttachmentDetails = Attachment::where('documentid','=', $Document->PDN)->get();

            return view('back.pages.user.document-tracking.print', compact('Document', 'AttachmentDetails','Routes','Employees'));
        }

       
    }
    
}
