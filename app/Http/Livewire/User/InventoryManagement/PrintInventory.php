<?php

namespace App\Http\Livewire\User\InventoryManagement;

use Carbon\Carbon;
use App\Models\InventoryManagement\property;
use App\Models\InventoryManagement\article\articlename;
use App\Models\Admin\EMS\Employee;
use App\Models\Admin\AdminPanel\Category\Office;
use Livewire\Component;

class PrintInventory extends Component
{
    public $OfficeLists, $SelectedOffice;
    public $Employees,$selectedEmployee;

    public $articleids;
    public $articledesciptions;
    public $selectedArticle = null;
    public $selectedArticleDescription = null; 
    public $startdate, $enddate;
    public $perPage;
    public $Search;
    public $all_property;

    public $employeeName, $employeeOffice;

    public $article, $office, $specification, $propertynumber, $unitofmeasurement, $unitvalue, $quantitypercard, $quantityphysicalcount, $remarks, $date_acquired;

  



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
    
    public function searchDTR() {
        $this->validate([
            'selectedOffice' => 'required',
            'selectedArticle' => 'required',            
            'startdate' => 'required',  
            'enddate' => 'required', 
        ], [
            'selectedOffice.required' => 'Office field is required.',
            'selectedArticle.required' => 'Article field is required.',
            'startdate.required' => 'Start Date field is required.',
            'enddate.required' => 'End Date field is required.',
        ]);   

       if ($this->startdate > $this->enddate) {
        $this->showToastr('Invalid date range.','error');
       }
       else 
       {

        $PropertyLists = property::where('article_id', $this->selectedArticle)->whereBetween('date', [$this->startdate,$this->enddate])->get();
            if ($PropertyLists) 
            {   
                $startDate = new Carbon($this->startdate);
                $endDate = new Carbon($this->enddate);
       
          
                $this->all_property = array();
                while ($startDate->lte($endDate)){


                    $Date = Carbon::createFromDate($startDate)->format('m/d/Y');
                   
                   

                   
                   
                       
                   // $this->all_property[] = array($Date,$this->time1, $this->time2, $this->time3, $this->time4, $this->Late,$this->Undetime, $this->remarks);
               
                    $this->remarks = null;
                    $startDate->addDay(); 
                }
            }
       
        }
       
    }

    public function showToastr($message, $type) {
        return $this->dispatchBrowserEvent('showToastr',[
            'type'=>$type,
            'message'=>$message
        ]);
    }

    public function render()
    {
        return view('livewire.user.inventory-management.print-inventory');
    }

}