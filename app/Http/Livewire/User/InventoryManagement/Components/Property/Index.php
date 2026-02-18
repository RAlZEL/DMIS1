<?php

namespace App\Http\Livewire\User\InventoryManagement\Components\Property;


use Livewire\Component;
use App\Models\AutoNumber;
use App\Models\Admin\EMS\Employee;
use App\Models\FinancialManagement\boxa;
use App\Models\FinancialManagement\Route;
use App\Models\InventoryManagement\Property;
use App\Models\InventoryManagement\article\ArticleDescription;
use App\Models\InventoryManagement\article\ArticleName;
use App\Models\InventoryManagement\article\Remark;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Admin\AdminPanel\Category\Office;

class Index extends Component
{
    use AuthorizesRequests;

    
    public $OfficeLists, $SelectedOffice;
    public $Employees,$selectedEmployee;
    public $officerSearch = ''; // For autocomplete search
    public $showOfficerDropdown = false; // Track dropdown visibility
    public $RemarksList;

    public $articleids;
    public $articledesciptions;
    public $selectedArticle = null;
    public $selectedArticleDescription = null; 
    

    public $perPage;
    public $Search;

    public $employeeName, $employeeOffice;

    public $article = '', $office = '', $specification = '', $propertynumber = '', $unitofmeasurement = '', $unitvalue = '', $quantitypercard = '', $quantityphysicalcount = '', $remarks = '', $remarksSelection = '', $useCustomRemarks = false, $date_acquired = '';

    public $newproperty;
    public $property_id; // For tracking which property is being edited
    public $isEditing = false; // To track if we're in edit mode



    protected $listeners = [
        'resetModalForm',
        'deleteAccountAction',
        'resetForm' => 'resetForm',
    ];

    public function mount() {
        $this->perPage = 10;
        $this->articleids = ArticleName::orderby('article_name','asc')->get(); 
        $this->articledesciptions = collect();
        $this->Employees = collect();
        $this->employeeName = null;
        $this->employeeOffice = null;
        
        // Load remarks from database
        $this->RemarksList = Remark::orderby('remark_name','asc')->get();
        
        // Custom office ordering: OTHERS, PENRO, CENRO SABLAYAN, CENRO SAN JOSE
        $this->OfficeLists = Office::orderByRaw("
            CASE 
                WHEN office = 'OTHERS' THEN 1
                WHEN office = 'PENRO - OCCIDENTAL MINDORO' THEN 2
                WHEN office = 'CENRO SABLAYAN' THEN 3
                WHEN office = 'CENRO SAN JOSE' THEN 4
                ELSE 5
            END
        ")->get();
    }

    public function resetModalForm() {
        $this->resetForm();
    } 
    
    public function updatedSelectedOffice($SelectedOffice) {
        // Clear selected employee when office changes
        $this->selectedEmployee = null;
        $this->employeeName = null;
        $this->employeeOffice = null;
        $this->officerSearch = '';
        
        // Load employees for the selected office
        $this->Employees = Employee::where('empstatus', '=', 'PERMANENT')
            ->where('officeid', $SelectedOffice)
            ->where('is_retired', false)
            ->orderby('firstname', 'asc')
            ->get();
    }

    public function selectOfficer($employeeId, $fullName) {
        $this->selectedEmployee = $employeeId;
        $this->officerSearch = $fullName;
        $this->showOfficerDropdown = false; // Close dropdown after selection
        
        $Employee = Employee::where('id', $employeeId)->first();
        if ($Employee) {
            $this->employeeName = $Employee->firstname . ' ' . $Employee->middlename . ' ' . $Employee->lastname;
            $this->employeeOffice = $Employee->officeid;
        }
    }

    public function updatedSelectedEmployee($EmployeeID) {
        $Employee = Employee::where('id', $EmployeeID)->get()->first();
        $this->employeeName = $Employee->firstname . ' ' . $Employee->middlename . ' ' . $Employee->lastname;
        $this->employeeOffice = $Employee->officeid;
    }

    public function updatedSelectedArticle($Articleid) {
        // Clear selected description when article changes
        $this->selectedArticleDescription = null;
        
        // Load descriptions for the selected article
        if ($this->selectedArticle) {
            $this->articledesciptions = ArticleDescription::where('article_id', $this->selectedArticle)
                ->orderby('article_description', 'asc')
                ->get();
        } else {
            $this->articledesciptions = collect();
        }
    }

    public function updatedRemarksSelection($value)
    {
        if ($value === 'OTHERS') {
            $this->useCustomRemarks = true;
            $this->remarks = '';
        } else {
            $this->useCustomRemarks = false;
            $this->remarks = $value;
        }
    }

    public function useRemarksList()
    {
        $this->useCustomRemarks = false;
        $this->remarks = '';
        $this->remarksSelection = '';
    }

    public function createProperty() {
        $this->authorize('create', App\Models\InventoryManagement\Property::class);
        $this->validate([
            'selectedArticle' => 'required',
            'selectedArticleDescription' => 'required',
            'specification' => 'required',
            'propertynumber' => 'nullable|unique:im_property,property_no',
            'unitvalue' => 'required', 
            'remarksSelection' => $this->useCustomRemarks ? 'nullable' : 'required',
            'remarks' => $this->useCustomRemarks ? 'required|max:255' : 'required',
            'SelectedOffice' => 'required',
            'selectedEmployee' => 'required',
            'date_acquired' => 'required',
        ],[
            'selectedArticle.required' => 'Please select an article',
            'selectedArticleDescription.required' => 'Please select an article description',
            'specification.required' => 'Please enter a specification',
            'propertynumber.unique' => 'Property number already exists',
            'unitvalue.required' => 'Please enter a unit value',
            'remarksSelection.required' => 'Please select remarks',
            'remarks.required' => 'Please enter remarks',
            'SelectedOffice.required' => 'Please select an office',
            'selectedEmployee.required' => 'Please select an employee',
            'date_acquired.required' => 'Please enter a date acquired',
            ]);

        $Property = new property();

        $Property->article_id = $this->selectedArticle;
        $Property->article_description = $this->selectedArticleDescription;
        $Property->specification = $this->specification;
        $Property->property_no = $this->propertynumber ?: null;
        $Property->unit_value = $this->unitvalue;
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
            $this->resetForm();
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

    public function editProperty($id) {
        $this->isEditing = true;
        $this->property_id = $id;
        
        $Property = Property::findOrFail($id);
        
        $this->selectedArticle = $Property->article_id;
        $this->articledesciptions = ArticleDescription::where('article_id', $this->selectedArticle)->get();
        $this->selectedArticleDescription = $Property->article_description;
        $this->specification = $Property->specification;
        $this->propertynumber = $Property->property_no;
        $this->unitofmeasurement = $Property->unit_of_measurement;
        $this->unitvalue = $Property->unit_value;
        $this->quantitypercard = $Property->quantity_per_card;
        $this->quantityphysicalcount = $Property->quantity_per_count;
        $this->remarks = $Property->remarks;
        if ($this->RemarksList && $this->RemarksList->pluck('remark_name')->contains($Property->remarks)) {
            $this->useCustomRemarks = false;
            $this->remarksSelection = $Property->remarks;
        } else {
            $this->useCustomRemarks = true;
            $this->remarksSelection = 'OTHERS';
        }
        $this->SelectedOffice = $Property->office;
        $this->Employees = Employee::where('empstatus', '=', 'PERMANENT')->where('officeid', $this->SelectedOffice)->where('is_retired',false)->orderby('firstname','asc')->get();
        $this->selectedEmployee = $Property->accountable_officer;
        $this->date_acquired = $Property->date_acquired;
        
        $this->dispatchBrowserEvent('showEditModal');
    }

    public function updateProperty() {
        $this->authorize('update', App\Models\InventoryManagement\Property::class);
        $this->validate([
            'selectedArticle' => 'required',
            'selectedArticleDescription' => 'required',
            'specification' => 'required',
            'propertynumber' => 'nullable|unique:im_property,property_no,'.$this->property_id,
            'unitvalue' => 'required',
            'remarksSelection' => $this->useCustomRemarks ? 'nullable' : 'required',
            'remarks' => $this->useCustomRemarks ? 'required|max:255' : 'required',
            'SelectedOffice' => 'required',
            'selectedEmployee' => 'required',
            'date_acquired' => 'required',
        ],[
            'selectedArticle.required' => 'Please select an article',
            'selectedArticleDescription.required' => 'Please select an article description',
            'specification.required' => 'Please enter a specification',
            'propertynumber.unique' => 'Property number already exists',
            'unitvalue.required' => 'Please enter a unit value',
            'remarksSelection.required' => 'Please select remarks',
            'remarks.required' => 'Please enter remarks',
            'SelectedOffice.required' => 'Please select an office',
            'selectedEmployee.required' => 'Please select an employee',
            'date_acquired.required' => 'Please enter a date acquired',
        ]);

        $Property = Property::findOrFail($this->property_id);

        $Property->article_id = $this->selectedArticle;
        $Property->article_description = $this->selectedArticleDescription;
        $Property->specification = $this->specification;
        $Property->property_no = $this->propertynumber ?: null;
        $Property->unit_value = $this->unitvalue;
        $Property->quantity_per_count = $this->quantityphysicalcount;
        $Property->remarks = $this->remarks;
        $Property->office = $this->SelectedOffice;
        $Property->accountable_officer = $this->selectedEmployee;
        $Property->date_acquired = $this->date_acquired;

        $Success = $Property->save();

        if ($Success) 
        {
            $this->dispatchBrowserEvent('hideEditModal');
            $this->showToastr('Property updated Successfully.','success');
            $this->resetForm();
        }
        else
        {
            $this->showToastr('Something went wrong. Please contact System Administrator','error');
        }
    }

    public function resetForm() {
        $this->isEditing = false;
        $this->property_id = null;
        $this->selectedArticle = null;
        $this->selectedArticleDescription = null;
        $this->specification = '';
        $this->propertynumber = '';
        $this->unitofmeasurement = '';
        $this->unitvalue = '';
        $this->quantitypercard = '';
        $this->quantityphysicalcount = '';
        $this->remarks = '';
        $this->remarksSelection = '';
        $this->useCustomRemarks = false;
        $this->SelectedOffice = null;
        $this->selectedEmployee = null;
        $this->date_acquired = '';
        $this->employeeName = null;
        $this->employeeOffice = null;
        $this->officerSearch = '';
        $this->articledesciptions = collect();
        $this->Employees = collect();
        
        // Reset validation errors
        $this->resetValidation();
        
        // Dispatch event to clear currency display field
        $this->dispatchBrowserEvent('clearCurrencyDisplay');
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
