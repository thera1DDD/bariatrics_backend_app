<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\VerifySmsRequest;
use App\Models\Offer;
use App\Models\Step;
use App\Models\User;
use App\Models\Water;
use http\Env\Request;
use http\Env\Response;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use function Symfony\Component\String\u;


class StepService extends Controller
{

    public function showDays($user)
    {
        $steps = Step::query()->where('users_id',$user->id)->with('user')->paginate(3);
        return $steps;
    }

    public function searchByDay($data): array
    {
        $user = User::findOrFail($data['users_id']);

        $steps = Step::where('date', 'like', '%' . $data['search'] . '%')
            ->where('users_id', $data['users_id'])
            ->paginate(10);
        return [
            'steps' => $steps,
            'user' => $user,
        ];
    }
    public function storeDay($data): void
    {
        Step::firstOrCreate($data);
    }
    public function updateDay($data,Step $step)
    {
        $step->update($data);
    }
}
