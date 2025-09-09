<?php

use App\Http\Controllers\DocumentTracking\User\HomeController as UserController;
use App\Http\Controllers\DocumentTracking\User\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Livewire\User\DocumentTracking\View;


Route::prefix('user/document-tracking')->name('document-tracking.')->group(function(){
           
    Route::middleware(['auth:web'],['revalidate'],['can:viewany,App\Models\User::class'])->group(function() {
        Route::get('/',[UserController::class,'index'])->name('userhome');   
        Route::view('/create','back.pages.user.document-tracking.create')->name('usercreatedocument');
        Route::get('/view/{id}',[App\Http\Controllers\MenuController::class, 'viewDocument'])->name('view');
        Route::get('/attachment/{id}',[UserController::class, 'viewAttachment'])->name('attachmentview');
        Route::get('/print/{id}',[UserController::class, 'printDocument'])->name('documentprint');
    });
});