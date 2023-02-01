<?php

namespace App\Models\Admin;

use App\Models\Comments;
use App\Models\Likes;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;
    protected $table = 'posts';

    public function getDescription()
    {
        $descp = mb_substr($this->content, 0, mb_strpos($this->content, '.'));

        return $descp;
    }

    public function getComments()
    {
        return $this->hasMany(Comments::class, 'post', 'id')->get()->sortByDesc('created_at');
    }

    public function getPaginateComments()
    {
        return $this->hasMany(Comments::class, 'post', 'id')->orderByDesc('created_at')->paginate(5);
    }

    public function getLikes()
    {
        return $this->hasMany(Likes::class, 'post', 'id')->get();
    }

    public function getPaginateLikes()
    {
        return $this->hasMany(Likes::class, 'post', 'id')->orderByDesc('created_at')->paginate(5);
    }

    public function isLiked(Posts $post, User $user)
    {
        $like = Likes::all()
            ->where('post', '=', $post->id)
            ->where('user', '=', $user->id)
            ->first();

        if ($like) {
            return true;
        }

        return false;
    }

}
