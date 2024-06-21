<?php

namespace App\Models;

use App\Enums\UserPermission;
use App\Models\Concerns\RolePermissionStatus;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use HasFactory,HasUlids,RolePermissionStatus;

    public function canUsers(): bool
    {

        return $this->hasPermissionTo(UserPermission::Users->value);
    }
}
