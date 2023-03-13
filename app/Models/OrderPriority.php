<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use ReflectionClass;

class OrderPriority extends Model
{
    use HasFactory;

    const LOW = 1;
    const MEDIUM = 2;
    const HIGH = 3;

    public $table = 'order_priorities';

    public $timestamps = false;

    public $fillable = [
        'name',
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
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string'
    ];

    public static function getConstants(): array
    {
        $reflectionClass = new ReflectionClass(__CLASS__);

        return $reflectionClass->getConstants();
    }

    public static function getOrderPriorities(): array
    {
        $orderPriorities = [];

        $translatedNames = [
            1 => __('forms.low'),
            2 => __('forms.medium'),
            3 => __('forms.high')
        ];

        $constants = self::getConstants();
        $constants = array_slice($constants, 0, 3);

        foreach ($constants as $constant) {
            $orderPriorities[$constant] = [$constant => $translatedNames[$constant]];
        }

        return $orderPriorities;
    }
}
