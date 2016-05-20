<?php

namespace JWS\UserSuite;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    private $usersuite = config('usersuite');

    protected  $table = 'laravelusersuite.roles1234';
    /**
     * A role may be given various permissions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * A role may have many users.
     */
    public function users()
    {
        return $this->belongsToMany(config('usersuite.users.model'));
    }

    /**
     * Grant the given permission to a role.
     *
     * @param Permission $permission
     *
     * @return mixed
     */
    public function givePermission(Permission $permission)
    {
        return $this->permissions()->save($permission);
    }

     /**
     * Remove the given permission to a role.
     *
     * @param Permission $permission
     *
     * @return mixed
     */
    public function assignRoleTo(User $user)
    {
        return $this->users()->save($user);
    }
}
