<?php

namespace App\Models;

use Carbon\Traits\Date;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Order
 * @package App\Models
 * @version January 16, 2023, 11:49 am UTC+2
 *
 * @property integer $order_id
 * @property integer $user_id
 * @property integer $employee_id
 * @property integer $status_id
 * @property integer $priority_id;
 * @property integer $delivery_time;
 * @property string $name;
 * @property string $description;
 * @property double $budget;
 * @property integer $total_hours;
 * @property integer $complete_hours;
 * @property Date $start_date;
 * @property Date $end_date;
 * @property double $sum;
 */
class Order extends Model
{
    use HasFactory;

    const CREATED = 1;
    const PREVIEW = 2;
    const PREVIEWED = 3;
    const APPROVED_CLIENT = 4;
    const APPROVED_MANAGER = 5;
    const RUNNING = 6;
    const COMPLETED = 7;
    const OVERDUE = 8;
    const CANCELLED = 9;

    public $table = 'orders';

    public $fillable = [
        'order_id',
        'user_id',
        'employee_id',
        'status_id',
        'priority_id',
        'delivery_time',
        'name',
        'description',
        'budget',
        'total_hours',
        'complete_hours',
        'start_date',
        'end_date',
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
        'order_id' => 'integer',
        'user_id' => 'integer',
        'employee_id' => 'integer',
        'status_id' => 'integer',
        'priority_id' => 'integer',
        'delivery_time' => 'integer',
        'name' => 'string',
        'description' => 'string',
        'budget' => 'double',
        'total_hours' => 'integer',
        'complete_hours' => 'integer',
        'start_date' => 'date',
        'end_date' => 'date',
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
        'order_id' => 'required',
        'user_id' => 'required',
        'employee_id' => 'required',
        'status_id' => 'required',
        'priority_id' => 'required',
        'delivery_time' => 'required|min:1|max:100',
        'name' => 'required',
        'description' => 'nullable',
        'budget' => 'required',
        'total_hours' => 'required|integer|min:1',
        'complete_hours' => 'nullable',
        'start_date' => 'required|date_format:Y-m-d',
        'end_date' => 'required|date_format:Y-m-d|after:start_date',
        'sum' => 'nullable'
    ];

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
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
