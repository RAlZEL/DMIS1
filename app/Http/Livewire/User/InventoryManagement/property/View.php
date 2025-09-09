<?php

namespace App\Http\Livewire\User\InventoryManagement\Property;

use App\Models\FinancialManagement\Uacs as AccountingUACS;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\Admin\EMS\Employee;
use App\Models\FinancialManagement\Route;
use App\Models\FinancialManagement\voucher;
use App\Models\Admin\AdminPanel\Category\Office;
use App\Models\FinancialManagement\gaa\activity;
use App\Models\Admin\AdminPanel\Category\Division;
use App\Models\FinancialManagement\office\routeOffice;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\FinancialManagement\gaa\pap;
use App\Models\Admin\AdminPanel\ExpenseClass\ExpenseClass;
use App\Models\Admin\AdminPanel\FinancialManagement\Office as FMOffice;
use App\Models\FinancialManagement\AccountingEntry;
use App\Models\FinancialManagement\AccountTitle;
use App\Models\FinancialManagement\boxa;
use App\Models\FinancialManagement\BoxD;
use App\Models\FinancialManagement\Charging\GaaCharging;
use App\Models\FinancialManagement\Charging\GaaChargingUACS;
use App\Models\FinancialManagement\Charging\GaaChargingPAP;
use App\Models\FinancialManagement\Charging\SaaCharging;
use App\Models\FinancialManagement\CheckADA;
use App\Models\FinancialManagement\DVNumber;
use App\Models\FinancialManagement\gaa\allocation\pap as AllocationPap;
use App\Models\FinancialManagement\gaa\allocation\activity as AllocationActivity;
use App\Models\FinancialManagement\gaa\allocation\uacs as AllocationUACS;
use App\Models\FinancialManagement\ORS;
use App\Models\FinancialManagement\ReviewofDocuments;
use App\Models\FinancialManagement\saa\allocation\saa;
use App\Models\FinancialManagement\saa\allocation\saa as SaaAllocation;


class View extends Component
{



public function render()
    {
        return view('livewire.user.inventory-management.property.view');
    }
}