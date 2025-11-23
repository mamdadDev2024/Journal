<?php

namespace Modules\Interaction\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\User\Models\User;

// use Modules\Interaction\Database\Factories\CommentFactory;

class Comment extends Model
{
    protected $fillable = ['body', 'user_id', 'status', 'commentable_id', 'commentable_type'];

    public function commentable()
    {
        return $this->morphTo('commentable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
