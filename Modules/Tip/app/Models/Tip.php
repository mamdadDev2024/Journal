<?php

namespace Modules\Tip\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Core\app\Contracts\HasSlug;
use Modules\Core\Contracts\Likeable;
use Modules\Core\Models\Category;
use Modules\Interaction\Models\Comment;
use Modules\Interaction\Models\View;
use Modules\User\Models\User;

// use Modules\Tip\Database\Factories\TipFactory;

class Tip extends Model
{
    use HasSlug , Likeable;

    protected $fillable = [
        'title',
        'body',
        'user_id',
        'image',
        'slug',
    ];

    public function getTypeWordAttribute()
    {
        return "نکته";
    }

    public function getRouteNameAttribute()
    {
        return "tip.show";
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function views()
    {
        return $this->morphMany(View::class, 'viewable');
    }

    public function categories()
    {
        return $this->morphToMany(Category::class, 'categorizable');
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
