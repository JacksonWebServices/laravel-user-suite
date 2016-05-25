<?php namespace JWS\UserSuite;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    /**
     * Create a new Eloquent model instance.
     *
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct();
        $this->table = config('usersuite.db') . '.roles';
    }
    
    /**
     * A role may be given various permissions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, config('usersuite.db').'.permission_role');
    }

    /**
     * A role may have many users.
     */
    public function users()
    {
        return $this->belongsToMany(config('usersuite.users.model'), config('usersuite.users.db').'.role_user');
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
