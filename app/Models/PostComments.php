<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostComments extends Model
{
    use HasFactory;
    protected $table = "postcomments";

    protected $fillable = [
        'comment',
        'post_id', //? The Post ID
        'user_id' //? The Authenticated User ID
    ];


    public function userposts()
    {
        return $this->hasOne(UserPost::class, 'id', 'post_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
