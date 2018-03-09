<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller as BaseController;

class IndexController extends BaseController
{
    public function init ()
    {
        return response()->json([
            'code' => '200',
            'msg' => '',
            'result' => ['username' => 'admin', 'avatar' => 'default']
        ]);
    }
}
