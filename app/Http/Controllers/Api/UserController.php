<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Access;

class UserController extends Controller
{
    public function lists(Request $request)
    {
        $this->authorize('lists', User::class);
        $size = $request->input('size') ?: 10;
        $paginate = User::with('roles')->paginate($size);
        return response()->json([
            'code' => '200',
            'msg' => '',
            'result' => $paginate
        ]);
    }

    public function info(User $user)
    {
        $this->authorize('edit', $user);
        //触发关联关系加载
        $accesses = $user->accesses;
        $roles = $user->roles;
        return response()->json([
            'code' => '200',
            'msg' => '',
            'result' => $user
        ]);
    }

    public function edit(User $user, Request $request)
    {
        $this->authorize('edit', $user);
        $this->validate($request, [
            'email' => 'nullable|email',
            'mobile' => ['nullable', 'regex:/^1[3|4|5|7|8][0-9]{9}$/'],
            'avatar' => 'nullable|url'
        ]);
        if ($request->input('email')) {
            $user->email = $request->input('email');
        }
        if ($request->input('mobile')) {
            $user->mobile = $request->input('mobile');
        }
        if ($request->input('avatar')) {
            $user->avatar = $request->input('avatar');
        }

        $user->accesses()->sync($request->input('accesses'));

        $user->roles()->sync($request->input('roles'));


        $user->save();
        return response()->json([
            'code' => '200',
            'msg' => '',
            'result' => $user
        ]);
    }

    public function add(Request $request)
    {
        $this->authorize('edit', User::class);
        $this->validate($request, [
            'username' => 'required|unique:users|max:12|min:4',
            'password' => 'required|max:16|min:6',
            'email' => 'nullable|email',
            'mobile' => ['nullable', 'regex:/^1[3|4|5|7|8][0-9]{9}$/'],
            'avatar' => 'nullable|url'
        ]);
        $user = User::create([
            'username' => $request->input('username'),
            'password' => \Hash::make($request->input('password')),
            'mobile' => $request->input('mobile'),
            'email' => $request->input('email'),
            'avatar' => $request->input('avatar')
        ]);
        if ($request->input('accesses')) {
            $user->accesses()->sync($request->input('accesses'));
        }
        if ($request->input('roles')) {
            $user->roles()->sync($request->input('roles'));
        }
        return response()->json([
            'code' => '200',
            'msg' => '',
            'result' => $user
        ]);
    }
}
