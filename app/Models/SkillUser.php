<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillUser extends Model
{
    use HasFactory;

    public $table = 'skills_users';

    protected $fillable = [
        'skill_id',
        'user_id',
        'experience',
        'created_at',
        'updated_at'
    ];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'skill_id' => 'integer',
        'user_id' => 'integer',
        'experience' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'skill_id' => 'required|integer',
        'user_id' => 'required|integer',
        'experience' => 'required|string'
    ];

    public function skill()
    {
        return $this->hasOne(Skill::class, 'id', 'skill_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
