<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['label'];

    public $timestamps = false;

    public function articles()
    {
        $this->belongsToMany(Article::class);
    }

}
