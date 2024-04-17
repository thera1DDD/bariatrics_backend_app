<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\MealController;
use App\Http\Controllers\Admin\RoutingController;
use App\Http\Controllers\Admin\StepController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WaterController;
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
    Route::get('/',[HomeController::class,'index'])->name('home.index');
    Route::get('/chart',[HomeController::class,'routesChart'])->name('home.index.chart');

    Route::group(['prefix'=>'meals',],function (){
        Route::group(['prefix'=>'mealsProducts',],function (){
            Route::get('/{meal}/show',[MealController::class, 'showProducts'])->name('mealsProduct.index');
            Route::delete('{mealsProduct}',[MealController::class,'destroyProduct'])->name('mealsProduct.delete');
            Route::put('{mealsProduct}',[MealController::class, 'updateProduct'])->name('mealsProduct.update');
            Route::get('/{mealsProduct}/edit',[MealController::class, 'editProduct'])->name('mealsProduct.edit');
            Route::post('/store', [MealController::class, 'storeProduct'])->name('mealsProduct.store');
            Route::get('/{meal}/create', [MealController::class, 'createProduct'])->name('mealProduct.create');
            Route::get('/{category}/getFoods', [MealController::class, 'getFoodsByCategory'])->name('mealsProduct.by.category');
        });
        Route::put('{meal}',[MealController::class, 'update'])->name('meal.update');
        Route::post('/store', [MealController::class, 'storeMeal'])->name('meal.store');
        Route::delete('{meal}',[MealController::class,'destroyMeal'])->name('meal.delete');
        Route::get('/',[MealController::class,'index'])->name('userList.meal');
        Route::get('/{user}/show',[MealController::class, 'showMeals'])->name('meal.index');
        Route::get('/{user}/create', [MealController::class, 'createMeal'])->name('meal.create');
        Route::get('/{meal}/edit',[MealController::class, 'edit'])->name('meal.edit');
        Route::get('/search',[MealController::class,'userSearch'])->name('userList.search.meal');
//        Route::get('/daySearch',[MealController::class,'meals'])->name('meal.search');
    });
    Route::group(['prefix'=>'categories',],function (){
        Route::delete('{category}',[CategoryController::class,'destroy'])->name('category.delete');
        Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/{category}/edit',[CategoryController::class, 'edit'])->name('category.edit');
        Route::put('/{category}/update',[CategoryController::class, 'update'])->name('category.update');
        Route::delete('{food}',[CategoryController::class,'destroyFood'])->name('food.delete');
        Route::get('/{food}/foodEdit',[CategoryController::class, 'editFood'])->name('food.edit');
        Route::post('/storeFood', [CategoryController::class, 'storeFood'])->name('food.store');
        Route::put('/{food}', [CategoryController::class, 'updateFood'])->name('food.update');
        Route::get('/{category}/create', [CategoryController::class, 'createFood'])->name('food.create');
        Route::get('/{category}/show',[CategoryController::class, 'showCategoryFoods'])->name('food.show');
        Route::get('/',[CategoryController::class,'index'])->name('category.index');

    });

    Route::group(['prefix'=>'routes',],function (){
        Route::get('/',[RoutingController::class,'index'])->name('routing.index');
        Route::delete('{routing}',[RoutingController::class,'destroy'])->name('routing.delete');
        Route::get('/create', [RoutingController::class, 'create'])->name('routing.create');
        Route::post('/store', [RoutingController::class, 'store'])->name('routing.store');
        Route::get('/{routing}/edit',[RoutingController::class, 'edit'])->name('routing.edit');
        Route::put('{routing}',[RoutingController::class, 'update'])->name('routing.update');
    });


    Route::group(['prefix'=>'waterControl',],function (){
        Route::get('/',[WaterController::class,'index'])->name('userList.water');
        Route::get('/search',[WaterController::class,'userSearch'])->name('userList.search.water');
        Route::get('/daySearch',[WaterController::class,'waterSearch'])->name('waterList.search');
        Route::delete('{waterDay}',[WaterController::class,'destroyWaterDay'])->name('waterDays.delete');
        Route::get('/{users_id}/create', [WaterController::class, 'create'])->name('waterDay.create');
        Route::post('/store', [WaterController::class, 'storeWaterDay'])->name('waterDay.store');
        Route::get('/{user}/show',[WaterController::class, 'showWaterDays'])->name('waterDays.show');
        Route::get('/{waterDay}/edit',[WaterController::class, 'editWaterDay'])->name('waterDays.edit');
        Route::put('{waterDay}',[WaterController::class, 'update'])->name('waterDay.update');
    });
    Route::group(['prefix'=>'stepControl',],function (){
        Route::get('/',[StepController::class,'userListindex'])->name('userList.step');
        Route::get('/search',[StepController::class,'userSearch'])->name('userList.search.step');
        Route::get('/daySearch',[StepController::class,'stepDaySearch'])->name('stepList.search');
        Route::delete('{stepDay}',[StepController::class,'destroyStepDay'])->name('stepDay.delete');
        Route::get('/{users_id}/create', [StepController::class, 'create'])->name('stepDay.create');
        Route::post('/store', [StepController::class, 'storeDay'])->name('stepDay.store');
        Route::get('/{user}/show',[StepController::class, 'showStepDays'])->name('stepDays.show');
        Route::get('/{stepDay}/edit',[StepController::class, 'editStepDay'])->name('stepDays.edit');
        Route::put('{stepDay}',[StepController::class, 'updateDay'])->name('stepDay.update');
    });

    Route::group(['prefix'=>'profile',],function (){
        Route::get('/',[\App\Http\Controllers\Admin\ProfileController::class,'index'])->name('profile.index');
        Route::put('{currentUser}',[\App\Http\Controllers\Admin\ProfileController::class,'update'])->name('profile.update');
        Route::get('/logout',[\App\Http\Controllers\Admin\ProfileController::class,'destroy'])->name('profile.logout');
    });

    Route::group(['prefix'=>'users',],function (){
        Route::get('/',[UserController::class,'index'])->name('user.index');
        Route::delete('{user}',[UserController::class,'destroy'])->name('user.delete');
        Route::get('/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/store', [UserController::class, 'store'])->name('user.store');
        Route::get('/{user}/edit',[UserController::class, 'edit'])->name('user.edit');
        Route::put('{user}',[UserController::class, 'update'])->name('user.update');
    });


//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
