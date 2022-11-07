<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class LogActivity extends Model
{
    use HasFactory;

    public $table = 'log_activities';

    public function scopeDateFrom(Builder $query, $date_from): Builder
    {
        return $query->where('created_at', '>=', Carbon::parse($date_from));
    }

    public function scopeDateTo(Builder $query, $date_to): Builder
    {
        return $query->where('created_at', '<=', Carbon::parse($date_to));
    }

    public function scopeSearch($query, $keywords)
    {
//        return $query->where('activity', 'RLIKE', '[[:<:]]'.$keywords.'[[:>:]]');
        return $query->where('activity', 'RLIKE', '\\'.$keywords.'\\b');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'email', 'activity',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
