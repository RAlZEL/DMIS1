<?php

namespace App\Http\Livewire\User\InventoryManagement\Property;


use Livewire\Component;
use App\Models\AutoNumber;
use App\Models\Admin\EMS\Employee;
use App\Models\FinancialManagement\boxa;
use App\Models\FinancialManagement\Route;
use App\Models\InventoryManagement\property;
use App\Models\InventoryManagement\article\articledescription;
use App\Models\InventoryManagement\article\articlename;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Admin\AdminPanel\Category\Office;

class Index extends Component
{
    use AuthorizesRequests;

    
    public $OfficeLists, $SelectedOffice;
    public $Employees,$selectedEmployee;

    public $articleids;
    public $articledesciptions;
    public $selectedArticle = null;
    public $selectedArticleDescription = null; 
    

    public $perPage;
    public $Search;

    public $employeeName, $employeeOffice;

    public $article, $office, $specification, $propertynumber, $unitofmeasurement, $unitvalue, $quantitypercard, $quantityphysicalcount, $remarks, $date_acquired;

    public $newproperty;



    protected $listeners = [
        'resetModalForm',
        'deleteAccountAction',
    ];

    public function mount() {
        $this->perPage = 10;
        $this->articleids = articlename::orderby('article_name','asc')->get(); 
        $this->articledesciptions = collect();
        $this->Employees = collect();
        $this->employeeName = null;
        $this->employeeOffice = null;
        $this->OfficeLists = Office::orderby('office','asc')->get();

   
    } 
    
    public function updatedSelectedOffice($SelectedOffice) {
 
        
        $this->Employees = Employee::where('empstatus', '=', 'PERMANENT')->where('officeid', $SelectedOffice)->where('is_retired',false)->orderby('firstname','asc')->get();
  
    }

    public function updatedselectedEmployee($EmployeeID) {
 
        $Employee = Employee::where('id', $EmployeeID)->get()->first();
        $this->employeeName = $Employee->firstname . ' ' . $Employee->middlename . ' ' . $Employee->lastname;
        $this->employeeOffice = $Employee->officeid;
    }

    public function updatedselectedArticle($Articleid) {

        if($this->selectedArticle)
        {    
             $this->articledesciptions = articledescription::where('article_id', $this->selectedArticle)->get();
            $this->selectedArticleDescription = NULL;

        }

    }

    public function createProperty() {
        $this->authorize('create', App\Models\InventoryManagement\property::class);
        $this->validate([
            'selectedArticle' => 'required',
            'selectedArticleDescription' => 'required',
            'specification' => 'required',
            'propertynumber' => 'required|unique:im_property,property_no,'.$this->propertynumber,
            'unitvalue' => 'required', 
            'remarks' => 'required',
            'SelectedOffice' => 'required',
            'selectedEmployee' => 'required',
            'date_acquired' => 'required',
        ],[
            'selectedArticle.required' => 'Please select an article',
            'selectedArticleDescription.required' => 'Please select an article description',
            'specification.required' => 'Please enter a specification',
            'propertynumber.required' => 'Please enter a property number',
            'propertynumber.unique' => 'Property number already exists',
            'unitvalue.required' => 'Please enter a unit value',
            'remarks.required' => 'Please enter remarks',
            'SelectedOffice.required' => 'Please select an office',
            'selectedEmployee.required' => 'Please select an employee',
            'date_acquired.required' => 'Please enter a date acquired',
            ]);

        $Property = new property();

        $Property->article_id = $this->selectedArticle;
        $Property->article_description = $this->selectedArticleDescription;
        $Property->specification = $this->specification;
        $Property->property_no = $this->propertynumber;
        $Property->unit_of_measurement = $this->unitofmeasurement;
        $Property->unit_value = $this->unitvalue;
        $Property->quantity_per_card = $this->quantitypercard;
        $Property->quantity_per_count = $this->quantityphysicalcount;
        $Property->remarks = $this->remarks;
        $Property->office = $this->SelectedOffice;
        $Property->accountable_officer = $this->selectedEmployee;
        $Property->date_acquired = $this->date_acquired;

        $Success = $Property->save();

        if ($Success) 
        {
            $this->dispatchBrowserEvent('viewProperty');
            $this->showToastr('New Property added Successfully.','success');

        }
        else
        {
            $this->showToastr('Something went wrong. Please contact System Administrator','error');
        }



    }

    public function viewProperty()
    {
   
        return redirect()->route('user.IM');
  
    }
    
    public function showToastr($message, $type) {
        return $this->dispatchBrowserEvent('showToastr',[
            'type'=>$type,
            'message'=>$message
        ]);
    }

    public function render()
    {
        return view('livewire.user.inventory-management.property.index');
    }
}
