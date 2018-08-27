<?php

namespace App\Service\Share;

use App\Model\ShareModel;

class ShareQueryService
{
    protected  $ShareModel;
    protected  $selectColumn = [];
    protected  $page = 1;
    protected  $pagesize = 10;
    protected  $title;

    public function __construct( $params = []){

        $this->ShareModel = new ShareModel;

        if(!isset($params['selectColum']) || empty($params['selectColum'])){
            $this->selectColumn = [
				'id',
				'class_id',
				'title',
				'abstracts',
				'cover',
				'urls',
				'down_info',
				'created_at',
				'updated_at',

            ];

            if(isset($params['page']) && !empty($params['page']))
                $this->page = $params['page'];

            if(isset($params['limit']) && !empty($params['limit']))
                $this->pagesize = $params['limit'];

            if(isset($params['title']) && !empty($params['title']))
                $this->title = $params['title'];
        }



    }

    /**获取列表
     *
     * @return array
     */
    public function getList(){

        $rest = ShareModel :: whereNotNull('id');
        if(isset($this->title) && !empty($this->title))
            $rest = $rest->where('title', 'like', '%'.$this->title.'%');
        $rest = $rest->orderby('id','desc')
                ->paginate ($this->pagesize, $this->selectColumn, $pageName = 'page', $this->page);

        $rest = $rest->toArray();
        return $this->procQueryData($rest);
    }

    /**
     * 处理显示的数据
     * @param $data
     * @return array
     */
    public function procQueryData( $data ){
        if( 0 == $data['total'])
            return [];
        foreach($data['data'] as $key => $share){
            $data['data'][$key]['classWord'] = self::getClassifyWord($share['class_id']);
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

    private static function getClassifyWord($classId)
    {
        $classifyWordList =  [
            1 => '网络资源',
            2 => '网盘资源',
        ];

        return $classifyWordList[$classId];
    }

}