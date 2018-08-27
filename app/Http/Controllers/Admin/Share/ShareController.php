<?php

namespace App\Http\Controllers\Admin\Share;

use  App\Http\Controllers\Controller;
use  App\Service\Share\ShareQueryService;
use  Illuminate\Http\Request;
use  App\Service\Share\ShareService;

class ShareController extends Controller
{


    public function __construct()
    {

    }

    public  function index(Request $request)
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
        $ShareService = new ShareQueryService($params);
        $list = $ShareService->getList();
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
        $ShareService = ShareService::create($params);

        if(empty($ShareService))
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
            return response()->json(['code'=>400,'msg'=>'资源不存在']);

        $ShareService = ShareService::getInstance($params['id']);
        $ShareInfo = $ShareService->getModel();
        return view('admin.share.edit',['ShareInfo'=>$ShareInfo]);

    }

    /**编辑
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Request $request)
    {
        $params = $request->all();
        if(!isset($params['id']) || empty($params['id']))
            return response()->json(['code'=>400,'msg'=>'资源不存在']);
        $ShareService = ShareService::getInstance($params['id']);

        $ShareService->setClassId($params['class_id']);
        $ShareService->setUrls($params['urls']);
        $ShareService->setTitle($params['title']);
        $ShareService->setAbstracts($params['abstracts']);
        $ShareService->setCover($params['cover']);
        $ShareService->setDownInfo($params['down_info']);
        $ShareService->update();

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
            return response()->json(['code'=>400,'msg'=>'资源不存在']);

        $ShareService = ShareService::getInstance($params['id']);
        $ShareService->delete();

        return response()->json(['code'=>200,'msg'=>'成功']);
    }
}