<?php

namespace Modules\Magazine\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Core\app\Contracts\HasSlug;
use Modules\Core\Contracts\Likeable;
use Modules\Core\Models\Category;
use Modules\Interaction\Models\Comment;
use Modules\Interaction\Models\View;
use Modules\User\Models\User;

// use Modules\Magazine\Database\Factories\MagazineFactory;

class Magazine extends Model
{
    use HasSlug , Likeable;

    protected $fillable = [
        'title',
        'slug',
        'image',
        'user_id',
        'pdf',
        'body',
    ];

    public function getImageUrlAttribute()
    {
        return $this->image
            ? asset($this->image)
            : null;
    }
    public function getTypeWordAttribute()
    {
        return 'نشریه';
    }

    public function getRouteNameAttribute()
    {
        return 'magazine.show';
    }
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function views()
    {
        return $this->morphMany(View::class, 'viewable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->morphToMany(Category::class, 'categorizable');
    }
}
