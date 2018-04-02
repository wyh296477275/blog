<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Monolog\Handler\IFTTTHandler;

require_once 'resources/org/code/Code.class.php';
class LoginController extends CommonController
{
    public function login()
    {
        if ($input = Input::all())
        {
            $code = new\Code;
            $_code = $code ->get();
            if ($input['code'] != $_code)
            {
                return back()->with('msg','验证码错误');
            }
            $user = User::first();
            if ($user ->user_name != $input['user_name'] || Crypt::decrypt($user ->user_pass)!=$input['user_pass']){
                return back()->with('msg','用户名或者密码错误');
            }
            session(['user'=>$user]);
//            dd(session('user'));  打印session内容
            return redirect('admin/index');
        }else{
            return view('admin.login');
        }
        return view('admin.login');
    }

    /**
     *  退出
     */
    public function quit()
    {
        session(['user'=> null]);
        return redirect('admin/login');
    }

    public function code()
    {
        $code = new\Code;
        $code -> make();
    }


    /**
     crypt 加密解密
     */
//    public  function crypt()
//    {
//        $str = 123456;
//        $str1= "eyJpdiI6IkErK0dhUUUraTJBMk1DSjBOVkdobFE9PSIsInZhbHVlIjoiWGo0cVREY3hWaGRhbTJsUm9KaDNwZz09IiwibWFjIjoiYjU1MWNmNjllNjdkZDM4ZDA3OWJiOTE3ZmU5ZmFhMWQ1NTY0ZDY2MDU4Njg5OTk2MmE2MTBlNWMxY2Q4ZTczMiJ9";
//
//        echo Crypt::encrypt($str);
//        echo '<br/>';
//
//        echo Crypt::decrypt($str1);
//    }


}
