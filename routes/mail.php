<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Livewire\User\DocumentTracking\View;
use App\Http\Controllers\Mail\User\MailController;
use App\Http\Controllers\DocumentTracking\User\HomeController;
use App\Http\Controllers\DocumentTracking\User\HomeController as UserController;


Route::prefix('user/mail')->name('mail.')->group(function(){

    
           
    Route::middleware(['auth:web'],['revalidate'],['can:viewany,App\Models\User::class'])->group(function() {
            Route::get('/incoming',[MenuController::class,'userMail'])->name('userMail');   
            Route::get('/print-turnover/{id}',[MailController::class, 'printIncoming'])->name('printIncoming');
            Route::get('/rejected',[MailController::class,'rejectedIndex'])->name('rejectedIndex'); 
            Route::get('/processing',[MailController::class,'processingIndex'])->name('processingIndex');
            Route::get('/outgoing',[MailController::class,'outgoingIndex'])->name('outgoingIndex');
            Route::get('/closed',[MailController::class,'closedIndex'])->name('closedIndex');
            // Route::get('/assigned-task',[MailController::class,'assignedTask'])->name('assignedTask');

            Route::get('financial-management/incoming',[MenuController::class,'userFMMail'])->name('FMMail');   
            Route::get('financial-management/processing',[MailController::class,'processingIndexFM'])->name('processingIndexFM');
            Route::get('financial-management/rejected',[MailController::class,'rejectedIndexFM'])->name('rejectedIndexFM'); 
            Route::get('financial-management/outgoing',[MailController::class,'OutgoingIndexFM'])->name('outgoingIndexFM'); 
            Route::get('financial-management/ada',[MailController::class,'ADAFM'])->name('ADAFM'); 
            // Route::get('/incoming',[MenuController::class,'userMail'])->name('rejectedIndex');
            // Route::view('/create','back.pages.user.document-tracking.create')->name('usercreatedocument');
            // Route::get('/view/{id}',[App\Http\Controllers\MenuController::class, 'viewDocument'])->name('view');
            // Route::get('/attachment/{id}',[UserController::class, 'viewAttachment'])->name('attachmentview');
            // Route::get('/print/{id}',[UserController::class, 'printDocument'])->name('documentprint');
            Route::get('financial-management/print-turnover/{id}',[MailController::class, 'printFMManifest'])->name('printManifestFM');
    });
});