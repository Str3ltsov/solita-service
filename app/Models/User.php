<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const TYPE_ADMIN = 1;
    const TYPE_USER = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    use HasFactory;

    public $table = 'users';

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
        'avatar',
        'provider_id',
        'provider',
        'access_token',
        "street",
        "house_flat",
        "post_index",
        "city",
        "phone_number",
        'facebook_id',
        'google_id',
        'twitter_id',
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
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'email' => 'required|email:rfc',
//        'password' => 'required',
        'phone_number' => 'nullable|numeric|digits:11',
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
}
