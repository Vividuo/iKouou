<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Access;

class AccessController extends Controller
{
    public function lists(Request $request)
    {
        $this->authorize('lists', Access::class);
        // $page = $request->input('page')
        $q = $request->input('q');
        $size = $request->input('size') ?: 10;
        // $query = Access::take($size)->skip(($page - 1) * $size);
        if ($q) {
            $pager = Access::where('slug', 'like', '%' . $q . '%')->paginate($size);
        } else {
            $pager = Access::paginate($size);
        }
        return response()->json([
            'code' => '200',
            'msg' => '',
            'result' => [
                'list' => $pager->items(),
                'total' => $pager->total()
            ]
        ]);
    }

    public function add(Request $request)
    {
        $this->authorize('add', Access::class);
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
        $this->authorize('edit', $access);
        if ($request->input('title'))
            $access->title = $request->input('title');
        if ($request->input('slug'))
            $access->slug = $request->input('slug');

        $access->save();
        return response()->json([
            'code' => '200',
            'msg' => '',
            'result' => $access
        ]);
    }
}
