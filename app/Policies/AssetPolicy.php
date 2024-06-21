<?php

namespace App\Policies;

use App\Models\Asset;
use App\Models\User;

class AssetPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any Asset');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Asset $asset): bool
    {
        return $user->checkPermissionTo('view Asset');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create Asset');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Asset $asset): bool
    {
        return $user->checkPermissionTo('update Asset');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Asset $asset): bool
    {
        return $user->checkPermissionTo('delete Asset');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Asset $asset): bool
    {
        return $user->checkPermissionTo('restore Asset');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Asset $asset): bool
    {
        return $user->checkPermissionTo('force-delete Asset');
    }
}
