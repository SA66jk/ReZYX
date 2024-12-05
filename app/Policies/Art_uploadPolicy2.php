<?php

namespace App\Policies;

use App\Models\Art_upload_1;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class Art_uploadPolicy2
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
    public function view(User $user, Art_upload_1 $artUpload1): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        
        return $user!==null;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Art_upload_1 $artUpload1): bool
    {
        return $user->id === $artUpload1->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Art_upload_1 $artUpload1): bool
    {
        return $user->id === $artUpload1->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Art_upload_1 $artUpload1): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Art_upload_1 $artUpload1): bool
    {
        return false;
    }
}
