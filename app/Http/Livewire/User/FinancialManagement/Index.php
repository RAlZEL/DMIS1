<?php

namespace App\Http\Livewire\User\FinancialManagement;

use App\Models\Admin\AdminPanel\FinancialManagement\Office;
use App\Models\FinancialManagement\voucher;
use Livewire\Component;

class Index extends Component
{

    
    public function render()
    {
        return view('livewire.user.financial-management.index',[
            'Vouchers' => voucher::orderby('created_at','asc')->get(),
        ]);
    }
}
