<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Water\StoreWaterDayRequest;
use App\Http\Requests\Water\UpdateRequest;
use App\Http\Requests\Water\UpdateWaterDayRequest;
use App\Models\User;
use App\Models\Water;
use App\Services\WaterService;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class WaterController extends Controller
{
    protected $water;

    public function __construct(WaterService $water)
    {
        $this->water = $water;
    }

    public function storeWaterDay(StoreWaterDayRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $this->water->storeWaterDay($data);
        return redirect()->route('waterDays.show',$data['users_id'])->with('success','Добавленно');
    }
    public function destroy(Water $offer): RedirectResponse
    {
        $offer->delete();
        return redirect()->route('offer.index')->with('error','Удаленно');
    }

    public function index()
    {
        return view('waterControl.userList')->with(['water' => User::with('water')->paginate(3)]);
    }

    public function userSearch(Request $request)
    {
        $search = $request->input('search');
        $users = User::where('name', 'like', '%'.$search.'%')
            ->orWhere('surname', 'like', '%'.$search.'%')
            ->paginate(10);

        return view('waterControl.userList')->with(['water'=>$users]);
    }
    public function waterSearch(Request $request)
    {
        $userId = $request->input('users_id');
        $search = $request->input('date');
        $user = User::findOrFail($request->input('users_id'));
        $waters = Water::where('date', 'like', '%'.$search.'%')
            ->where('users_id',$userId )
            ->paginate(10);
        return view('waterControl.waterList')->with(['waters'=>$waters,'user'=>$user]);
    }


    public function create($users_id)
    {
        return view('waterControl.create',compact('users_id'));
    }

//    public function store(StoreRequest $request): RedirectResponse
//    {
//        $data = $request->validated();
//        $this->water->store($data);
//        return redirect()->route('offer.index')->with('success','Успешно созданно');
//    }
//
    public function update(UpdateWaterDayRequest $request, Water $waterDay): RedirectResponse
    {
        $data = $request->validated();
        $this->water->updateWaterDay($data,$waterDay);
        return redirect()->route('waterDays.show',$waterDay->users_id)->with('success','Обновленно');
    }

    public function showWaterDays(User $user)
    {
        $waters = Water::query()->where('users_id',$user->id)->with('user')->paginate(3);
        return view('waterControl.waterList',compact('waters','user'));
    }

    public function editWaterDay(Water $waterDay)
    {
        return view('waterControl.waterDayEdit',compact('waterDay'));
    }

    public function destroyWaterDay(Water $waterDay): RedirectResponse
    {
        $waterDay->forceDelete();
        return back()->with('error', 'Удалено');
    }
}
