<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Psy\TabCompletion\Matcher\FunctionsMatcher;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'author', 'body'];

    protected $with = ['author', 'category'];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {

        return $this->belongsTo(Category::class);
    }
}
