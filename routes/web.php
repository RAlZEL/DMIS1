<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\User\InventoryManagement\Report\OfficeArticle\Index as OfficeArticleReport;

Route::middleware(['auth'])->group(function () {
    Route::get('/user/inventory-management-system/report/office-article', OfficeArticleReport::class)
        ->name('user.inventory.report.office-article');
});