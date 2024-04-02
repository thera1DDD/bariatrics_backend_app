<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/',[\App\Http\Controllers\Admin\HomeController::class,'index'])->name('home.index');
    Route::get('/chart',[\App\Http\Controllers\Admin\HomeController::class,'routesChart'])->name('home.index.chart');


    Route::group(['prefix'=>'categories',],function (){
        Route::get('/',[\App\Http\Controllers\Admin\CategoryController::class,'index'])->name('category.index');
        Route::delete('{category}',[\App\Http\Controllers\Admin\CategoryController::class,'destroy'])->name('category.delete');
        Route::get('/create', [\App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('category.create');
        Route::post('/store', [\App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('category.store');
        Route::get('/{category}/edit',[\App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('category.edit');
        Route::put('{category}',[\App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('category.update');
    });

    Route::group(['prefix'=>'routes',],function (){
        Route::get('/',[\App\Http\Controllers\Admin\RoutingController::class,'index'])->name('routing.index');
        Route::delete('{routing}',[\App\Http\Controllers\Admin\RoutingController::class,'destroy'])->name('routing.delete');
        Route::get('/create', [\App\Http\Controllers\Admin\RoutingController::class, 'create'])->name('routing.create');
        Route::post('/store', [\App\Http\Controllers\Admin\RoutingController::class, 'store'])->name('routing.store');
        Route::get('/{routing}/edit',[\App\Http\Controllers\Admin\RoutingController::class, 'edit'])->name('routing.edit');
        Route::put('{routing}',[\App\Http\Controllers\Admin\RoutingController::class, 'update'])->name('routing.update');
    });


    Route::group(['prefix'=>'waterControl',],function (){
        Route::get('/',[\App\Http\Controllers\Admin\WaterController::class,'index'])->name('userList.water');
        Route::get('/search',[\App\Http\Controllers\Admin\WaterController::class,'userSearch'])->name('userList.search.water');
        Route::get('/daySearch',[\App\Http\Controllers\Admin\WaterController::class,'waterSearch'])->name('waterList.search');
        Route::delete('{waterDay}',[\App\Http\Controllers\Admin\WaterController::class,'destroyWaterDay'])->name('waterDays.delete');
        Route::get('/{users_id}/create', [\App\Http\Controllers\Admin\WaterController::class, 'create'])->name('waterDay.create');
        Route::post('/store', [\App\Http\Controllers\Admin\WaterController::class, 'storeWaterDay'])->name('waterDay.store');
        Route::get('/{user}/show',[\App\Http\Controllers\Admin\WaterController::class, 'showWaterDays'])->name('waterDays.show');
        Route::get('/{waterDay}/edit',[\App\Http\Controllers\Admin\WaterController::class, 'editWaterDay'])->name('waterDays.edit');
        Route::put('{waterDay}',[\App\Http\Controllers\Admin\WaterController::class, 'update'])->name('waterDay.update');
    });
    Route::group(['prefix'=>'stepControl',],function (){
        Route::get('/',[\App\Http\Controllers\Admin\StepController::class,'userListindex'])->name('userList.step');
        Route::get('/search',[\App\Http\Controllers\Admin\StepController::class,'userSearch'])->name('userList.search.step');
        Route::get('/daySearch',[\App\Http\Controllers\Admin\StepController::class,'stepDaySearch'])->name('stepList.search');
        Route::delete('{stepDay}',[\App\Http\Controllers\Admin\StepController::class,'destroyStepDay'])->name('stepDay.delete');
        Route::get('/{users_id}/create', [\App\Http\Controllers\Admin\StepController::class, 'create'])->name('stepDay.create');
        Route::post('/store', [\App\Http\Controllers\Admin\StepController::class, 'storeDay'])->name('stepDay.store');
        Route::get('/{user}/show',[\App\Http\Controllers\Admin\StepController::class, 'showStepDays'])->name('stepDays.show');
        Route::get('/{stepDay}/edit',[\App\Http\Controllers\Admin\StepController::class, 'editStepDay'])->name('stepDays.edit');
        Route::put('{stepDay}',[\App\Http\Controllers\Admin\StepController::class, 'updateDay'])->name('stepDay.update');
    });

    Route::group(['prefix'=>'profile',],function (){
        Route::get('/',[\App\Http\Controllers\Admin\ProfileController::class,'index'])->name('profile.index');
        Route::put('{currentUser}',[\App\Http\Controllers\Admin\ProfileController::class,'update'])->name('profile.update');
        Route::get('/logout',[\App\Http\Controllers\Admin\ProfileController::class,'destroy'])->name('profile.logout');
    });

    Route::group(['prefix'=>'users',],function (){
        Route::get('/',[\App\Http\Controllers\Admin\UserController::class,'index'])->name('user.index');
        Route::delete('{user}',[\App\Http\Controllers\Admin\UserController::class,'destroy'])->name('user.delete');
        Route::get('/create', [\App\Http\Controllers\Admin\UserController::class, 'create'])->name('user.create');
        Route::post('/store', [\App\Http\Controllers\Admin\UserController::class, 'store'])->name('user.store');
        Route::get('/{user}/edit',[\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('user.edit');
        Route::put('{user}',[\App\Http\Controllers\Admin\UserController::class, 'update'])->name('user.update');
    });


//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
