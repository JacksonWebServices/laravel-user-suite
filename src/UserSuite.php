<?php namespace JWS\UserSuite;

trait UserSuite
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
     * A user may have multiple attributes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_user')->withPivot('attribute_id', 'user_id', 'data');
    }

    /**
     * Assign the given attribute to the user.
     *
     * @param string $attribute
     * @param mixed $data
     * @return mixed
     */
    public function assignAttribute($attribute, $data)
    {
        return $this->attributes()->save(
            Attribute::whereName($attribute)->firstOrFail(),
            ['data' => $data]
        );
    }

    /**
     * Determine if the user has the given attribute.
     *
     * @param mixed $attribute
     *
     * @return bool
     */
    public function hasAttribute($attribute)
    {
        if (is_string($attribute)) {
            return $this->attributes->contains('name', $attribute);
        }

        return (bool) $attribute->intersect($this->attributes)->count();
    }
}