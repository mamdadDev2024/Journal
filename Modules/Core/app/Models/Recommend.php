<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Core\app\Contracts\HasSlug;
use Modules\User\Models\User;

// use Modules\Core\Database\Factories\RecommendFactory;

class Recommend extends Model
{
    use HasSlug;

    protected $fillable = [
        'title',
        'user_id',
        'slug',
        'pdf',
        'word',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
