<?php

namespace App\Http\Controllers\Admin\User;

use  App\Http\Controllers\Controller;
use  Illuminate\Http\Request;
use  App\Model\AdminUserModel;
use  Illuminate\Support\Facades\Auth;

class AdminUserController  extends Controller
{

    protected  $AdminUserModel;

    public function __construct(AdminUserModel $AdminUserModel)
    {
        $this->AdminUserModel = $AdminUserModel;
    }

    /**
     * 登陆
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $params = $request->all();

        $password = $params['password'];
        $userName = $params['userName'];

        if(empty($password) || empty($userName))
            return response()->json(['code'=>'400']);

        //开始验证用户信息
        $userInfo = [
            'password'  => $password,
            'user_name' => $userName
        ];

        $verify = Auth::guard('admin')->attempt($userInfo);

        if(!$verify)
            return response()->json(['code'=>'400']);

        $user = Auth::guard('admin')->user();
        $request->session()->put('user_name', $user->user_name);

        return response()->json(['code'=>'200']);
    }

    /**
     * 注销
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function loginout(Request $request){
        Auth::guard('admin')->logout();
        return view('admin.login');
    }

}