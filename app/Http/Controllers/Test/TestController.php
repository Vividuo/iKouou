<?php

namespace App\Http\Controllers\Test;

use Illuminate\Routing\Controller as BaseController;
use App\Models\User;

class TestController extends BaseController
{
    public function index ()
    {
        $user = User::where('username', 'jiyuanxy')->first();
        $accesses = collect();
        $user->roles->each(function ($role) use($accesses) {
            $role->accesses->each(function ($access) use($accesses) {
                $accesses->push($access->slug);
            });
        });
        $user->accesses->each(function ($access) use($accesses) {
            $accesses->push($access->slug);
        });
        //$accesses->push('user-list');
        dd($accesses->unique());
        //$user = \DB::table('users')->where('username', 'jiyuan')->first();
        //
        // if (\Hash::check('chen123', $user->password)) {
        //     // 密码匹配...
        //     return 'y';
        // } else {
        //     return 'no';
        // }
    }
}
