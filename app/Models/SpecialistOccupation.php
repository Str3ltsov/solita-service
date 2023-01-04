<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialistOccupation extends Model
{
    use HasFactory;

    public $table = 'specialist_occupations';

    public $timestamps = false;

    public $fillable = [
        'specialist_id',
        'percentage'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'specialist_id' => 'integer',
        'percentage' => 'double'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'specialist_id' => 'required|integer',
        'percentage' => 'nullable'
    ];

    public function specialist()
    {
        return $this->belongsTo(User::class, 'specialist_id', 'id');
    }
}
