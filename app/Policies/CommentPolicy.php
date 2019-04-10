<?php

namespace IVSales\Policies;

use IVSales\User;
use IVSales\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the comment.
     *
     * @param  \IVSales\User  $user
     * @param  \IVSales\Comment  $comment
     * @return mixed
     */
    public function update(User $user, Comment $comment)
    {
        return $user->id === $comment->user_id;
    }

    /**
     * Determine whether the user can delete the comment.
     *
     * @param  \IVSales\User  $user
     * @param  \IVSales\Comment  $comment
     * @return mixed
     */
    public function delete(User $user, Comment $comment)
    {
        return $user->id === $comment->user_id;
    }

    public function before(User $user)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }
}
