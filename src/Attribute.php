<?php
namespace JWS\UserSuite;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    /**
     * A role may be associated with one user
     */
    public function users()
    {
        return $this->belongsToMany(config('usersuite.users.model'));
    }
}
