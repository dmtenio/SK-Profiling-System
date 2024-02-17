<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RegionController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\MunicipalityController;
use App\Http\Controllers\BarangayController;
use App\Http\Controllers\PurokController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OfficialController;
use App\Http\Controllers\ResidentController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register'=>false]);
// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('profile/{id}', [UserController::class, 'showprofile'])->name('profile.edit');
// Route::patch('update-profile/{id}', [UserController::class, 'updateprofile'])->name('update.profile');
// Route::post('/change-password', [UserController::class, 'changePassword'] )->name('change-password');

Route::middleware(['auth', 'checkUserRole:barangay_user,barangay_admin,municipal_admin,provincial_admin,super_admin'])->group(function () {
    Route::get('profile/{id}', [UserController::class, 'showprofile'])->name('profile.edit');
    Route::patch('update-profile/{id}', [UserController::class, 'updateprofile'])->name('update.profile');
    Route::post('/change-password', [UserController::class, 'changePassword'])->name('change-password');
});

Route::get('get-provinces/{region_id}', [ResidentController::class, 'getProvinces']);
Route::get('get-municipalities/{province_id}', [ResidentController::class, 'getMunicipalities']);
Route::get('get-barangays/{municipality_id}', [ResidentController::class, 'getBarangays']);
Route::get('get-puroks/{barangay_id}', [ResidentController::class, 'getPuroks']);


// // Add a route to handle AJAX request for getting provinces based on the selected region
// Route::get('/get-provinces/{regionId}', [MunicipalityController::class, 'getProvinces']);

// Region routes
Route::resource('regions', RegionController::class)->names([
    'index' => 'regions.index',
    'show' => 'regions.show',
    'create' => 'regions.create',
    'store' => 'regions.store',
    'edit' => 'regions.edit',
    'update' => 'regions.update',
    'destroy' => 'regions.destroy',
]);

// Province routes
Route::resource('provinces', ProvinceController::class)->names([
    'index' => 'provinces.index',
    'show' => 'provinces.show',
    'create' => 'provinces.create',
    'store' => 'provinces.store',
    'edit' => 'provinces.edit',
    'update' => 'provinces.update',
    'destroy' => 'provinces.destroy',
]);

// Municipality routes
Route::resource('municipalities', MunicipalityController::class)->names([
    'index' => 'municipalities.index',
    'show' => 'municipalities.show',
    'create' => 'municipalities.create',
    'store' => 'municipalities.store',
    'edit' => 'municipalities.edit',
    'update' => 'municipalities.update',
    'destroy' => 'municipalities.destroy',
]);

// Barangay routes
Route::resource('barangays', BarangayController::class)->names([
    'index' => 'barangays.index',
    'show' => 'barangays.show',
    'create' => 'barangays.create',
    'store' => 'barangays.store',
    'edit' => 'barangays.edit',
    'update' => 'barangays.update',
    'destroy' => 'barangays.destroy',
]);

// Purok routes
Route::resource('puroks', PurokController::class)->names([
    'index' => 'puroks.index',
    'show' => 'puroks.show',
    'create' => 'puroks.create',
    'store' => 'puroks.store',
    'edit' => 'puroks.edit',
    'update' => 'puroks.update',
    'destroy' => 'puroks.destroy',
]);

// Position routes
Route::resource('positions', PositionController::class)->names([
    'index' => 'positions.index',
    'show' => 'positions.show',
    'create' => 'positions.create',
    'store' => 'positions.store',
    'edit' => 'positions.edit',
    'update' => 'positions.update',
    'destroy' => 'positions.destroy',
]);


// User routes with middleware
Route::middleware(['auth', 'checkUserRole:barangay_admin,municipal_admin,provincial_admin,super_admin'])
    ->resource('users', UserController::class)
    ->names([
        'index' => 'users.index',
        'show' => 'users.show',
        'create' => 'users.create',
        'store' => 'users.store',
        'edit' => 'users.edit',
        'update' => 'users.update',
        'destroy' => 'users.destroy',
    ]);


// Official routes
Route::resource('officials', OfficialController::class)->names([
    'index' => 'officials.index',
    'show' => 'officials.show',
    'create' => 'officials.create',
    'store' => 'officials.store',
    'edit' => 'officials.edit',
    'update' => 'officials.update',
    'destroy' => 'officials.destroy',
]);

Route::get('resident/youth/entry', [ResidentController::class, 'entry'])->name('residents.entry');

// Resident routes
Route::resource('residents', ResidentController::class)->names([
    'index' => 'residents.index',
    'show' => 'residents.show',
    'create' => 'residents.create',
    'store' => 'residents.store',
    'edit' => 'residents.edit',
    'update' => 'residents.update',
    'destroy' => 'residents.destroy',
]);
