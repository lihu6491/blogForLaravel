<?php

namespace App\Http\Controllers\Website\Post;

use  App\Http\Controllers\Controller;
use  Illuminate\Http\Request;
use  App\Service\Post\PostService;
use  App\Service\Post\PostContentService;
use  App\Service\Post\PostQueryService;
use  App\Service\Share\ShareQueryService;
use  Illuminate\Support\Facades\DB;
class PostController extends Controller
{


    public function __construct()
    {

    }

    /**
     * 进入文章专栏首页
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public  function index(Request $request)
    {

        $params = $request->all();
        $params['classify'] = $request->route('classify');
        $params['classify'] = isset($params['classify']) && !empty($params['classify']) ? $params['classify'] : 'all';

        $params['tags'] = $request->route('tags');
        $params['tags'] = isset($params['tags']) && !empty($params['tags']) ? $params['tags'] : 'all';

        $params['title'] = isset($params['wd']) && !empty($params['wd']) ? $params['wd'] : '';

        $PostQueryService = new PostQueryService(['order_id'=>'desc']);
        $postlist = $PostQueryService->getList();


        $tagsList = PostService::getTagsAll();
        $tagsList = PostService::procTags($tagsList->toArray());

        return view('website.post.index',['postlist'=>$postlist,'tagsList'=>$tagsList,'params'=>$params]);
    }

    /**
     * 文章阅读
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function show(Request $request)
    {
        $postId = $request->route('id');

        if(!isset($postId) || empty($postId))
            return response()->json(['code'=>400,'msg'=>'文章不存在']);

        $PostService = PostService::getInstance($postId);
        $PostInfo    = $PostService->getModel();

        $PostContentService = PostContentService::getInstance($postId);
        $postContentInfo = $PostContentService->getModel();

        $OrderPost =  PostService::getOrderPost($postId);

        return view('website.post.show',['PostInfo'=>$PostInfo,'postContentInfo'=>$postContentInfo,'OrderPost'=>$OrderPost]);
    }

    /**
     * 获取列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function list(Request $request)
    {
        $params = $request->all();
        $PostQueryService = new PostQueryService($params);
        $list = $PostQueryService->getList();
        if(empty($list))
            return response()->json(['code'=>0,'msg'=>'','count'=>0,'data'=>[]]);

        return response()->json(['code'=>0,'msg'=>'','last_page'=>$list['last_page'],'count'=>$list['total'],'data'=>$list['data']]);
    }


}