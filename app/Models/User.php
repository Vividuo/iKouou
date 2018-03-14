<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['username', 'password', 'email', 'mobile', 'avatar'];
    protected $hidden = ['password', 'created_at', 'updated_at', 'remember_token'];

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'user_role', 'user_id', 'role_id');
    }

    public function accesses()
    {
        return $this->belongsToMany('App\Models\Access', 'user_access', 'user_id', 'access_id');
    }


}
