<?php namespace JWS\UserSuite;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
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
        $this->table = config('usersuite.db') . '.permissions';
    }

    /**
     * A permission can be applied to roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, config('usersuite.db').'.permission_role');
    }

    /**
     * Show whether the permission is protected
     * 
     * @return bool
     */
    public function isProtected()
    {
        return (bool) $this->is_protected;
    }
}
