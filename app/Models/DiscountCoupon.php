<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class DiscountCoupon
 * @package App\Models
 * @version March 15, 2022, 5:29 pm UTC
 *
 * @property string $code
 * @property integer $used
 * @property number $value
 * @property integer $cart_id
 */
class DiscountCoupon extends Model
{
//    use SoftDeletes;

    use HasFactory;

    public $table = 'discount_coupons';


//    protected $dates = ['deleted_at'];



    public $fillable = [
        'code',
        'used',
        'value',
        'cart_id',
        'user_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'code' => 'string',
        'used' => 'integer',
        'value' => 'double',
        'cart_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'code' => 'required',
        'used' => 'required',
        'value' => 'required'
    ];


    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
