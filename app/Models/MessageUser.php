<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageUser extends Model
{
    use HasFactory;

    public $table = 'message_users';

    public $fillable = [
        'marked_as_read',
        'message_id',
        'user_id',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'marked_as_read' => 'boolean',
        'message_id' => 'integer',
        'user_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'message_id' => 'required|integer',
        'user_id' => 'required|integer',
    ];

    public function message()
    {
        return $this->hasOne(Message::class, 'id', 'message_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
