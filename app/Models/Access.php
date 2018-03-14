<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
    protected $fillable = ['title', 'slug'];
    protected $hidden = ['pivot', 'created_at', 'updated_at'];
}
