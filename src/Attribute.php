<?php namespace JWS\UserSuite;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
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
        $this->table = config('usersuite.db') . '.attributes';
    }

    /**
     * A role may be associated with one user.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(config('usersuite.users.model'), config('usersuite.users.db').'.attribute_user');
    }

    /**
     * Show whether the attribute is unique
     * 
     * @return bool
     */
    public function isUnique()
    {
        return (bool) $this->is_unique;
    }
}
