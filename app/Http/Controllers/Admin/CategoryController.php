<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryRequest;
use App\Http\Requests\Food\FoodRequest;
use App\Models\Category;
use App\Models\Food;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function destroyFood(Food $food): RedirectResponse
    {
        $food->forceDelete();
        return redirect()->route('food.show',$food->category_id)->with('success','Успешно удаленно');
    }
    public function editFood(Food $food)
    {
        return view('categories.food.edit',compact('food'));
    }
    public function createFood(Category $category)
    {
        return view('categories.food.create',compact('category'));
    }

    public function storeFood(FoodRequest $request)
    {
        Food::firstOrCreate($request->validated());
        return redirect()->route('food.show',$request->category_id)->with('success','Успешно добавленно');
    }
    public function updateFood(FoodRequest $request, Food $food)
    {
        $food->update($request->validated());
        return redirect()->route('food.show',$request->category_id)->with('success','Успешно обновленно');
    }
    public function showCategoryFoods(Category $category)
    {
        $foods = Food::query()->where('category_id',$category->id)->paginate(5);
        return view('categories.food.index',compact('foods','category'));
    }

    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('categories.index')->with(['categories' => Category::select('id','name','description')->paginate(7)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        Category::firstOrCreate($request->validated());
        return redirect()->route('category.index')->with('success','Успешно созданно');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
       return view('categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());
        return redirect()->route('category.index')->with('success','Успешно обновленно');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $category->forceDelete();
        return view('categories.index')->with('error','Удаленно');
    }
}
