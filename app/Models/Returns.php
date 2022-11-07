<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

/**
 * Class Returns
 * @package App\Models
 * @version April 14, 2022, 7:50 am UTC
 *
 * @property integer $user_id
 * @property integer $admin_id
 * @property integer $order_id
 * @property string $code
 * @property string $text
 * @property integer $status_id
 */
class Returns extends Model
{
    use HasFactory;

    public $table = 'returns';

    public function scopeDateFrom(Builder $query, $date_from): Builder
    {
        return $query->where('created_at', '>=', Carbon::parse($date_from));
    }

    public function scopeDateTo(Builder $query, $date_to): Builder
    {
        return $query->where('created_at', '<=', Carbon::parse($date_to));
    }

    public $fillable = [
        'user_id',
        'admin_id',
        'order_id',
        'code',
        'description',
        'status_id',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'admin_id' => 'integer',
        'order_id' => 'integer',
        'code' => 'string',
        'description' => 'string',
        'status_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'admin_id' => 'required',
        'order_id' => 'required',
        'code' => 'required',
        'status_id' => 'required'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function admin()
    {
        return $this->hasOne(User::class, 'id', 'admin_id');
    }

    public function status()
    {
        return $this->hasOne(ReturnStatus::class, 'id', 'status_id');
    }
}
