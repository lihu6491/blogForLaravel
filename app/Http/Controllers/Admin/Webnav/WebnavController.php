<?php

namespace App\Http\Controllers\Admin\Webnav;

use  App\Http\Controllers\Controller;
use  Illuminate\Http\Request;
use  App\Service\Webnav\WebNavService;
use  App\Service\Webnav\WebNavQueryService;

class WebnavController extends Controller
{


    public function __construct()
    {

    }

    /**
     * 列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public  function list(Request $request)
    {
        $params = $request->all();
        $WebNavQueryService = new WebNavQueryService($params);
        $list = $WebNavQueryService->getList();
        if(empty($list))
            return response()->json(['code'=>0,'msg'=>'','count'=>0,'data'=>[]]);

        return response()->json(['code'=>0,'msg'=>'','count'=>$list['total'],'data'=>$list['data']]);
    }

    /**
     * 添加
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(Request $request)
    {
        $params = $request->all();
        $WebNavService = WebNavService::create($params);

        if(empty($WebNavService))
            return response()->json(['code'=>'400']);

        return response()->json(['code'=>'200']);
    }

    /**进入编辑页面
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function update(Request $request)
    {
        $params = $request->all();
        if(!isset($params['id']) || empty($params['id']))
            return response()->json(['code'=>400,'msg'=>'导航不存在']);

        $WebNavService = WebNavService::getInstance($params['id']);
        $WebNavInfo = $WebNavService->getModel();
        return view('admin.webnav.edit',['WebNavInfo'=>$WebNavInfo]);

    }

    /**编辑
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Request $request)
    {
        $params = $request->all();
        if(!isset($params['id']) || empty($params['id']))
            return response()->json(['code'=>400,'msg'=>'导航不存在']);
        $WebNavService = WebNavService::getInstance($params['id']);

        $WebNavService->setClassId($params['class_id']);
        $WebNavService->setName($params['name']);
        $WebNavService->setUrls($params['urls']);
        $WebNavService->update();

        return response()->json(['code'=>200,'msg'=>'成功']);
    }

    /**删除
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $params = $request->all();
        if(!isset($params['id']) || empty($params['id']))
            return response()->json(['code'=>400,'msg'=>'导航不存在']);

        $WebNavService = WebNavService::getInstance($params['id']);
        $WebNavService->delete();

        return response()->json(['code'=>200,'msg'=>'成功']);
    }

}