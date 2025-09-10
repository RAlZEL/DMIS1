<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;


Route::prefix('user')->name('user.')->group(function(){

        
    Route::middleware(['guest:web'])->group(function(){
        Route::view('/','back.pages.auth.login');
        Route::view('/login','back.pages.auth.login')->name('login');
        Route::view('/forgot-password','back.pages.auth.forgot')->name('forgot-password');
        Route::view('/request-account','back.pages.auth.request')->name('request-account');
    });
        
    Route::middleware(['auth:web'],['revalidate'])->group(function() {
        Route::get('/',[MenuController::class,'userindex']);
        Route::get('/home',[MenuController::class,'userindex'])->name('home');
        Route::post('/logout',[MenuController::class,'userlogout'])->name('logout');
        Route::view('/profile','back.pages.user.profile')->name('profile');
        Route::get('/inventory-management-system',[App\Http\Controllers\MenuController::class, 'userIM'])->name('IM');
        Route::get('/inventory-management-system/new-property',[App\Http\Controllers\MenuController::class, 'InventoryManagementCreateProperty'])->name('IMCreateProperty');        
        Route::get('/inventory-management-system/article/articlename',[App\Http\Controllers\MenuController::class, 'InventoryManagementArticle'])->name('InventoryManagementArticle');
        Route::get('/inventory-management-system/search-print/',[App\Http\Controllers\MenuController::class, 'UserInventoryPrint'])->name('inventoryPrint');


        Route::get('/financial-management-system',[App\Http\Controllers\MenuController::class, 'userFM'])->name('FM');
        Route::get('/financial-management-system/Allocation/gaa/pap',[App\Http\Controllers\MenuController::class, 'userAllocationPAP'])->name('allocationPAP');
        Route::get('/financial-management-system/Allocation/gaa/activity',[App\Http\Controllers\MenuController::class, 'userAllocationActivity'])->name('allocationActivity');
        Route::get('/financial-management-system/Allocation/gaa/uacs',[App\Http\Controllers\MenuController::class, 'userAllocationUACS'])->name('allocationUACS');
        Route::get('/financial-management-system/allocation/gaa/realignment-uacs',[App\Http\Controllers\MenuController::class, 'userRealignmentUACS'])->name('realignmentUACS');
        Route::get('/financial-management-system/account/accountname',[App\Http\Controllers\MenuController::class, 'FinancialManagementAccount'])->name('FinancialManagementAccount');
        Route::get('/financial-management-system/new-voucher',[App\Http\Controllers\MenuController::class, 'FinancialManagementCreateVoucher'])->name('FMCreateVoucher');
        Route::get('/financial-management-system/view/{id}',[App\Http\Controllers\MenuController::class, 'viewVoucher'])->name('viewVoucher');
        Route::get('/financial-management-system/saa/',[App\Http\Controllers\MenuController::class, 'SAAAllocation'])->name('saaAllocation');
        // Route::view('/financial-management/accounting-entry/account-title','')->name('AccountingTitle');

        Route::get('/financial-management-system/Accounting-Entry/Account-Title',[App\Http\Controllers\MenuController::class, 'AccountingTitle'])->name('AccountingTitle');
        Route::get('/financial-management-system/Accounting-Entry/UACS',[App\Http\Controllers\MenuController::class, 'AccountingUACS'])->name('AccountingUACS');

        Route::get('/financial-management-system/Report/per-activity',[App\Http\Controllers\MenuController::class, 'FinancialPerActivityReport'])->name('FinancialPerActivityReport');
        Route::get('/financial-management-system/Report/per-uacs',[App\Http\Controllers\MenuController::class, 'FinancialPerUACSReport'])->name('FinancialPerUACSReport');
        Route::get('/financial-management-system/Report/per-pap',[App\Http\Controllers\MenuController::class, 'FinancialPerPAPReport'])->name('FinancialPerPAPReport');
        Route::get('/financial-management-system/Report/per-realignment',[App\Http\Controllers\MenuController::class, 'FinancialPerRealignmentReport'])->name('FinancialPerRealignmentReport');

        Route::get('/financial-management-system/print-dv/{id}',[App\Http\Controllers\MenuController::class, 'financialDVPrint'])->name('financialDVPrint');


        Route::get('/daily-time-record',[App\Http\Controllers\MenuController::class, 'UserDailyTimeRecord'])->name('dtrHome');
        
        Route::get('/my-daily-time-record',[App\Http\Controllers\MenuController::class, 'UserMyDailyTimeRecord'])->name('mydtrHome');

        Route::get('/daily-time-record/upload',[App\Http\Controllers\MenuController::class, 'UserDTRUpload'])->name('uploadDTR');
        Route::get('/daily-time-record/biometric-setup',[App\Http\Controllers\MenuController::class, 'UserBio'])->name('UserBio');
        Route::get('/daily-time-record/search-print/',[App\Http\Controllers\MenuController::class, 'UserDTRPrint'])->name('dtrPrint');
        Route::get('/daily-time-record/new',[App\Http\Controllers\MenuController::class, 'UserDTRAdd'])->name('AddDTR');
        Route::get('/daily-time-record/print/{id}',[App\Http\Controllers\MenuController::class, 'UserFinalPrint'])->name('UserPrintDTR');

        Route::get('/event-management-system',[App\Http\Controllers\MenuController::class, 'UserEvent'])->name('Event');

        Route::get('/task-management-system',[App\Http\Controllers\MenuController::class, 'UserTask'])->name('Task');
        Route::get('/announcement-management-system',[App\Http\Controllers\MenuController::class, 'UserAnnouncement'])->name('Announcement');
        Route::get('/memorandum-creator',[App\Http\Controllers\MenuController::class, 'MemoCreator'])->name('MemoCreator');
        Route::view('/memorandum-creator/create','back.pages.user.memo-creator.create')->name('MemoCreate');
        
    });
});

Route::prefix('admin')->name('admin.')->group(function(){

    Route::middleware(['guest:web'])->group(function(){
        Route::view('/login','back.pages.auth.admin.login')->name('login');

    });
        
   
    Route::middleware(['auth:web'],['revalidate'])->group(function() {
        Route::get('/',[MenuController::class,'adminindex'])->name('home');
        Route::post('/logout',[MenuController::class,'adminlogout'])->name('logout');
        Route::view('/profile','back.pages.admin.profile')->name('profile');
        // Route::view('/User-Management-System','back.pages.admin.UMS.index')->name('UMS');
        Route::get('/user-management-system',[App\Http\Controllers\MenuController::class, 'adminUMS'])->name('UMS');
        Route::get('/document-tracking-system',[App\Http\Controllers\MenuController::class, 'adminDocumentTracking'])->name('documentTracking');
        Route::get('/document-tracking-system/view/{id}',[App\Http\Controllers\MenuController::class, 'viewDocumentAdmin'])->name('DocumentView');
        Route::get('/user-management-system/user-role',[App\Http\Controllers\MenuController::class, 'adminUserRole'])->name('userrole');
        Route::get('/financial-management',[App\Http\Controllers\MenuController::class, 'adminFinancialManagement'])->name('financialManagement');
     

        
    });
});