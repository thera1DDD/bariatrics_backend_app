<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Offer\StoreRequest;
use App\Http\Requests\Step\SearchRequest;
use App\Http\Requests\Step\UpdateRequest;
use App\Models\Step;
use App\Models\User;
use App\Services\StepService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class StepController extends Controller
{
    protected $stepService;

    public function __construct(StepService $step)
    {
        $this->stepService = $step;
    }

    public function storeDay(\App\Http\Requests\Step\StoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $this->stepService->storeDay($data);
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

    public function userSearch(Request $request): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('stepControl.userList')
               ->with(['users'=>(new User)
               ->searchByUser($request->input('search'))]);
    }
    public function stepDaySearch(SearchRequest $request): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $result = $this->stepService->searchByDay($request->validated());
        return view('stepControl.stepList')->with([
            'steps' => $result['steps'],
            'user' => $result['user'],
        ]);
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
        $this->stepService->updateDay($data,$stepDay);
        return redirect()->route('stepDays.show',$stepDay->users_id)->with('success','Обновленно');
    }

    public function showStepDays(User $user): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $steps = $this->stepService->showDays($user);
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
