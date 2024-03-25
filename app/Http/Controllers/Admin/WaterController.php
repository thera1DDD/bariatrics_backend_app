<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Water;
use App\Services\WaterService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class WaterController extends Controller
{
    protected $water;

    public function __construct(WaterService $water)
    {
        $this->water = $water;
    }
    public function destroy(Water $offer): RedirectResponse
    {
        $offer->delete();
        return redirect()->route('offer.index')->with('error','Удаленно');
    }

    public function index()
    {
        return view('water.index')->with(['water' => User::with('water')->paginate(3)]);
    }

    public function create()
    {
        return view('offers.create')->with(['users' => User::select('id','name','route_role')->get(),'routings' => Routing::select('id','name')->get()]);
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $this->water->store($data);
        return redirect()->route('offer.index')->with('success','Успешно созданно');
    }

    public function update(UpdateRequest $request, Water $offer): RedirectResponse
    {
        $data = $request->validated();
        $this->water->update($data,$offer);
        return redirect()->route('offer.index')->with('success','Обновленно');
    }

    public function edit(Water $offer): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $users = User::select('id','name','route_role')->get();
        $routings = Routing::select('id','name')->get();
        return view('offers.edit',compact(['offer','users','routings']));
    }
}
