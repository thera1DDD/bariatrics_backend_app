<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\VerifySmsRequest;
use App\Models\Meal;
use App\Models\Offer;
use App\Models\User;
use http\Env\Request;
use http\Env\Response;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use function Symfony\Component\String\u;


class MealService extends Controller
{
    public function store($data){
        Meal::firstOrCreate($data);
    }
    public function update($data,Meal $meal){
        $meal->update($data);
    }
    public function translateType(): array
    {
        return
            $mealTranslations = [
                'breakfast' => __('Завтрак'),
                'second' => __('Второе'),
                'lunch' => __('Обед'),
                'midday' => __('Полдник'),
                'dinner' => __('Ужин')
            ];
    }
}
