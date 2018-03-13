<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Avatar;

class AvatarController extends Controller
{
    public function lists(Request $request)
    {

        $size = $request->input('size') ?: 10;
        $paginate = Avatar::paginate($size);
        $paginate->transform(function($item) {
            //$uri = File::find($item->fid)->uri
            $item->url = url($item->image->uri);
            return $item;
        });
        return response()->json([
            'code' => '200',
            'msg' => '',
            'result' => $paginate
        ]);
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'fid' => 'required|integer',
        ]);
        Avatar::create([
            'title' => $request->input('title'),
            'fid' => $request->input('fid')
        ]);
        return response()->json([
            'code' => '200',
            'msg' => '',
            'result' => ''
        ]);
    }
}
