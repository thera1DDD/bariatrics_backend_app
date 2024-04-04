<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Meal;
use App\Models\User;
use App\Services\MealService;
use Illuminate\Http\Request;

class MealController extends Controller
{


    protected $waterService;

    public function __construct(MealService $waterService)
    {
        $this->waterService = $waterService;
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
        $mealTranslations = $this->waterService->translateType();
        return view('meal.index',compact('meals','user','mealTranslations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, Meal $meal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Meal $meal)
    {
        //
    }
}
