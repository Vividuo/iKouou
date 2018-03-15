<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;

class RoleController extends Controller
{
    public function lists(Request $request)
    {
        $this->authorize('lists', Role::class);
        $q = $request->input('q');
        $size = $request->input('size') ?: 10;
        $query = Role::with('accesses')->take($size);
        if ($q) {
            $query = $query->where('slug', 'like', '%' . $q . '%');
        }
        $list = $query->get();
        $total = $query->count();
        return response()->json([
            'code' => '200',
            'msg' => '',
            'result' => [
                'list' => $list,
                'total' => $total
            ]
        ]);
    }

    public function add(Request $request)
    {
        $this->authorize('add', Role::class);
        $this->validate($request, [
            'title' => 'required',
            'slug' => 'required',
        ]);
        Role::create([
            'title' => $request->input('title'),
            'slug' => $request->input('slug')
        ]);
        return response()->json([
            'code' => '200',
            'msg' => '',
            'result' => ''
        ]);
    }

    public function edit(Role $role, Request $request)
    {
        $this->authorize('edit', $role);
        if ($request->input('title'))
            $role->email = $request->input('title');
        if ($request->input('slug'))
            $role->mobile = $request->input('slug');
        if ($request->input('accesses')) {
            $role->accesses()->sync($request->input('accesses'));
        }
        $role->save();
        $role->accesses;
        return response()->json([
            'code' => '200',
            'msg' => '',
            'result' => $role
        ]);
    }
}
