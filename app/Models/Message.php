<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

/**
 * Class Message
 * @package App\Models
 * @version April 17, 2022, 8:41 am UTC
 *
 * @property string $subject
 * @property string $message_text
 */
class Message extends Model
{
    use HasFactory;

    public $table = 'messages';

    public $fillable = [
        'topic',
        'description',
        'sender_id',
        'order_id',
        'message_type_id',
        'reply_message_id',
        'main_message_id',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'topic' => 'string',
        'description' => 'string',
        'sender_id' => 'integer',
        'order_id' => 'integer',
        'message_type_id' => 'integer',
        'reply_message_id' => 'integer',
        'main_message_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'topic' => 'required|string',
        'description' => 'required|string',
        'sender_id' => 'required|integer',
        'order_id' => 'required|integer',
        'message_type_id' => 'required|integer',
        'reply_message_id' => 'nullable|integer',
        'main_message_id' => 'nullable|integer',
        'users' => 'required|array'
    ];

    public function messageUsers()
    {
        return $this->hasMany(MessageUser::class, 'message_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'sender_id');
    }

    public function order()
    {
        return $this->hasOne(Order::class, 'id', 'order_id');
    }

    public function type()
    {
        return $this->hasOne(MessageType::class, 'id', 'message_type_id');
    }

    public function replyMessage()
    {
        return $this->belongsTo(Message::class, 'id', 'reply_message_id');
    }

    public function replyMessage_()
    {
        return $this->hasOne(Message::class, 'id', 'reply_message_id');
    }

    public function mainMessage()
    {
        return $this->hasOne(Message::class, 'id', 'main_message_id');
    }
}
