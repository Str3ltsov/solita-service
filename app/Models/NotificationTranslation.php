<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationTranslation extends Model
{
    use HasFactory;

    public $table = 'notifications_translations';

    public $timestamps = false;

    protected $fillable = ['description'];
}
