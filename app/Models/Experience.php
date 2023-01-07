<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Experience extends Model
{
    use HasFactory;

    public $table = 'experiences';

    protected $fillable = [
    'id',
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
    public static $rules = [
    'name' => 'required|string|unique:skills'
];

    public function skillsUsers()
{
    return $this->hasMany(SkillUser::class, 'skill_id');
}
}

