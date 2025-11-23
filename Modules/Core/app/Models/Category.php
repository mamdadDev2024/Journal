<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Magazine\Models\Article;
use Modules\Magazine\Models\Magazine;
use Modules\Tip\Models\Tip;

// use Modules\Core\Database\Factories\CategoryFactory;

class Category extends Model
{

    protected $fillable = ['name'];

    public function articles()
    {
        return $this->morphedByMany(Article::class, 'categorizable');
    }

    public function tips()
    {
        return $this->morphedByMany(Tip::class, 'categorizable');
    }

    public function Activity()
    {
        return $this->morphedByMany(Activity::class, 'categorizable');
    }

    public function magazines()
    {
        return $this->morphedByMany(Magazine::class, 'categorizable');
    }
}
