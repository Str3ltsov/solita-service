<?php

namespace App\Models;


use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

/**
 * Class Discount
 * @package App\Models
 * @version March 15, 2022, 11:07 am UTC
 *
 * @property string $name
 * @property string $description
 * @property integer $proc
 */
class Discount extends Model implements TranslatableContract
{


    use HasFactory,Translatable;

    public $table = 'discounts';
    public $translatedAttributes = ['name', 'description'];


    public $fillable = [
//        'name',
//        'description',
        'proc'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
//        'name' => 'string',
//        'description' => 'string',
        'proc' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
//        'name' => 'required',
//        'description' => 'required',
        'proc' => 'required'
    ];


    public function products() {
        return $this->hasMany(Product::class);
    }

}
