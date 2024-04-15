<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class ProfileService extends Controller
{


    public function update($data): JsonResponse
    {
        try {
            $user = User::find($data['users_id']);

            if ($user) {
                if (isset($data['phone_number'])) {
                    $existingUser = User::where('phone_number', $data['phone_number'])->where('id', '!=', $data['users_id'])->first();
                    if (isset($existingUser)) {
                        return response()->json(['success' => false, 'message' => 'Номер телефона уже существует'], 422);
                    }
                }
                $user->fill($data);
                $user->save();

                return response()->json($user);
            }
            else{
                return response()->json(['status'=>false,'message'=>'Пользователь не найден'],404);
            }
        }
        catch (ValidationException $validationException) {
            // Вывод сообщений валидации в случае ошибки валидации
            return response()->json(['errors' => $validationException->errors()], 422);
        } catch (\Exception $exception) {
            // Вывод сообщения общей ошибки
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function replyOffer($data)
    {
        return tap(Offer::find($data['offers_id']))->update(['status' => $data['status']]);
    }
}
