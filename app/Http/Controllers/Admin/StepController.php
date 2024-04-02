<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Offer\StoreRequest;
use App\Http\Requests\Step\UpdateRequest;
use App\Models\Step;
use App\Models\User;
use App\Services\StepService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class StepController extends Controller
{
    protected $step;

    public function __construct(StepService $step)
    {
        $this->step = $step;
    }

    public function storeDay(\App\Http\Requests\Step\StoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $this->step->storeDay($data);
        return redirect()->route('stepDays.show',$data['users_id'])->with('success','Добавленно');
    }
    public function destroy(Step $step): RedirectResponse
    {
        $step->delete();
        return redirect()->route('stepDays.show',$step->users_id)->with('success','Удаленно');
    }

    public function userListindex()
    {
        return view('stepControl.userList')
            ->with(['users' => User::with('step')
            ->paginate(3)]);
    }

    public function userSearch(Request $request)
    {
        $search = $request->input('search');
        $users = User::where('name', 'like', '%'.$search.'%')
            ->orWhere('surname', 'like', '%'.$search.'%')
            ->paginate(10);

        return view('stepControl.userList')->with(['users'=>$users]);
    }
    public function stepDaySearch(Request $request)
    {
        $userId = $request->input('users_id');
        $search = $request->input('date');
        $user = User::findOrFail($request->input('users_id'));
        $steps = Step::where('date', 'like', '%'.$search.'%')
            ->where('users_id',$userId )
            ->paginate(10);
        return view('stepControl.stepList')->with(['steps'=>$steps,'user'=>$user]);
    }


    public function create($users_id)
    {
        return view('stepControl.create',compact('users_id'));
    }

//    public function store(StoreRequest $request): RedirectResponse
//    {
//        $data = $request->validated();
//        $this->step->store($data);
//        return redirect()->route('offer.index')->with('success','Успешно созданно');
//    }
//
    public function updateDay(UpdateRequest $request, Step $stepDay): RedirectResponse
    {
        $data = $request->validated();
        $this->step->updateDay($data,$stepDay);
        return redirect()->route('stepDays.show',$stepDay->users_id)->with('success','Обновленно');
    }

    public function showStepDays(User $user)
    {
        $steps = Step::query()->where('users_id',$user->id)->with('user')->paginate(3);
        return view('stepControl.stepList',compact('steps','user'));
    }

    public function editStepDay(Step $stepDay)
    {
        return view('stepControl.stepDayEdit',compact('stepDay'));
    }

    public function destroyStepDay(Step $stepDay): RedirectResponse
    {
        $stepDay->forceDelete();
        return back()->with('error', 'Удалено');
    }
}
