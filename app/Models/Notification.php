<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    public $table = 'notifications';

    public $translatedAttributes = ['description'];

    public $fillable = [
        'user_id',
        'marked_as_read',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'marked_as_read' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
