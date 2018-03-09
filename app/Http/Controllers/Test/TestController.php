<?php

namespace App\Http\Controllers\Test;

use Illuminate\Routing\Controller as BaseController;

class TestController extends BaseController
{
    public function index ()
    {
        $result = \DB::table('users')->get();
        dd($result);
    }
}
