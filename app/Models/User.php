<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'surname',
        'patronymic',
        'city',
        'main_image',
        'phone_number',
        'verification_code',
        'remember_token',
        'phone_verified_at'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function calculateBMI(): ?float
    {
        if ($this->height && $this->weight_before) {
            $heightWeight = explode(';', $this->height);

            // Проверяем, есть ли два значения после разделителя
            if (count($heightWeight) === 2) {
                // Получаем значение роста (первый элемент массива)
                $height = (float)$heightWeight[0];
                // Получаем значение веса (второй элемент массива)
                $weight = (float)$heightWeight[1];

                // Проверяем, что значения роста и веса больше нуля
                if ($height > 0 && $weight > 0) {
                    // Расчет ИМТ
                    $heightInMeters = $height / 100; // Переводим рост в метры
                    $bmi = $weight / ($heightInMeters * $heightInMeters);

                    return $bmi;
                }
            }
        }
        return null;
    }

    public function water(): HasMany
    {
        return $this->hasMany(Water::class,'users_id','id');
    }

    public function step(): HasMany
    {
        return $this->hasMany(Step::class,'users_id','id');
    }

    public function meal(): HasMany
    {
        return $this->hasMany(Meal::class,'users_id','id');
    }

    public function searchByUser($search)
    {
        $users = User::where('name', 'like', '%'.$search.'%')
            ->orWhere('surname', 'like', '%'.$search.'%')
            ->paginate(10);
        return $users;
    }
}
