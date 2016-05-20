<?php
namespace JWS\UserSuite\Helpers;

use JWS\UserSuite\Role;

trait HasRoles
{
    /**
     * A user may have a single role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    /**
     * Assign the given role to the user.
     *
     * @param  string  $role
     * @return mixed
     */
    public function assignRole($role)
    {
        return $this->role()->save(
            Role::whereName($role)->firstOrFail()
        );
    }

    /**
     * Change the role of the user.
     *
     * @param  string  $role
     * @return mixed
     */
    public function changeRole($role)
    {
        return $this->role()->associate(
            Role::whereName($role)->firstOrFail()
        );
    }
}