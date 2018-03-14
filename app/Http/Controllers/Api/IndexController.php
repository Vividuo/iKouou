<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\File;

class IndexController extends Controller
{
    public function init (Request $request)
    {
        $user = \App\Models\User::with('accesses')->find(\Auth::user()->id);
        $data = [
            'user' => $user,
            'token' => csrf_token()
        ];
        return response()->json([
            'code' => '200',
            'msg' => '',
            'result' => $data
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
                    'user' => \Auth::user()
                ]
            ]);
        } else {
            return response()->json([
                'code' => '401',
                'msg' => '用户名或密码错误',
            ]);
        }
    }
    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            if ($file->isValid()){
                // 获取文件相关信息
                $originalName = $file->getClientOriginalName(); // 文件原名
                $ext = $file->getClientOriginalExtension();     // 扩展名
                $size = $file->getClientSize();   //文件大小
                $realPath = $file->getRealPath();   //临时文件的绝对路径
                $mimeType = $file->getClientMimeType();     // image/jpeg

                // 上传文件
                $filename = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
                // 使用我们新建的uploads本地存储空间（目录）
                $bool = \Storage::disk('uploads')->put($filename, file_get_contents($realPath));
                $file = File::create([
                    'uri' => '/uploads/' . $filename,
                    'mime_type' => $mimeType,
                    'size' => $size,
                ]);
                return response()->json([
                    'code' => '200',
                    'msg' => '',
                    'result' => $file
                ]);
            }
        }
        //return print_r($request->file('file'));
    }
}
