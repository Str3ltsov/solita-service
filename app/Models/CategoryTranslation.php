<?php

namespace App\Models;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryTranslation extends Model
{
    use HasFactory;
    public $table = "categories_translations";

    public $timestamps = false;
    protected $fillable = ['name', 'description'];
}
