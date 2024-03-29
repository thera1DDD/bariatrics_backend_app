<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\VerifySmsRequest;
use App\Models\Offer;
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


class WaterService extends Controller
{
    public function storeWaterDay($data): void
    {
        Water::firstOrCreate($data);
    }
    public function updateWaterDay($data,Water $waterDay)
    {
        $waterDay->update($data);
    }
}
