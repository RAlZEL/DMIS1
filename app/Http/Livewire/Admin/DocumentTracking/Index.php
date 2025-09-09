<?php

namespace App\Http\Livewire\Admin\DocumentTracking;

use App\Http\Livewire\Admin\AdminPanel\Office\Offices;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Admin\EMS\Employee;
use App\Models\DocumentTracking\Route;
use App\Models\DocumentTracking\Document;
use App\Models\Admin\AdminPanel\Category\Office;
use App\Models\Admin\AdminPanel\Category\Division;
use App\Models\Admin\AdminPanel\createOffice\OfficeGroup;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    public $perPage;
    public $selected_document_id;
    public $Search;

    public $routeaction = "FORWARD TO";
    public $officeids;
    public $divisionids;
    public $unitids;
    public $selectedOffice;
    public $selectedDivision = NULL;
    public $selectedUnit= NULL;
    public $remarks;
    public $seleceted_PDN;
    public $DivisionFinal = NULL;

    public function mount() {
        $this->resetPage();
        $this->perPage = 10;
        $this->officeids = Office::orderby('office','asc')->get();
        $this->DivisionFinal = Division::orderby('division','asc')->get();
        $this->divisionids = collect();
        $this->unitids = collect();
    }

    public function updatedselectedOffice($officeid) {
    

        $this->divisionids  = OfficeGroup::where('office_id', $officeid)->get(); 
       
        $this->selectedDivision = NULL;
        $this->selectedUnit = NULL;


}

public function updatedselectedDivision($divisionid) {

    
    if(!is_null($this->selectedDivision))
    {     
     
            $this->unitids = OfficeGroup::where('office_id', $this->selectedOffice)->where('division_id', $this->selectedDivision)->get();
            $this->selectedUnit = NULL;

    }    
}

public function deleteDocument($id) {
    $this->authorize('adminView', App\Models\DocumentTracking\Document::class);
    $Document = Document::findOrFail($id);
    $this->selected_document_id = $Document->id;
    $this->resetErrorBag();
    $this->dispatchBrowserEvent('showDeleteModal');
}


public function destroyDocument() {

    if ($this->selected_document_id)
    {
        $DeleteDocument = Document::findorfail($this->selected_document_id);

        if ($DeleteDocument)
        {
            $Success = $DeleteDocument->delete();
    
            if ($Success) {
    
                $this->dispatchBrowserEvent('hideDeleteDocumentModal');
                $this->showToastr('Document has been successfully Deleted.','success');  
              
            }
            else
            {
                $this->showToastr('Something went wrong. Please contact System Administrator','error');  
            }
        
        }
    }


}

public function addRoute($id) {
    $this->authorize('adminView', App\Models\DocumentTracking\Document::class);
    $Document = Document::findOrFail($id);
    $this->selected_document_id = $Document->id;
    $this->seleceted_PDN = $Document->PDN;
    $this->resetErrorBag();
    $this->dispatchBrowserEvent('showAddRouteModal');
}



public function createRoute() {
    $this->authorize('adminView', App\Models\DocumentTracking\Document::class);

    $Document = Document::findOrFail($this->selected_document_id);

    if ($Document)
    {
     
        $Route = new Route();
            $Route->actiondate = Carbon::now()->format('Y-m-d');
            $Route->documentid =  $Document->PDN;
            $Route->officeid = $this->selectedOffice;
            $Route->divisionid = $this->selectedDivision;
            $Route->unitid = $this->selectedUnit;
            $Route->action = 'FORWARD TO';
            $Route->is_active = true;
            $Route->is_accepted = false;
            $Route->is_rejected = false;
            $Route->is_forwarded = true;
            $Route->remarks = $this->remarks;
            $Route->userid = $Document->from_userid;
            $Route->from_office = $Document->from_officeid;
            $Route->from_division = $Document->from_divisionid;
            $Route->from_unit = $Document->from_unitid;
    
            $Success = $Route->save();

            if ($Success)
                {
                    
                    $Document1 = Document::where('PDN', $Document->PDN)->get()->first();
        
                    $Document1->is_forwarded = true;
                    $Document1->is_accepted = false;
                    $Document1->is_rejected = false;
                    $Document1->is_active = true;
                    $Document1->is_created = false;
                    $Document1->officeid = $this->selectedOffice;
                    $Document1->divisionid = $this->selectedDivision;
                    $Document1->unitid = $this->selectedUnit;
                    $Document1->from_userid = $Document->from_userid;
                    $Document1->from_officeid =  $Document->from_officeid;
                    $Document1->from_divisionid =  $Document->from_divisionid;
                    $Document1->from_unitid = $Document->from_unitid;
        
                    $SuccessDocument = $Document1->save();
        
                    if ($SuccessDocument)
                    {
                      
                        $this->dispatchBrowserEvent('hideAddRouteModal');
                        $this->showToastr('Route for document ' . $Document1->PDN . ' added Successfully.','success');
        
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
            
                $this->remarks = null;
                $this->selectedDivision= null;
                $this->selectedOffice= null;
                $this->selectedUnit= null;
                $this->selected_document_id = null;
    }

}

    public function viewDocument($id)
    {

        return redirect()->route('admin.DocumentView',$id);
  
    }

    public function showToastr($message, $type) {
        return $this->dispatchBrowserEvent('showToastr',[
            'type'=>$type,
            'message'=>$message
        ]);
    }


    public function render()
    {
       $this->authorize('adminView', App\Models\DocumentTracking\Document::class);
        return view('livewire.admin.document-tracking.index', [
            'Documents' => document::orderby('created_at','desc')->search(trim($this->Search))->paginate($this->perPage),
        ]);
    }
}
