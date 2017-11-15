<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    public static function archives()
    {
        return self::selectRaw('year(created_at) year, monthname(created_at) month, count(*) published')
            ->groupBy('month', 'year')
            ->orderByRaw('min(created_at) desc')
            ->get()
            ->toArray();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function addComment($body, $user_id)
    {
        $this->comments()->create(compact('body', 'user_id'));
    }

    public function scopeFilter($query, $filters)
    {
        $month = $filters['month'] ?? false;
        if ($month) {
            $query->whereMonth('created_at', Carbon::parse($month)->month);
        }

        $year = $filters['year'] ?? false;
        if ($year) {
            $query->whereYear('created_at', $year);
        }

    }
}
