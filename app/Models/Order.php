<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Traits\Date;
use Carbon\Carbon;
use ReflectionClass;

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
 * @property string $name;
 * @property string $description;
 * @property double $budget;
 * @property integer $total_hours;
 * @property integer $complete_hours;
 * @property Date $start_date;
 * @property Date $end_date;
 * @property boolean $generated_com_offer,
 * @property boolean $advance_payment,
 * @property boolean $complete_payment
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
        'name',
        'description',
        'budget',
        'total_hours',
        'complete_hours',
        'start_date',
        'end_date',
        'generated_com_offer',
        'advance_payment',
        'complete_payment',
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
        'name' => 'string',
        'description' => 'string',
        'budget' => 'double',
        'total_hours' => 'integer',
        'complete_hours' => 'integer',
        'start_date' => 'date',
        'end_date' => 'date',
        'generated_com_offer' => 'boolean',
        'advance_payment' => 'boolean',
        'complete_payment' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'order_id' => 'nullable',
        'user_id' => 'required',
        'employee_id' => 'required',
        'status_id' => 'required',
        'priority_id' => 'required',
        'name' => 'required',
        'description' => 'nullable',
        'budget' => 'required',
        'total_hours' => 'required|integer|min:1',
        'complete_hours' => 'nullable|lte:total_hours',
        'start_date' => 'required|date_format:Y-m-d',
        'end_date' => 'required|date_format:Y-m-d|after:start_date',
    ];

//    public function product()
//    {
//        return $this->hasOne(Product::class, 'id', 'name');
//    }

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

    public function files()
    {
        return $this->hasMany(OrderFile::class, 'order_id', 'id');
    }

    public function questionAnswers()
    {
        return $this->hasMany(OrderAnswer::class, 'order_id', 'id');
    }

    public function scopeDateFrom(Builder $query, $date_from): Builder
    {
        return $query->where('created_at', '>=', Carbon::parse($date_from));
    }

    public function scopeDateTo(Builder $query, $date_to): Builder
    {
        return $query->where('created_at', '<=', Carbon::parse($date_to));
    }

    public static function getConstants(): array
    {
        $reflectionClass = new ReflectionClass(__CLASS__);

        return $reflectionClass->getConstants();
    }

    public static function getOrderStatuses(): array
    {
        $orderStatuses = [];

        $translatedNames = [
            1 => __('forms.created'),
            2 => __('forms.preview'),
            3 => __('forms.previewed'),
            4 => __('forms.approvedByClient'),
            5 => __('forms.approvedByManager'),
            6 => __('forms.running'),
            7 => __('forms.completed'),
            8 => __('forms.overdue'),
            9 => __('forms.cancelled')
        ];

        $constants = self::getConstants();
        $constants = array_slice($constants, 0, 9);

        foreach ($constants as $constant) {
            $orderStatuses[$constant] = [$constant => $translatedNames[$constant]];
        }

        return $orderStatuses;
    }
}
