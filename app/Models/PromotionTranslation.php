<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromotionTranslation extends Model
{
    use HasFactory;
    public $table = "promotions_translations";

    public $timestamps = false;
    protected $fillable = ['name', 'description'];
}
