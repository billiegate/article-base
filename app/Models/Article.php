<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['thumbnail', 'title', 'description'];

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }

    public function views() {
        return $this->hasMany(View::class);
    }

    public function wasLiked(User $user) {
        foreach ($this->likes() as $like) {
            if ( $like->user->id == $user->id ) {
                return true;
            }
        }

        return false;
    }

    public function wasViewed(User $user) {
        foreach ($this->views() as $view) {
            if ( $view->user->id == $user->id ) {
                return true;
            }
        }

        return false;
    }

    public function hasTag(Tag $tag) {
        foreach ($this->tags() as $_tag) {
            if ( $tag->id == $_tag->id ) {
                return true;
            }
        }

        return false;
    }
}
