<?php

namespace App\Http\Livewire\User\InventoryManagement\Print;


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


    public function render()
    {
        return view('livewire.user.inventory-management.print.index');
    }
}