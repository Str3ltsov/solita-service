<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderQuestionTranslation extends Model
{
    use HasFactory;

    public $table = 'order_questions_translations';

    public $timestamps = false;

    protected $fillable = ['question'];
}
