<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ReturnItem
 * @package App\Models
 * @version April 14, 2022, 8:58 am UTC
 *
 * @property integer $order_id
 * @property integer $user_id
 * @property integer $return_id
 * @property integer $product_id
 * @property number $price_current
 * @property number $count
 */
class ReturnItem extends Model
{
    use HasFactory;

    public $table = 'return_items';

    public $fillable = [
        'order_id',
        'user_id',
        'return_id',
        'product_id',
        'price_current',
        'count',
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
        'return_id' => 'integer',
        'product_id' => 'integer',
        'price_current' => 'double',
        'count' => 'double',
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
        'return_id' => 'required',
        'product_id' => 'required',
        'price_current' => 'required',
        'count' => 'required|min:1'
    ];

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
