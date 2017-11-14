<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function addComment($body)
    {
        $this->comments()->create(compact('body'));
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
