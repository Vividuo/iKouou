<?php

namespace App\Http\Controllers\Test;

use Illuminate\Routing\Controller as BaseController;
use App\Models\User;

class TestController extends BaseController
{
    public function phpinfo()
    {
        return phpinfo();
    }

    public function index()
    {
        for ($i = 3; $i < 100; $i ++) {
            dispatch(new \App\Jobs\ImportExcel('test'. $i));
        }

        // $user = User::where('username', 'jiyuanxy')->first();
        // $accesses = collect();
        // $user->roles->each(function ($role) use ($accesses) {
        //     $role->accesses->each(function ($access) use ($accesses) {
        //         $accesses->push($access->slug);
        //     });
        // });
        // $user->accesses->each(function ($access) use ($accesses) {
        //     $accesses->push($access->slug);
        // });
        // //$accesses->push('user-list');
        // dd($accesses->unique());
        //$user = \DB::table('users')->where('username', 'jiyuan')->first();
        //
        // if (\Hash::check('chen123', $user->password)) {
        //     // 密码匹配...
        //     return 'y';
        // } else {
        //     return 'no';
        // }
    }

    public function export()
    {
        $cellData = [
            ['学号','姓名','成绩'],
            ['10001','AAAAA','99'],
            ['10002','BBBBB','92'],
            ['10003','CCCCC','95'],
            ['10004','DDDDD','89'],
            ['10005','EEEEE','96'],
        ];
        \Excel::create('学生成绩', function ($excel) use ($cellData) {
            $excel->sheet('score', function ($sheet) use ($cellData) {
                $sheet->rows($cellData);
            });
        })->export('xlsx');
    }
}
