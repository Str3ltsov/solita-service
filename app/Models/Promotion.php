<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

/**
 * Class Promotion
 * @package App\Models
 * @version March 15, 2022, 5:31 pm UTC
 *
 * @property string $name
 * @property string $description
 * @property string|\Carbon\Carbon $start
 * @property string|\Carbon\Carbon $finish
 */
class Promotion extends Model implements TranslatableContract
{


    use HasFactory,Translatable;

    public $table = 'promotions';
    public $translatedAttributes = ['name', 'description'];

    public $fillable = [
//        'name',
//        'description',
        'start',
        'finish'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
//        'name' => 'string',
//        'description' => 'string',
        'start' => 'datetime',
        'finish' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
//        'name' => 'required',
//        'description' => 'required',
        'start' => 'required',
        'finish' => 'required'
    ];

    public function products() {
        return $this->hasMany(Product::class);
    }
}
