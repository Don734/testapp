<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserListController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\ReportController;
use App\Models\Table;

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

Auth::routes([
    'register' => false,
]);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('dashboard', ['coming' => Table::pluck('comingcur')->sum(), 'expens' => Table::pluck('expenscur')->sum(), 'balance' => Table::pluck('balancecur')->sum()]);
    });

    Route::get('dashboard', function () {
        return view('dashboard', ['coming' => Table::pluck('comingcur')->sum(), 'expens' => Table::pluck('expenscur')->sum(), 'balance' => Table::pluck('balancecur')->sum()]);
    });
    
    Route::resource('materials', TableController::class)->names([
        'store' => 'createTable',
        'destroy' => 'destroyTable'
    ]);
    Route::patch('materials/{material}', [TableController::class, 'updateExpens'])->name('updateExpens');
    
    Route::resource('reports', ReportController::class)->names([
        'destroy' => 'destroyReport'
    ]);
    
    Route::resource('users', UserListController::class)->names([
        'store' => 'createUser',
        'destroy' => 'destroyUser'
    ]);
    
    Route::resource('groups', GroupController::class)->names([
        'store' => 'createGroup',
        'destroy' => 'destroyGroup'
    ]);
    
    Route::get('settings', [UserController::class, 'show']);
    Route::put('settings', [UserController::class, 'updatePublicInfo'])->name('updatePublic');
    Route::post('settings', [UserController::class, 'updatePersonalInfo'])->name('updatePersonal');

    Route::get('/alltables', function () {
        return Table::all();
    });

    Route::post('notify-mark', function() {
        $user = Auth::user();

        $user->unreadNotifications->markAsRead();
    });

    Route::post('notify-delete', function(){
        $user = Auth::user();

        $user->notifications()->delete();
    });
    
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
});
