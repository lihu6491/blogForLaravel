<?php

namespace App\Http\Controllers\Website;

use  App\Http\Controllers\Controller;
use  Illuminate\Http\Request;
use  App\Service\Post\PostQueryService;
use  App\Service\Share\ShareQueryService;

class IndexController extends Controller
{


    public function __construct()
    {

    }

    public  function index(Request $request)
    {
        $params = $request->all();

        //获取文章列表
        $PostQueryService = new PostQueryService($params);
        $postList = $PostQueryService->getList();

        //获取分享列表
        $shareParams['page']  = 1;
        $shareParams['limit'] = 5;
        $ShareService = new ShareQueryService($shareParams);

        $shareList = $ShareService->getList();

        return view('website.index',['postList'=>$postList,'shareList'=>$shareList]);
    }
}