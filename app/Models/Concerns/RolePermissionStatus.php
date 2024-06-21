<?php

namespace App\Models\Concerns;

use App\Enums\UserPermission;

trait RolePermissionStatus
{
    public function hasUsersPermission(): bool
    {

        return $this->hasPermissionTo(UserPermission::Users->value);
    }
}
