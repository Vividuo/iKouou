<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\File;

class IndexController extends Controller
{
    public function init (Request $request)
    {
        $user = \Auth::user();
        $permissions = $user ? $user->permissions() : [];
        $data = [
            'user' => $user,
            'permissions' => $permissions,
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
                    'user' => \Auth::user(),
                    'permissions' => \Auth::user() ? \Auth::user()->permissions() : [],
                ]
            ]);
        } else {
            return response()->json([
                'code' => '401',
                'msg' => '用户名或密码错误',
            ]);
        }
    }

    public function excel(Request $request)
    {
        $text = '123';
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filePath = $file->getRealPath();
            //$filePath = 'public\test.xlsx';
            $text = $filePath;
            \Excel::load($filePath, function ($reader) {
                $data = $reader->all();
                dd($data);
            });
            // \Excel::filter('chunk')->load($filePath)->chunk(250, function ($result) {
            //     // $data = $reader->all();
            //     dd($result);
            // });
        }
        // $filePath = 'storage/exports/'.iconv('UTF-8', 'GBK', '学生成绩').'.xls';
        return $text;
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            if ($file->isValid()) {
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
