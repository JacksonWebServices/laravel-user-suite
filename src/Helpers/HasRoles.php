<?php namespace JWS\UserSuite\Helpers;

use JWS\UserSuite\Role;
use JWS\UserSuite\Permission;

class PrimaryRoleMissingException extends \Exception {}

trait HasRoles
{
    /**
     * A user may have a single role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user')->withPivot('role_id', 'user_id', 'is_primary');
    }

    /**
     * Assign the given role to the user.
     *
     * @param  string  $role
     * @param  boolean $is_primary
     * @throws \Exception 
     * @return mixed
     */
    public function assignRole($role, $is_primary = false)
    {
        $existing_role = $this->roles()->whereName($role)->first();
        
        if ($existing_role != false) {
            if ($is_primary && !$existing_role->pivot->is_primary) {
                return $this->makeRolePrimary($role);
            } elseif ($is_primary && $existing_role->pivot->is_primary) {
                throw new \Exception("The " . $role . " role is already assigned and the primary role.");
            }
            throw new \Exception("This user already has the " . $role . " role.");
        } else {
            if ($is_primary) {
                try {
                    return is_object($this->primaryRole()) ? $this->makeRolePrimary($role) : null;
                } catch (\Exception $e) {
                    return $this->roles()->save(
                        Role::whereName($role)->firstOrFail(),
                        ['is_primary' => $is_primary]
                    );
                }
            } else {
                return $this->roles()->save(
                    Role::whereName($role)->firstOrFail(),
                    ['is_primary' => $is_primary]
                );
            }
        }
    }

    /**
     * Removes the given role from the user
     *
     * @param string  $role
     * @return boolean
     */
    public function removeRole($role)
    {
        $role = $this->roles()->whereName($role)->firstOrFail();
        if (!$role->pivot->is_primary) {
            return $this->roles()->detach($role->id);
        }
        return false;
    }

    /**
     * Return the primary role
     *
     * @throws PrimaryRoleMissingException
     * @return mixed
     */
    public function primaryRole()
    {
        foreach ($this->roles as $role) {
            if ($role->pivot->is_primary) {
                return $role;
            }
        }
        throw new PrimaryRoleMissingException("This user doesn't have a primary role!");
    }

    /**
     * Make a role the primary role
     *
     * @param string  $name
     * @throws \Exception
     * @return mixed
     */
    public function makeRolePrimary($name)
    {
        // This is already the primary role
        try {
            if ($name == $this->primaryRole()->name) {
                throw new \Exception("This role is already the primary role!");
            }
        } catch (PrimaryRoleMissingException $e) {
            // Just continue
        }
        
        $roles = $this->roles;
        $roles_updated = array();
        foreach ($roles as $key => $role) {
            $is_primary = 0;

            // Set the old primary to false
            if ($role->pivot->is_primary == 1) {
                $is_primary = 0;
            }

            // Set the new primary to true
            if ($name == $role->name) {
                $is_primary = 1;
            }

            $roles_updated[$role->id] = ['is_primary' => $is_primary];

        }

        // Reflect the changes
        $this->roles()->sync($roles_updated);

        return $this->load('roles');
    }

    /**
     * Determine if the user has the given role.
     *
     * @param mixed $role
     * @return boolean
     */
    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }
        return !! $role->intersect($this->roles)->count();
    }
}