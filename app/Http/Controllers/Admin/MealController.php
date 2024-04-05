<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Meal\MealRequest;
use App\Models\Meal;
use App\Models\User;
use App\Services\MealService;
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


    /**
     * Display the specified resource.
     */
    public function show(Meal $meal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Meal $meal)
    {
        return view('meal.edit',compact('meal'));
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
