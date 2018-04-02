<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Model\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class IndexController extends Controller
{
    //后台首页
    public function index()
    {
        return view('admin.index');
    }
    public function info()
    {
        return view('admin.info');
    }

    public function user()
    {
        $user = new BlogUser;

    }
//    public function list()
//    {
//        return view('admin.list');
//    }

    /**
     * 更改密码
     */
    public function pass()
    {
        if ($input = Input::all())
        {
            $rules = [
              'password' => 'required|between:6,20|confirmed',
            ];
            $message =[
                'password.required'=>'新密码不能为空',
                'password.between'=>'新密码必须在6到20位',
                'password.confirmed'=>'两次密码不一致',
            ];
            $validator = Validator::make($input ,$rules,$message);
            if ($validator->passes())
            {
               $user =User::first();
               Crypt::decrypt($user ->pass)
            }else{
//                dd($validator->errors()->all());
//                dd(back()->withErrors($validator));
                return back()->withErrors($validator);
            }
        }else{
            return view('admin.pass');
        }
    }
}
