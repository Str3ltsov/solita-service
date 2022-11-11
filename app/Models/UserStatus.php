<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Returns
 * @package App\Models
 * @version November 11, 2022
 *
 * @property string $name
 */
class UserStatus extends Model
{
    use HasFactory;

    const REGISTERED = 1;
    const APPROVED = 2;
    const BLOCKED = 3;

    public $table = 'user_statuses';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = ['name' => 'required'];
}
