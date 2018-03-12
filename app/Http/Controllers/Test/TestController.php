<?php

namespace App\Http\Controllers\Test;

use Illuminate\Routing\Controller as BaseController;

class TestController extends BaseController
{
    public function index ()
    {
        $user = \DB::table('users')->where('name', 'vividuo')->first();

        if (\Hash::check('chen123', $user->password)) {
            // 密码匹配...
            return 'y';
        } else {
            return 'no';
        }
    }
}
