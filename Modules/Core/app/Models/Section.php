<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Core\Database\Factories\SectionFactory;

class Section extends Model
{
    protected $fillable = [
        'name',
        'content',
    ];
}
