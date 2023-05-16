<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function articles() {
        return $this->hasMany(Article::class);
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }

    public function views() {
        return $this->hasMany(View::class);
    }

    public function hasLiked(Article $article) {
        foreach ($this->likes() as $like) {
            if ( $like->article->id == $article->id ) {
                return true;
            }
        }

        return false;
    }

    public function hasViewed(Article $article) {
        foreach ($this->views() as $view) {
            if ( $view->article->id == $article->id ) {
                return true;
            }
        }

        return false;
    }
}
