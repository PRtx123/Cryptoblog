<?php

namespace App\Models;

use App\Models\Admin\Posts;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    protected $table = 'comments';

    public function getUser()
    {
        return $this->hasOne(User::class, 'id', 'user')->first();
    }

    public function getPost()
    {
        return $this->hasOne(Posts::class, 'id', 'post')->first();
    }
}
