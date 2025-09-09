<?php

use App\Http\Controllers\AdminPanel\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;


Route::prefix('admin/admin-panel')->name('admin-panel.')->group(function(){
           
    Route::middleware(['auth:web'],['revalidate'],['can:viewany,App\Models\User::class'])->group(function() {
        Route::get('/admin-panel',[HomeController::class,'index'])->name('home');   
        Route::view( '/officer-in-charge','back.pages.admin.admin-panel.oic.index')->name('OIC');
        Route::view('/office/create-office','back.pages.admin.admin-panel.office.index')->name('createoffice');
        Route::view('/category/office','back.pages.admin.admin-panel.categories.office.index')->name('officecategory');
        Route::view('/category/division','back.pages.admin.admin-panel.categories.division.index')->name('divisioncategory');
        Route::view('/category/unit','back.pages.admin.admin-panel.categories.unit.index')->name('unitcategory');

        Route::view('/financial-management/expense-class','back.pages.admin.admin-panel.expense-class.index')->name('expenseClass');
        Route::view('/financial-management/routing-office','back.pages.admin.admin-panel.route-office.index')->name('routingOffice');
        Route::view('/financial-management/office','back.pages.admin.admin-panel.fm-office.index')->name('fmOffice');

        Route::view('/role','back.pages.admin.admin-panel.role.index')->name('role');
        Route::view( '/financial-management/signatories/box-a','back.pages.admin.admin-panel.boxa.index')->name('box-a');

     
    });
});