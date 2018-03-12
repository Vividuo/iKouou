<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function init (Request $request)
    {
        if ($user = \Auth::user()) {
            $username = $user->username;
        } else {
            $username = '';
        }

        return response()->json([
            'code' => '200',
            'msg' => '',
            'result' => ['username' => $username, 'avatar' => 'default', 'token' => csrf_token()]
        ]);
    }

    public function logout()
    {
        \Auth::logout();
        return response()->json([
            'code' => '200',
            'msg' => '',
        ]);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        $credentials = [
            'username' => $request->input('username'),
            'password' => $request->input('password')
        ];
        if (\Auth::attempt($credentials)) {
            return response()->json([
                'code' => '200',
                'msg' => '',
                'result' => [
                    'username' => \Auth::user()->username
                ]
            ]);
        } else {
            return response()->json([
                'code' => '401',
                'msg' => '',
            ]);
        }
    }
}
