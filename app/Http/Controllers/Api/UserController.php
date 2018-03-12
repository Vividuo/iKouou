<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function pager(Request $request)
    {

        $size = $request->input('size') ?: 10;
        $paginate = User::paginate($size);
        return response()->json([
            'code' => '200',
            'msg' => \Auth::user()->username,
            'result' => $paginate
        ]);
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|unique:users|max:12|min:4',
            'password' => 'required|max:16|min:6',
            'email' => 'nullable|email',
            'mobile' => ['nullable', 'regex:/^1[3|4|5|7|8][0-9]{9}$/']
        ]);
        $user = new User();
        $user->username = $request->input('username');
        $user->password = \Hash::make($request->input('password'));
        $user->mobile = $request->input('mobile');
        $user->email = $request->input('email');
        $user->save();
        return response()->json([
            'code' => '200',
            'msg' => '',
            'result' => ''
        ]);
    }
}
