<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderUser extends Model
{
    use HasFactory;

    public $table = 'order_users';

    public $fillable = [
        'order_id',
        'user_id',
        'hours',
        'complete_hours',
        'complete_percentage',
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
        'hours' => 'integer',
        'complete_hours' => 'integer',
        'complete_percentage' => 'double',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'order_id' => 'required|integer',
        'user_id' => 'required|integer',
        'hours' => 'required|integer',
        'complete_hours' => 'required|integer|nullable',
        'complete_percentage' => 'required|float|nullable',
    ];

    public function order()
    {
        return $this->hasOne(Order::class, 'id', 'order_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
