<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAnswer extends Model
{
    use HasFactory;

    public $table = 'order_answers';

    public $fillable = [
        'user_id',
        'order_id',
        'order_question_id',
        'answer',
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
        'order_id' => 'integer',
        'order_question_id' => 'integer',
        'answer' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required|integer',
        'order_id' => 'required|integer',
        'order_question_id' => 'required|integer',
        'answer' => 'nullable|string'
    ];

    public function question()
    {
        return $this->hasOne(
            OrderQuestion::class,
            'id',
            'order_question_id'
        );
    }
}
