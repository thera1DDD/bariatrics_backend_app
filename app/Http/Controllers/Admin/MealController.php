<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Meal\MealRequest;
use App\Http\Requests\MealsFood\MealFoodRequest;
use App\Models\Category;
use App\Models\Food;
use App\Models\Meal;
use App\Models\MealsFood;
use App\Models\User;
use App\Services\MealService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MealController extends Controller
{


    protected $mealService;

    public function __construct(MealService $mealService)
    {
        $this->mealService = $mealService;
    }
    /**
     * Display a listing of the resource.
     */

    public function destroyProduct(MealsFood $mealsProduct): RedirectResponse
    {
        $mealsProduct->forceDelete();
        return back()->with('error', 'Удалено');

    }
    public function updateProduct(MealsFood $mealsProduct,MealFoodRequest $request): RedirectResponse
    {
        $mealsProduct->update($request->validated());
        return redirect()->route('mealsProduct.index',$mealsProduct->meals_id)->with('success','Обновленно');
    }


    public function getFoodsByCategory($category_id): JsonResponse
    {
        $mealsFood = Food::query()->select('id','name')->where('category_id',$category_id)->get();
        return response()->json($mealsFood);
    }
    public function index()
    {
        return view('meal.userList')->with(['users' => User::with('meal')->paginate(3)]);
    }

    public function showMeals(User $user)
    {
        $meals = Meal::query()->where('users_id',$user->id)->with('user')->paginate(3);
        $mealTranslations = $this->mealService->translateType();
        return view('meal.index',compact('meals','user','mealTranslations'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function createProduct(Meal $meal)
    {
        return view('meal.MealsProduct.create',with([
            'meal' => $meal,
            'food'=> Food::query()->select('id','name')->limit(1)->first(),
            'categories'=> Category::query()->select('id','name')->get()]));
    }
    public function createMeal(User $user)
    {
        return view('meal.create',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeMeal(MealRequest $request)
    {
        $data = $request->validated();
        $mealTranslations = $this->mealService->translateType();
        $this->mealService->store($data);
        return redirect()->route('meal.index',$data['users_id'])->with('success','Добавленно');

    }

    public function storeProduct(MealFoodRequest $request)
    {
        MealsFood::firstOrCreate($request->validated());
        return redirect()->route('mealsProduct.index',$request->meals_id)->with('success','Обновленно');
    }


    /**
     * Display the specified resource.
     */
    public function showProducts(Meal $meal)
    {
        $mealsProducts = MealsFood::query()->where('meals_id',$meal->id)->with('food')->paginate(5);
        return view('meal.mealsProduct.index')->with(['mealsProducts' => $mealsProducts,'meals_id' => $meal->id]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editProduct(MealsFood $mealsProduct)
    {
        return view('meal.MealsProduct.edit',with([
            'mealsProduct' => $mealsProduct,
            'categories'=> Category::select('id','name')->get()]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MealRequest $request, Meal $meal)
    {
        $data = $request->validated();
        $this->mealService->update($data,$meal);
        return redirect()->route('meal.index',$meal->users_id)->with('success','Обновленно');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyMeal(Meal $meal): RedirectResponse
    {
        $meal->forceDelete();
        return back()->with('error', 'Удалено');
    }
}
