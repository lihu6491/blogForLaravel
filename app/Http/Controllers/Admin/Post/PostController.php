<?php

namespace App\Http\Controllers\Admin\Post;

use  App\Http\Controllers\Controller;
use  Illuminate\Http\Request;
use  App\Service\Post\PostQueryService;
use  App\Service\Post\PostService;
use  App\Service\Post\PostContentService;

class PostController extends Controller
{

    public function __construct()
    {

    }

    /**
     * 文章列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public  function index(Request $request)
    {
        $params = $request->all();
        $PostQueryService = new PostQueryService($params);
        $list = $PostQueryService->getList();
        if(empty($list))
            return response()->json(['code'=>0,'msg'=>'','count'=>0,'data'=>[]]);

        return response()->json(['code'=>0,'msg'=>'','count'=>$list['total'],'data'=>$list['data']]);
    }

    /**置顶文章
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function dotop(Request $request)
    {
        $params = $request->all();

        if(!isset($params['id']) || empty($params['id']))
            return response()->json(['code'=>400,'msg'=>'置顶失败']);

        $postId = $params['id'];

        $isTop  = $params['is_top'] == 1  ? 0 : 1;
        $PostService = PostService::getInstance($postId);

        $PostService->setIsTop($isTop);
        $PostService->update();

        return response()->json(['code'=>200,'msg'=>'成功']);


    }

    /**
     * 添加文章
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(Request $request)
    {
        $params = $request->all();
        //添加文章
        $PostService = PostService::create($params);
        $Postmodel = $PostService->getModel();

        if(!isset($Postmodel['id']) || empty($Postmodel['id']))
            return response()->json(['code'=>'400']);

        //添加文章内容
        $params['post_id'] = $Postmodel['id'];
        PostContentService::create($params);

        return response()->json(['code'=>'200']);
    }

    /**
     * 进入编辑界面
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function update(Request $request)
    {
        $params = $request->all();

        if(!isset($params['id']) || empty($params['id']))
            return response()->json(['code'=>400,'msg'=>'文章不存在']);

        $PostService = PostService::getInstance($params['id']);
        $PostInfo    = $PostService->getModel();

        $PostContentService = PostContentService::getInstance($params['id']);
        $postContentInfo = $PostContentService->getModel();
        return view('admin.post.edit',['PostInfo'=>$PostInfo,'postContentInfo'=>$postContentInfo]);
    }

    /**
     * 编辑文章
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Request $request)
    {

        $params = $request->all();

        if(!isset($params['post_id']) || empty($params['post_id']))
            return response()->json(['code'=>400,'msg'=>'失败']);

        $postId = $params['post_id'];
        $isTop  = isset($params['is_top']) && $params['is_top'] == 1  ? 1 : 0;
        $isHide  = isset($params['is_hide']) && $params['is_hide'] == 1  ? 1 : 0;
        $isOriginal  = isset($params['is_original']) && $params['is_original'] == 1  ? 1 : 0;
        $PostService = PostService::getInstance($postId);

        //编辑文章
        $PostService->setTitle($params['title']);
        $PostService->setAbstracts($params['abstracts']);
        $PostService->setSlightly($params['slightly']);
        $PostService->setClassify($params['classify']);
        $PostService->setTags($params['tags']);
        $PostService->setStatus($params['status']);
        $PostService->setIsHide($isHide);
        $PostService->setIsOriginal($isOriginal);
        $PostService->setIsTop($isTop);
        $PostService->update();

        //编辑文章内容
        $PostContentService = PostContentService::getInstance($postId);
        $PostContentService->setPostContentMarkdownDoc($params['post_content_markdown_doc']);
        $PostContentService->setPostContentHtmlCode($params['post_content_html_code']);
        $PostContentService->update();

        return response()->json(['code'=>200,'msg'=>'成功']);
    }

    /**
     * 预览
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function show(Request $request)
    {
        $params = $request->all();

        if(!isset($params['id']) || empty($params['id']))
            return response()->json(['code'=>400,'msg'=>'文章不存在']);

        $PostService = PostService::getInstance($params['id']);
        $PostInfo    = $PostService->getModel();

        $PostContentService = PostContentService::getInstance($params['id']);
        $postContentInfo = $PostContentService->getModel();

        return view('admin.post.show',['PostInfo'=>$PostInfo,'postContentInfo'=>$postContentInfo]);
    }

    /**
     * 删除
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $params = $request->all();

        if(!isset($params['id']) || empty($params['id']))
            return response()->json(['code'=>400,'msg'=>'失败']);

        $PostService = PostService::getInstance($params['id']);

        $PostService->setIsDel(1);
        $PostService->setStatus(PostService::POST_STATUS_DELETE);
        $PostService->update();

        return response()->json(['code'=>200,'msg'=>'成功']);
    }

}