<?php

namespace App\Models;

use App\Models\Admin\Posts;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $hidden = [
        'password',
    ];

    public function getLikedPosts()
    {
        $likedPosts = Likes::all()->where('user', '=', $this->id);
        $posts = [];

        foreach ($likedPosts as $likedPost) {
            $posts []= $likedPost->getPost();
        }

        return $posts;
    }

    public function commentsCount()
    {
        $comments = Comments::all()->where('user', '=', $this->id);

        return $comments->count();
    }

    public function likesCount()
    {
        $likes = Likes::all()->where('user', '=', $this->id);

        return $likes->count();
    }

}
