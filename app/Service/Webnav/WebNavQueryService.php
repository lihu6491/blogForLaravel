<?php

namespace App\Service\Webnav;

use App\Model\WebNavModel;

class WebNavQueryService
{
    protected  $WebNavModel;
    protected  $selectColumn = [];
    protected  $page = 1;
    protected  $pagesize = 10;
    protected  $name;

    public function __construct( $params = []){

        $this->WebNavModel = new WebNavModel;

        if(!isset($params['selectColum']) || empty($params['selectColum'])){
            $this->selectColumn = [
				'id',
				'class_id',
				'name',
				'urls',
				'cover',

            ];
        }

        if(isset($params['page']) && !empty($params['page']))
            $this->page = $params['page'];

        if(isset($params['limit']) && !empty($params['limit']))
            $this->pagesize = $params['limit'];

        if(isset($params['name']) && !empty($params['name']))
            $this->name = $params['name'];

    }

    /**获取列表
     *
     * @return array
     */
    public function getList(){

        $rest = WebNavModel :: whereNotNull('id');
        if(isset($this->name) && !empty($this->name))
            $rest = $rest->where('name', 'like', '%'.$this->name.'%');
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
        foreach($data['data'] as $key => $post){
           $data['data'][$key]['classifyWord'] = self::getClassifyWord($post['class_id']);
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
            1 => '官方网站',
            2 => '在线工具',
            3 => '视频学习',
            4 => '开发文档',
            5 => '静态资源库',
            6 => '综合',
        ];

        return $classifyWordList[$classId];
    }

}