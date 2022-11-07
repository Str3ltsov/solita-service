<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Category
 * @package App\Models
 * @version March 15, 2022, 9:45 am UTC
 *
 * @property string $name
 * @property string $description
 * @property integer $parent_id
 * @property integer $visible
 */
class Category extends Model implements TranslatableContract
{
    use HasFactory,Translatable;

    public $table = 'categories';
    public $translatedAttributes = ['name', 'description'];
    public $fillable = [
//        'name',
//        'description',
        'parent_id',
        'visible',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
//        'name' => 'string',
//        'description' => 'string',
        'parent_id' => 'integer',
        'visible' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
//        'name' => 'required',
//        'description' => 'required'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function innerCategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

//    public function childs() {
//
//        return $this->hasMany('App\Category','parent_id','id') ;
//
//    }


}
