<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    protected $fillable = ['title', 'fid'];

    protected $hidden = ['fid', 'created_at', 'updated_at', 'image'];

    public function image()
    {
        return $this->hasOne('App\Models\File', 'id', 'fid');
    }
}
