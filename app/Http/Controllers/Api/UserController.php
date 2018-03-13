<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function lists(Request $request)
    {

        $size = $request->input('size') ?: 10;
        $paginate = User::paginate($size);
        return response()->json([
            'code' => '200',
            'msg' => '',
            'result' => $paginate
        ]);
    }

    public function edit(Request $request)
    {
        $this->validate($request, [
            'email' => 'nullable|email',
            'mobile' => ['nullable', 'regex:/^1[3|4|5|7|8][0-9]{9}$/'],
            'avatar' => 'nullable|url'
        ]);
        $user = \Auth::user();
        if ($request->input('email'))
            $user->email = $request->input('email');
        if ($request->input('mobile'))
            $user->mobile = $request->input('mobile');
        if ($request->input('avatar'))
            $user->avatar = $request->input('avatar');
        $user->save();
        return response()->json([
            'code' => '200',
            'msg' => '',
            'result' => $user
        ]);
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|unique:users|max:12|min:4',
            'password' => 'required|max:16|min:6',
            'email' => 'nullable|email',
            'mobile' => ['nullable', 'regex:/^1[3|4|5|7|8][0-9]{9}$/'],
            'avatar' => 'nullable|url'
        ]);
        User::create([
            'username' => $request->input('username'),
            'password' => \Hash::make($request->input('password')),
            'mobile' => $request->input('mobile'),
            'email' => $request->input('email'),
            'avatar' => $request->input('avatar')
        ]);
        return response()->json([
            'code' => '200',
            'msg' => '',
            'result' => ''
        ]);
    }
}
