<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;

class CommentPolicy
{
    public function before(User $user, $ability)
    {
        // Модератор может всё
        if ($user->isModerator()) {
            return true;
        }
        return null;
    }

    public function delete(User $user, Comment $comment)
    {
        // Только модератор может удалять
        return $user->isModerator();
    }
}