<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Profile\ProfileRequest;
use App\Http\Requests\API\Profile\ReplyOfferRequest;
use App\Models\User;
use App\Services\ProfileService;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

    protected ProfileService $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }
    public function show(Request $request): Application|Response|JsonResponse|\Illuminate\Contracts\Foundation\Application|ResponseFactory
    {
        $user = User::find($request->id);
        if ($user) {
            $bmi = $user->calculateBMI();
            $responseData = ['user' => $user];

            if ($bmi !== null) {
                $responseData['bmi'] = $bmi;
            }

            return response()->json($responseData);
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }

    public function update(ProfileRequest $request): JsonResponse
    {
        $data = $request->validated();
        if ($request->hasFile('main_image')) {
            $path = $request->file('main_image')->store('images/users', 'public');
            $data['main_image'] = Storage::disk('public')->url($path);
        }
        return $this->profileService->update($data);
    }

    public function replyOffer(ReplyOfferRequest $request): JsonResponse
    {
        $data = $request->validated();
        return response()->json(['offer'=>$this->profileService->replyOffer($data)]);
    }
}
