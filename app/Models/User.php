<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Eloquent as Model;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable //implements TranslatableContract
{
    use HasApiTokens, HasFactory, Notifiable, HasFactory; //, Translatable;

    public $table = 'users';

//    public $translatedAttributes = ['name', 'description'];

    public function scopeDateFrom(Builder $query, $date_from): Builder
    {
        return $query->where('created_at', '>=', Carbon::parse($date_from));
    }

    public function scopeDateTo(Builder $query, $date_to): Builder
    {
        return $query->where('created_at', '<=', Carbon::parse($date_to));
    }

    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'status_id',
        'avatar',
        'provider_id',
        'provider',
        'access_token',
        "street",
        "house_flat",
        "post_index",
        "city",
        "phone_number",
        'work_info',
        'hourly_price',
        'facebook_id',
        'google_id',
        'twitter_id',
        'status_id',
        'experience_id',
        'created_at',
        'updated_at'
    ];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'type' => 'integer',
        'work_info' => 'string',
        'hourly_price' => 'double',
        'status_id' => 'integer',
        'experience_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'email' => 'required|email:rfc',
        'type' => 'required',
        'phone_number' => 'nullable|numeric|digits:11',
        'work_info' => 'nullable|string',
        'hourly_price' => 'nullable'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token'
    ];

    /**
     * Logs current user activity to database.
     * User must be present for this method.
     *
     * @param string $message
     */
    public function log($message)
    {
        $message = ucwords($message);
        $data = [
            'user_id' => $this->id,
            'email' => $this->email,
            'activity' => $message,
        ];
        LogActivity::query()->create($data);
    }

    public function logActivities()
    {
        return $this->hasMany(LogActivity::class, 'user_id');
    }

    public function adminOrders()
    {
        return $this->hasMany(Order::class, 'admin_id', 'id');
    }

    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'type');
    }

    public function status()
    {
        return $this->hasOne(UserStatus::class, 'id', 'status_id');
    }

    public function reviews()
    {
        return $this->hasMany(UserReview::class, 'user_to_id');
    }

    public function skillsUsers()
    {
        return $this->hasMany(SkillUser::class, 'user_id');
    }

    public function occupation()
    {
        return $this->hasOne(SpecialistOccupation::class, 'specialist_id', 'id');
    }

    public function experience()
    {
        return $this->hasOne(Experience::class, 'id');
    }
}
