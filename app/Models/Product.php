<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\QueryBuilder\QueryBuilder;
use \Illuminate\Database\Eloquent\Builder;

use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

/**
 * Class Product
 * @package App\Models
 * @version March 15, 2022, 5:41 pm UTC
 *
 * @property number $price
 * @property integer $count
 * @property string $image
 * @property string $video
 * @property integer $visible
 * @property integer $promotion_id
 * @property integer $discount_id
 */
class Product extends Model implements TranslatableContract
{
    use HasFactory,Translatable;

    public $table = 'products';
    public $translatedAttributes = ['name', 'description'];
    public $fillable = [
        'price',
        'count',
        'image',
        'video',
        'visible',
        'promotion_id',
        'discount_id',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'price' => 'double',
        'count' => 'integer',
        'image' => 'string',
        'video' => 'string',
        'visible' => 'integer',
        'promotion_id' => 'integer',
        'discount_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'price' => 'required',
        'count' => 'required',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

    public function ratings()
    {
        return $this->hasMany(Ratings::class);
    }

    public function scopePriceFrom(Builder $query, $price) : Builder
    {
        return $query->where('price', '>=', $price);
    }

    public function scopePriceTo(Builder $query, $price) : Builder
    {
        return $query->where('price', '<=', $price);
    }
    public function scopeNameLike(Builder $query, $name) : Builder
    {
        return $query->where('name', 'like', "%$name%");
    }


}
