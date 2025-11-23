<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\User\Models\User;

// use Modules\Core\Database\Factories\ContactFactory;

class Contact extends Model
{
    protected $fillable = [
        'body',
        'phone',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
