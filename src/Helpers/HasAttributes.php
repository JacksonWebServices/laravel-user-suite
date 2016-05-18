<?php

namespace JWS\UserSuite\Helpers;

use JWS\UserSuite\Attribute;

/**
 * Class HasAttributes
 * @package JWS\UserSuite\Helpers
 * 
 * TODO: Get data from attribute
 */
trait HasAttributes
{
    /**
     * A user may have multiple attributes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_user');
    }

    /**
     * Assign the given attribute to the user.
     *
     * @param string $attribute
     *
     * @return mixed
     */
    public function assignAttribute($attribute)
    {
        return $this->attributes()->save(
            Attribute::whereName($attribute)->firstOrFail()
        );
    }

    /**
     * Remove the given attribute from the user.
     * 
     * @param string $attribute
     * @return mixed
     */
    public function removeAttribute($attribute)
    {
        if ($this->hasAttribute($attribute)) {
            foreach ($this->attributes as $attr) {
                if ($attr->name == $attribute) {
                    $attr->pivot->delete();
                }
            }
        }
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
