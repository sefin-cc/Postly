<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    public function modify(User $user, Post $post) : bool 
    {
        //Check if the user is the owner of the post
        return  $user->id === $post->user_id;
    }
}
