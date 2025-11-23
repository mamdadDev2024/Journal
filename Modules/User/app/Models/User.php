<?php

namespace Modules\User\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Modules\Activity\Models\Activity;
use Modules\Core\Contracts\Liker;
use Modules\Core\Models\Contact;
use Modules\Core\Models\Recommend;
use Modules\Interaction\Models\Comment;
use Modules\Magazine\Models\Magazine;
use Modules\Tip\Models\Tip;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles , Liker;

    protected string $guard_name = 'web';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'age',
        'email',
        'status',
        'password',
        'number',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function recommends()
    {
        return $this->hasMany(Recommend::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function magazines()
    {
        return $this->hasMany(Magazine::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function tips()
    {
        return $this->hasMany(Tip::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }
}
