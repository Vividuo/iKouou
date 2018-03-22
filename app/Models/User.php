<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use Notifiable;

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

    public function isSuperAdmin()
    {
        return $this->roles->contains('slug', 'superadmin');
    }

    public function permissions()
    {
        $permissions = collect();
        if ($this->isSuperAdmin()) {
            $permission = \App\Models\Access::all()->each(function ($access) use ($permissions) {
                $permissions->push($access->slug);
            });
        } else {
            $this->roles->each(function ($role) use ($permissions) {
                $role->accesses->each(function ($access) use ($permissions) {
                    $permissions->push($access->slug);
                });
            });
            $this->accesses->each(function ($access) use ($permissions) {
                $permissions->push($access->slug);
            });
        }
        return $permissions;
    }

}
