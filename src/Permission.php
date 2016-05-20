<?php namespace JWS\UserSuite;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * A permission can be applied to roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
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
