<?php
use App\Livewire\User\InventoryManagement\Report\OfficeArticle\Index;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
	Route::get('/user/inventory-management-system/report/office-article', Index::class)
		->name('user.inventory.report.office-article');
});
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[MenuController::class,'userindex']);
use App\Livewire\User\InventoryManagement\Report\OfficeArticle\Index;

Route::middleware(['auth'])->group(function () {
	Route::get('/user/inventory-management-system/report/office-article', Index::class)
		->name('user.inventory.report.office-article');
});
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('back.pages.auth.login');
// });

Route::get('/',[MenuController::class,'userindex']);
// Route::get('/', ['middleware' =>'guest', function(){
//     return view('auth.login');
//   }]);
// Route::get('/',[MenuController::class,'userindex']);

// Route::get('/login', function () {
//     return view('auth.login');
// });





