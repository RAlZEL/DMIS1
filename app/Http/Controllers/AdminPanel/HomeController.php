<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index (Request $request){
        $this->authorize('viewany', App\Models\User::class);
        return view('back.pages.admin.admin-panel.home');
    }
}
