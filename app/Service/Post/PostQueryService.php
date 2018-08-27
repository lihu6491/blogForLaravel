<?php

namespace App\Service\Post;

use App\Model\PostModel;

class PostQueryService
{
    protected  $PostModel;
    protected  $selectColumn = [];
    protected  $page = 1;
    protected  $pagesize = 10;

    protected  $title;
    protected  $tags;
    protected  $classify;
    protected  $order_id;

    private $classifyList = [
        'all'=> 0,
        'base'=> 1,
        'example'=> 2,
        'frame'=> 3,
        'tool'=> 4,
        'default'=> 5
    ];

    public function __construct( $params = []){

        $this->PostModel = new PostModel;

        if(isset($params['page']) && !empty($params['page']))
            $this->page = $params['page'];

        if(isset($params['limit']) && !empty($params['limit']))
            $this->pagesize = $params['limit'];

        if(isset($params['title']) && !empty($params['title']))
            $this->title = $params['title'];

        if(isset($params['classify']) && !empty($params['classify']))
            $this->classify = $params['classify'];

        if(isset($params['tags']) && !empty($params['tags']))
            $this->tags = $params['tags'];

        if(isset($params['order_id']) && !empty($params['order_id']))
            $this->order_id = $params['order_id'];

        if(!isset($params['selectColum']) || empty($params['selectColum'])){
            $this->selectColumn = [
				'id',
				'title',
				'abstracts',
				'slightly',
				'auth',
				'is_original',
				'classify',
				'tags',
				'top_order',
				'comments_num',
				'zan_num',
				'read_num',
				'status',
				'is_top',
				'is_hide',
				'is_del',
				'updated_at',
				'created_at',
				'deleted_at',

            ];
        }



    }

    /**获取列表
     *
     * @return array
     */
    public function getList(){

        $rest = PostModel :: whereNotNull('id');
        $rest = $rest->where('is_del', '=', 0);
        if(isset($this->title) && !empty($this->title))
            $rest = $rest->where('title', 'like', '%'.$this->title.'%');


        if(isset($this->classify) && !empty($this->classify)  && $this->classify !='all')
            $rest = $rest->where('classify', '=',$this->classifyList[$this->classify]);

        if(isset($this->tags) && !empty($this->tags) && $this->tags !='all')
            $rest = $rest->where('tags', 'like', '%'.$this->tags.'%');

        if(isset($this->order_id) && !empty($this->order_id)){
            $rest = $rest->orderby('is_top','desc')->orderby('updated_at','desc')
                ->paginate ($this->pagesize, $this->selectColumn, $pageName = 'page', $this->page);
        }else{
            $rest = $rest->orderby('id','desc')
            ->paginate ($this->pagesize, $this->selectColumn, $pageName = 'page', $this->page);
        }
        return  $this->procQueryData($rest->toArray());
    }

    /**
     * 处理显示的数据
     * @param $data
     * @return array
     */
    public function procQueryData( $data ){
        if( 0 == $data['total'])
            return [];

        foreach($data['data'] as $key => $post){
            $data['data'][$key]['status_word'] = self::getStatusWord($post['status']);
        }
        return $data;
    }

    /**
     * 获取操作项
     * @param $status
     * @return array
     */
    private static function  getAction(){

        return [];

    }

    /**
     * 获取操作项
     * @param $status
     * @return array
     */
    private static function  getStatusWord($status){
        $statusWordList = [
            PostService::POST_STATUS_TODO => '待发布',
            PostService::POST_STATUS_COMPLETE => '已发布',
            PostService::POST_STATUS_DELETE  => '已删除'
        ];

        return $statusWordList[$status];

    }

}