<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class CartItem
 * @package App\Models
 * @version March 29, 2022, 4:20 pm UTC
 *
 * @property integer $cart_id
 * @property integer $product_id
 * @property number $price_current
 * @property integer $count
 */
class CartItem extends Model
{

    use HasFactory;

    public $table = 'cart_items';


    public $fillable = [
        'cart_id',
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
        'cart_id' => 'integer',
        'product_id' => 'integer',
        'price_current' => 'double',
        'count' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'cart_id' => 'required',
        'product_id' => 'required',
        'price_current' => 'required|min:5',
        'count' => 'required'
    ];

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }


}
