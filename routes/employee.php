<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;


Route::prefix('user')->name('user.')->group(function(){

        
    Route::middleware(['auth:web'],['revalidate'],['can:viewany,App\Models\Admin\EMS\Employee::class'])->group(function() {
        // Route::view('/Employee-Management-System','back.pages.admin.EMS.index')->name('EMS');
        Route::get('/employee-management-system',[App\Http\Controllers\MenuController::class, 'userEMS'])->name('EMS');
    });

});

Route::prefix('admin')->name('admin.')->group(function(){
 
    Route::middleware(['auth:web'],['revalidate'],['can:viewany,App\Models\User::class'])->group(function() {
        // Route::view('/Employee-Management-System','back.pages.admin.EMS.index')->name('EMS');
        Route::get('/employee-management-system',[App\Http\Controllers\MenuController::class, 'adminEMS'])->name('EMS');
        
    });
});