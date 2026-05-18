<?php

namespace App\Http\Livewire\Admin\InventoryManagement\Components\Property;


use App\Models\Admin\AdminPanel\Category\Office;
use App\Models\Admin\EMS\Employee;
use App\Models\InventoryManagement\Property;
use App\Models\InventoryManagement\article\ArticleDescription;
use App\Models\InventoryManagement\article\ArticleName;
use App\Models\InventoryManagement\article\Remark;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Index extends Component
{
    use AuthorizesRequests;

    
    public $OfficeLists, $SelectedOffice;
    public $Employees,$selectedEmployee;
    public $officerOptions;
    public $officerSearch = ''; // For autocomplete search
    public $showOfficerDropdown = false; // Track dropdown visibility
    public $RemarksList;
    public $autoSuggestedUacs = '';

    public $articleids;
    public $articledesciptions;
    public $selectedArticle = null;
    public $selectedArticleDescription = null; 
    

    public $perPage;
    public $Search;

    public $employeeName, $employeeOffice;

    public $article = '', $office = '', $specification = '', $propertynumber = '', $unitofmeasurement = '', $unitvalue = '', $quantitypercard = '', $quantityphysicalcount = '', $uacs = '', $fundCluster = '', $estimatedUsefulLife = '', $remarks = '', $remarksSelection = '', $useCustomRemarks = false, $date_acquired = '';

    public $newproperty;
    public $property_id; // For tracking which property is being edited
    public $isEditing = false; // To track if we're in edit mode



    protected $listeners = [
        'resetModalForm' => 'resetForm',
        'resetForm' => 'resetForm',
        'ims-article-name-updated' => 'refreshArticleNames',
        'ims-article-description-updated' => 'refreshArticleDescriptions',
        'ims-remarks-updated' => 'refreshRemarksList',
    ];

    public function mount() {
        $this->perPage = 10;
        $this->articleids = ArticleName::orderby('article_name','asc')->get(); 
        $this->articledesciptions = collect();
        $this->Employees = collect();
        $this->officerOptions = collect();
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

    public function refreshArticleNames($newArticleId = null): void
    {
        $currentArticleId = ($this->selectedArticle !== null && $this->selectedArticle !== '')
            ? (string) $this->selectedArticle
            : null;

        $this->articleids = ArticleName::orderBy('article_name', 'asc')->get();

        if ($currentArticleId !== null && $this->articleids->contains('id', (int) $currentArticleId)) {
            $this->selectedArticle = $currentArticleId;
            $this->syncSuggestedUacs();
            return;
        }

        if ($currentArticleId !== null) {
            $this->selectedArticle = null;
            $this->selectedArticleDescription = null;
            $this->articledesciptions = collect();
            return;
        }

        if ($newArticleId) {
            $this->selectedArticle = (string) $newArticleId;
            $this->refreshArticleDescriptions($newArticleId);
            $this->syncSuggestedUacs();
        }
    }

    public function refreshArticleDescriptions($articleId = null): void
    {
        $targetArticleId = $articleId ? (string) $articleId : (string) $this->selectedArticle;
        if (! $targetArticleId) {
            $this->articledesciptions = collect();
            $this->selectedArticleDescription = null;
            return;
        }

        if ($this->selectedArticle && (string) $this->selectedArticle !== $targetArticleId) {
            return;
        }

        $currentDescriptionId = $this->selectedArticleDescription;
        $this->articledesciptions = ArticleDescription::where('article_id', $targetArticleId)
            ->orderBy('article_description', 'asc')
            ->get();

        if ($currentDescriptionId && $this->articledesciptions->contains('id', (int) $currentDescriptionId)) {
            return;
        }

        $this->selectedArticleDescription = null;
    }

    public function refreshRemarksList(): void
    {
        $currentSelection = $this->remarksSelection;
        $isCustomRemarks = (bool) $this->useCustomRemarks;

        $this->RemarksList = Remark::orderBy('remark_name', 'asc')->get();

        if ($isCustomRemarks) {
            return;
        }

        if ($currentSelection === '' || $currentSelection === null) {
            return;
        }

        $stillExists = $this->RemarksList->pluck('remark_name')->contains($currentSelection);
        if (! $stillExists) {
            $this->remarksSelection = '';
            $this->remarks = '';
            return;
        }

        $this->remarks = $currentSelection;
    }
    
    public function updatedSelectedOffice($SelectedOffice) {
        // Clear selected employee when office changes
        $this->selectedEmployee = null;
        $this->employeeName = null;
        $this->employeeOffice = null;
        $this->officerSearch = '';
        $this->showOfficerDropdown = false;
        
        // Load employees for the selected office
        $officeId = (int) $SelectedOffice;
        $this->Employees = $officeId > 0
            ? $this->activeEmployeeQuery($officeId)->get()
            : collect();
        $this->refreshOfficerOptions();
    }

    public function updatedOfficerSearch($value): void
    {
        if (! $this->SelectedOffice) {
            $this->officerOptions = collect();
            $this->showOfficerDropdown = false;
            return;
        }

        $normalizedSearch = $this->normalizeText((string) $value);
        if ($this->selectedEmployee) {
            $selectedEmployee = $this->Employees->firstWhere('id', (int) $this->selectedEmployee);
            if ($selectedEmployee && $normalizedSearch !== $this->formatEmployeeName($selectedEmployee)) {
                $this->selectedEmployee = null;
                $this->employeeName = null;
                $this->employeeOffice = null;
            }
        }

        $this->refreshOfficerOptions();
        $this->showOfficerDropdown = $this->officerOptions->isNotEmpty();
    }

    public function openOfficerDropdown(): void
    {
        if (! $this->SelectedOffice) {
            $this->showOfficerDropdown = false;
            return;
        }

        $this->refreshOfficerOptions();
        $this->showOfficerDropdown = $this->officerOptions->isNotEmpty();
    }

    public function hideOfficerDropdown(): void
    {
        $this->showOfficerDropdown = false;
    }

    public function selectOfficer($employeeId) {
        $employee = $this->Employees->firstWhere('id', (int) $employeeId);
        if (! $employee) {
            return;
        }

        $this->selectedEmployee = (int) $employee->id;
        $this->officerSearch = $this->formatEmployeeName($employee);
        $this->showOfficerDropdown = false; // Close dropdown after selection
        $this->officerOptions = collect();
        $this->employeeName = $this->officerSearch;
        $this->employeeOffice = $employee->officeid;
    }

    public function clearOfficerSearch(): void
    {
        $this->officerSearch = '';
        $this->selectedEmployee = null;
        $this->employeeName = null;
        $this->employeeOffice = null;
        $this->showOfficerDropdown = false;
        $this->refreshOfficerOptions();
    }

    public function updatedSelectedEmployee($EmployeeID) {
        $Employee = Employee::where('id', $EmployeeID)->first();
        if (! $Employee) {
            $this->selectedEmployee = null;
            $this->employeeName = null;
            $this->employeeOffice = null;
            $this->officerSearch = '';
            return;
        }

        $this->employeeName = $this->formatEmployeeName($Employee);
        $this->employeeOffice = $Employee->officeid;
        $this->officerSearch = $this->employeeName;
        $this->showOfficerDropdown = false;
    }

    public function updatedSelectedArticle($Articleid) {
        // Clear selected description when article changes
        $this->selectedArticleDescription = null;
        
        // Load descriptions for the selected article
        $articleId = (int) $Articleid;
        if ($articleId > 0) {
            $this->articledesciptions = ArticleDescription::where('article_id', $articleId)
                ->orderby('article_description', 'asc')
                ->get();
        } else {
            $this->articledesciptions = collect();
        }

        $this->syncSuggestedUacs();
    }

    public function updatedUnitvalue($value): void
    {
        $this->unitvalue = $this->normalizeNumber($value);
        $this->syncSuggestedUacs();
    }
    public function refreshUnitValueState($value = null): void
    {
        $this->unitvalue = $this->normalizeNumber($value);
        $this->syncSuggestedUacs();
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
        $this->authorize('create', Property::class);
        $this->preparePropertyPayload();
        $this->validate($this->propertyRules(), $this->propertyMessages());
        if (! $this->validateRelationIntegrity()) {
            return;
        }

        $Property = new Property();
        $this->fillPropertyModel($Property);
        $Success = $Property->save();

        if ($Success) 
        {
            $this->showToastr('New Property added Successfully.','success');
            $this->resetForm();
            $this->emitUp('ims-property-created');
            $this->dispatchBrowserEvent('hide-create-property-modal');
        }
        else
        {
            $this->showToastr('Something went wrong. Please contact System Administrator','error');
        }


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
        $this->autoSuggestedUacs = $this->resolveArticleMappedUacs($Property->article_id, $Property->unit_value);
        $this->uacs = $Property->uacs ?: $this->autoSuggestedUacs;
        $this->fundCluster = $Property->fund_cluster ?? '';
        $this->estimatedUsefulLife = $Property->estimated_useful_life ?? '';
        $this->remarks = $Property->remarks;
        if ($this->RemarksList && $this->RemarksList->pluck('remark_name')->contains($Property->remarks)) {
            $this->useCustomRemarks = false;
            $this->remarksSelection = $Property->remarks;
        } else {
            $this->useCustomRemarks = true;
            $this->remarksSelection = 'OTHERS';
        }
        $this->SelectedOffice = $Property->office;
        $this->Employees = $this->activeEmployeeQuery((int) $this->SelectedOffice)->get();
        $this->selectedEmployee = $Property->accountable_officer;
        $selectedEmployee = $this->Employees->firstWhere('id', (int) $this->selectedEmployee);
        if ($selectedEmployee) {
            $this->employeeName = $this->formatEmployeeName($selectedEmployee);
            $this->employeeOffice = $selectedEmployee->officeid;
            $this->officerSearch = $this->employeeName;
        } else {
            $this->employeeName = null;
            $this->employeeOffice = null;
            $this->officerSearch = '';
        }
        $this->refreshOfficerOptions();
        $this->showOfficerDropdown = false;
        $this->date_acquired = $Property->date_acquired;
        
        $this->dispatchBrowserEvent('showEditModal');
    }

    public function updateProperty() {
        $Property = Property::findOrFail($this->property_id);
        $this->authorize('update', $Property);
        $this->preparePropertyPayload();
        $this->validate($this->propertyRules((int) $Property->id), $this->propertyMessages());
        if (! $this->validateRelationIntegrity()) {
            return;
        }
        $this->fillPropertyModel($Property);
        $Success = $Property->save();

        if ($Success) 
        {
            $this->dispatchBrowserEvent('hideEditModal');
            $this->showToastr('Property updated Successfully.','success');
            $this->resetForm();
            $this->emitUp('ims-property-created');
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
        $this->uacs = '';
        $this->autoSuggestedUacs = '';
        $this->fundCluster = '';
        $this->estimatedUsefulLife = '';
        $this->remarks = '';
        $this->remarksSelection = '';
        $this->useCustomRemarks = false;
        $this->SelectedOffice = null;
        $this->selectedEmployee = null;
        $this->date_acquired = '';
        $this->employeeName = null;
        $this->employeeOffice = null;
        $this->officerSearch = '';
        $this->officerOptions = collect();
        $this->showOfficerDropdown = false;
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

    private function activeEmployeeQuery(?int $officeId = null)
    {
        return Employee::query()
            ->where('empstatus', '=', 'PERMANENT')
            ->where('is_retired', false)
            ->when($officeId, function ($query) use ($officeId) {
                return $query->where('officeid', $officeId);
            })
            ->orderBy('firstname', 'asc')
            ->orderBy('lastname', 'asc');
    }

    private function refreshOfficerOptions(): void
    {
        $employees = $this->Employees instanceof Collection ? $this->Employees : collect($this->Employees);
        $keyword = strtolower($this->normalizeText($this->officerSearch));

        if ($keyword !== '') {
            $employees = $employees->filter(function ($employee) use ($keyword) {
                return str_contains(strtolower($this->formatEmployeeName($employee)), $keyword);
            });
        }

        $this->officerOptions = $employees->take(25)->values();
    }

    private function formatEmployeeName($employee): string
    {
        return $this->normalizeText(collect([
            $employee->firstname ?? '',
            $employee->middlename ?? '',
            $employee->lastname ?? '',
        ])->filter()->implode(' '));
    }

    private function normalizeText(?string $value): string
    {
        $value = trim((string) $value);
        if ($value === '') {
            return '';
        }

        return preg_replace('/\s+/u', ' ', $value) ?? '';
    }

    private function normalizeNumber($value): ?float
    {
        if ($value === null || $value === '') {
            return null;
        }

        $normalized = str_replace(',', '', (string) $value);
        if (! is_numeric($normalized)) {
            return null;
        }

        return (float) $normalized;
    }

    private function resolveArticleMappedUacs($articleId, $unitValue): string
    {
        $articleId = (int) $articleId;
        $unitValue = $this->normalizeNumber($unitValue);

        if ($articleId <= 0 || $unitValue === null) {
            return '';
        }

        $article = ArticleName::query()->select('ppe_uacs', 'semi_ex_uacs')->find($articleId);
        if (! $article) {
            return '';
        }

        $mappedUacs = $unitValue >= 50000
            ? ($article->ppe_uacs ?? '')
            : ($article->semi_ex_uacs ?? '');

        return $this->normalizeText($mappedUacs);
    }

    private function syncSuggestedUacs(): void
    {
        $suggestedUacs = $this->resolveArticleMappedUacs($this->selectedArticle, $this->unitvalue);
        $this->uacs = $suggestedUacs;
        $this->autoSuggestedUacs = $suggestedUacs;
    }

    private function propertyRules(?int $ignorePropertyId = null): array
    {
        $propertyNoRule = Rule::unique('im_property', 'property_no');
        if ($ignorePropertyId) {
            $propertyNoRule = $propertyNoRule->ignore($ignorePropertyId);
        }

        return [
            'SelectedOffice' => 'required|integer|exists:office,id',
            'selectedEmployee' => 'required|integer|exists:employees,id',
            'selectedArticle' => 'required|integer|exists:im_article_name,id',
            'selectedArticleDescription' => 'required|integer|exists:im_article_description,id',
            'date_acquired' => 'required|date',
            'specification' => 'required|string|max:255',
            'propertynumber' => ['nullable', 'string', 'max:255', $propertyNoRule],
            'unitofmeasurement' => 'nullable|string|max:255',
            'unitvalue' => 'required|numeric|min:0',
            'quantitypercard' => 'nullable|numeric|min:0',
            'quantityphysicalcount' => 'nullable|numeric|min:0',
            'uacs' => 'nullable|string|max:255',
            'fundCluster' => 'nullable|string|max:255',
            'estimatedUsefulLife' => 'nullable|string|max:255',
            'remarksSelection' => $this->useCustomRemarks ? 'nullable|string|max:255' : 'required|string|max:255',
            'remarks' => $this->useCustomRemarks ? 'required|string|max:255' : 'required|string|max:255',
        ];
    }

    private function propertyMessages(): array
    {
        return [
            'SelectedOffice.required' => 'Please select an office',
            'SelectedOffice.integer' => 'Office selection is invalid',
            'SelectedOffice.exists' => 'Selected office does not exist',
            'selectedEmployee.required' => 'Please select an employee',
            'selectedEmployee.integer' => 'Employee selection is invalid',
            'selectedEmployee.exists' => 'Selected employee does not exist',
            'selectedArticle.required' => 'Please select an article',
            'selectedArticle.integer' => 'Article selection is invalid',
            'selectedArticle.exists' => 'Selected article does not exist',
            'selectedArticleDescription.required' => 'Please select an article description',
            'selectedArticleDescription.integer' => 'Description selection is invalid',
            'selectedArticleDescription.exists' => 'Selected description does not exist',
            'date_acquired.required' => 'Please enter a date acquired',
            'date_acquired.date' => 'Date acquired must be a valid date',
            'specification.required' => 'Please enter a specification',
            'propertynumber.unique' => 'Property number already exists',
            'unitofmeasurement.max' => 'Unit of measurement must not exceed 255 characters',
            'unitvalue.required' => 'Please enter a unit value',
            'unitvalue.numeric' => 'Unit value must be numeric',
            'unitvalue.min' => 'Unit value cannot be negative',
            'quantitypercard.numeric' => 'Quantity per property card must be numeric',
            'quantitypercard.min' => 'Quantity per property card cannot be negative',
            'quantityphysicalcount.numeric' => 'Quantity per physical count must be numeric',
            'quantityphysicalcount.min' => 'Quantity per physical count cannot be negative',
            'uacs.max' => 'UACS must not exceed 255 characters',
            'fundCluster.max' => 'Fund cluster must not exceed 255 characters',
            'estimatedUsefulLife.max' => 'Estimated useful life must not exceed 255 characters',
            'remarksSelection.required' => 'Please select remarks',
            'remarks.required' => 'Please enter remarks',
        ];
    }

    private function preparePropertyPayload(): void
    {
        $this->propertynumber = $this->normalizeText($this->propertynumber);
        $this->specification = $this->normalizeText($this->specification);
        $this->unitofmeasurement = $this->normalizeText($this->unitofmeasurement);
        $this->fundCluster = $this->normalizeText($this->fundCluster);
        $this->estimatedUsefulLife = $this->normalizeText($this->estimatedUsefulLife);
        $this->syncRemarksValue();
        $this->unitvalue = $this->normalizeNumber($this->unitvalue);
        $this->quantitypercard = $this->normalizeNumber($this->quantitypercard);
        $this->quantityphysicalcount = $this->normalizeNumber($this->quantityphysicalcount);
        $this->uacs = $this->normalizeText($this->uacs);
        $this->syncSuggestedUacs();
    }

    private function syncRemarksValue(): void
    {
        if ($this->useCustomRemarks) {
            $this->remarks = $this->normalizeText($this->remarks);
            return;
        }

        $this->remarks = $this->normalizeText($this->remarksSelection);
    }

    private function validateRelationIntegrity(): bool
    {
        $descriptionMatchesArticle = ArticleDescription::where('id', (int) $this->selectedArticleDescription)
            ->where('article_id', (int) $this->selectedArticle)
            ->exists();
        if (! $descriptionMatchesArticle) {
            $this->addError('selectedArticleDescription', 'Selected description does not belong to the selected article.');
            return false;
        }

        $employeeMatchesOffice = Employee::where('id', (int) $this->selectedEmployee)
            ->where('officeid', (int) $this->SelectedOffice)
            ->where('empstatus', 'PERMANENT')
            ->where('is_retired', false)
            ->exists();
        if (! $employeeMatchesOffice) {
            $this->addError('selectedEmployee', 'Selected accountable officer does not belong to the selected office.');
            return false;
        }

        return true;
    }

    private function fillPropertyModel(Property $property): void
    {
        $property->article_id = (int) $this->selectedArticle;
        $property->article_description = (int) $this->selectedArticleDescription;
        $property->specification = $this->specification;
        $property->property_no = $this->propertynumber !== '' ? $this->propertynumber : null;
        $property->unit_of_measurement = $this->unitofmeasurement !== '' ? $this->unitofmeasurement : null;
        $property->unit_value = $this->unitvalue;
        $property->quantity_per_card = $this->quantitypercard;
        $property->quantity_per_count = $this->quantityphysicalcount;
        $property->uacs = $this->uacs !== '' ? $this->uacs : null;
        $property->fund_cluster = $this->fundCluster !== '' ? $this->fundCluster : null;
        $property->estimated_useful_life = $this->estimatedUsefulLife !== '' ? $this->estimatedUsefulLife : null;
        $property->remarks = $this->remarks;
        $property->office = (int) $this->SelectedOffice;
        $property->accountable_officer = (int) $this->selectedEmployee;
        $property->date_acquired = $this->date_acquired;
    }
}
