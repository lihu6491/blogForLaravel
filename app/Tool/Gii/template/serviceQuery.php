<?php

[Namespace]

[USEModel]

class [ClassName]
{
    protected  $[ModelClass];
    protected  $selectColumn = [];
    protected  $page = 1;
    protected  $pagesize = 10;

    public function __construct( $params = []){

        $this->[ModelClass] = new [ModelClass];

        if(!isset($params['selectColum']) || empty($params['selectColum'])){
            $this->selectColumn = [
[SelectColumn]
            ];
        }



    }

    /**获取列表
     *
     * @return array
     */
    public function getList(){

        $rest = [ModelClass] :: whereNotNull('[pk]');
        $rest = $rest->orderby('[pk]','desc')
                ->paginate ($this->pagesize, $this->selectColumn, $pageName = 'page', $this->page);

        return $rest->toArray();
    }

    /**
     * 处理显示的数据
     * @param $data
     * @return array
     */
    public function procQueryData( $data ){
        if( 0 == $data['total'])
            return [];

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

}