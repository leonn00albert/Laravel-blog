<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters["search"] ?? false, fn($query, $search) =>
        $query->where(fn ($query) => $query
            ->where('title', 'like', '%' . request('search') . '%')
            ->orWhere('body', 'like', '%' . request('search') . '%')
        )

        );
        $query->when($filters["category"] ?? false, fn($query, $category) => $query
            ->whereHas('category', fn($query) => $query->from('categories')
                ->where("slug", $category)
            )

        );
        $query->when($filters["author"] ?? false, fn($query, $author) => $query
            ->whereHas('author', fn($query) => $query
                ->where("username", $author)
            )

        );
    }

    function category()
    {
        return $this->belongsTo(Category::class);
    }

    function user()
    {
        return $this->belongsTo(User::class);
    }

    function author()
    {
        return $this->belongsTo(User::class, "user_id");
    }
}

