<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Access;

class AccessController extends Controller
{
    public function lists(Request $request)
    {

        $q = $request->input('q');
        $size = $request->input('size') ?: 10;
        $query = Access::take($size);
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
        $this->validate($request, [
            'title' => 'required',
            'slug' => 'required',
        ]);
        Access::create([
            'title' => $request->input('title'),
            'slug' => $request->input('slug')
        ]);
        return response()->json([
            'code' => '200',
            'msg' => '',
            'result' => ''
        ]);
    }

    public function edit(Access $access, Request $request)
    {

        if ($request->input('title'))
            $access->email = $request->input('title');
        if ($request->input('slug'))
            $access->mobile = $request->input('slug');

        $access->save();
        return response()->json([
            'code' => '200',
            'msg' => '',
            'result' => $access
        ]);
    }
}
