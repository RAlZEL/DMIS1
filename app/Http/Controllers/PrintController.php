<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function PrintDV($id) {

        // $this->authorize('printDV',App\Models\Voucher::class);
      
        dd($id);
    }


}
