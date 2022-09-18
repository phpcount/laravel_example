<?php

namespace App\Models;

use Doctrine\ORM\Query\Expr\Func;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Str;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'img', 'slug'];

    public $dates = ['published_at'];

    protected $guarded = [];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function state()
    {
        return $this->hasOne(State::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function getBodyPreview()
    {
        return Str::limit($this->body, 80);
    }

    public function createdAtForHumans()
    {
        return $this->created_at->diffForHumans();
    }

    public function scopeLastLimit($query, int $limit)
    {
        return $query->with('state', 'tags')
            ->orderByDesc('created_at')
            ->limit($limit)
            ->get();
    }

    public function scopeAllPaginate($query, int $limit)
    {
        return $query->with('state', 'tags')
            ->orderByDesc('created_at')
            ->paginate($limit);
    }

    public function scopeFindBySlug($query, string $slug)
    {
        return $query->with('comments', 'state', 'tags')
            ->where('slug', $slug)
            ->firstOrFail();
    }

    public function scopeFindByTag($query)
    {
        return $query->with('state', 'tags')
            ->orderByDesc('created_at')
            ->paginate(10);
    }
}
