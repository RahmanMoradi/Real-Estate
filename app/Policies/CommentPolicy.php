<?php

namespace App\Policies;

use App\Enums\RoleEnum;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CommentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Comment $comment): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Comment $comment): bool
    {
        if ($comment->user_id == $user->id){
            return true;
        }
        elseif ($user->hasRole(RoleEnum::ADMIN->value)){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Comment $comment): bool
    {
        if ($comment->user_id == $user->id){
            return true;
        }
        elseif ($user->hasRole(RoleEnum::ADMIN->value)){
            return true;
        }
        return false;
    }
}
