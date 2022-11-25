<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserReview extends Model
{
    use HasFactory;

    public $table = 'user_reviews';

    public $fillable = [
        'rating',
        'review',
        'user_from_id',
        'user_to_id',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'rating' => 'integer',
        'review' => 'string',
        'user_from_id' => 'integer',
        'user_to_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'rating' => 'required|min:0|max:5',
        'review' => 'nullable|string',
        'user_from_id' => 'required|integer',
        'user_to_id' => 'integer|integer',
    ];

    public function userFrom()
    {
        return $this->belongsTo(User::class, 'user_from_id', 'id');
    }

    public function userTo()
    {
        return $this->belongsTo(User::class, 'user_to_id', 'id');
    }
}
