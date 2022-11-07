<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountTranslation extends Model
{
    use HasFactory;
    public $table = "discounts_translations";

    public $timestamps = false;
    protected $fillable = ['name', 'description'];
}
