<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UsersPermissions extends Model
{
    public function userRole(): HasOne
    {
        return $this->hasOne(Role::class);
    }
}
