<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

/**
 * Class Order
 * @package App\Models
 * @version April 12, 2022, 11:49 am UTC
 *
 * @property integer $cart_id
 * @property integer $order_id
 * @property integer $user_id
 * @property integer $specialist_id
 * @property integer $employee_id
 * @property integer $status_id
 * @property integer $delivery_time;
 * @property integer $priority_id;
 * @property integer $sum
 */
class Order extends Model
{
    use HasFactory;

    public $table = 'orders';

    public $fillable = [
        'cart_id',
        'order_id',
        'user_id',
        'specialist_id',
        'employee_id',
        'status_id',
        'delivery_time',
        'priority_id',
        'sum',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'cart_id' => 'integer',
        'order_id' => 'integer',
        'user_id' => 'integer',
        'specialist_id' => 'integer',
        'employee_id' => 'integer',
        'status_id' => 'integer',
        'delivery_time' => 'integer',
        'priority_id' => 'integer',
        'sum' => 'double',
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
        'specialist_id' => 'required',
        'employee_id' => 'required',
        'status_id' => 'required',
        'priority_id' => 'required',
        'delivery_time' => 'required|min:1|max:100'
    ];

    public function scopeDateFrom(Builder $query, $date_from): Builder
    {
        return $query->where('created_at', '>=', Carbon::parse($date_from));
    }

    public function scopeDateTo(Builder $query, $date_to): Builder
    {
        return $query->where('created_at', '<=', Carbon::parse($date_to));
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function employee()
    {
        return $this->hasOne(User::class, 'id', 'employee_id');
    }

    public function status()
    {
        return $this->hasOne(OrderStatus::class, 'id', 'status_id');
    }

    public function priority()
    {
        return $this->hasOne(OrderPriority::class, 'id', 'priority_id');
    }

    public function specialists()
    {
        return $this->hasMany(OrderUser::class, 'order_id', 'id');
    }
}
