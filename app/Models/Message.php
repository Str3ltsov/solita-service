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
        'subject',
        'message_text',
        'user_from',
        'user_to',
        'created_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'subject' => 'string',
        'message_text' => 'string',
        'user_from' => 'integer',
        'user_to' => 'integer',
        'created_at' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'message_text' => 'required'
    ];
}
