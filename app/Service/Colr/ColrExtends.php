<?php
/**
 * colr 常用方法集成类
 * Created by PhpStorm.
 * User: lihu
 * Date: 2018/8/28
 * Time: 下午5:34
 */

namespace App\Service\Colr;

class ColrExtends
{
    private static $options = [];


    public function __construct( $potions = null )
    {
        self::$options = [
            'hostname' => env('APP_URL','localhost'),
            'path'     => 'solr/test',
            'port'     => '8983',
        ];

        if( !empty($potions) && is_array($potions)) self::$options = $potions;
    }

    /**
     * 设置solr库选择
     * @param $core string 库名称
     */
    public static function setCore($core)
    {
        if($core) self::$options['path']='solr/'.$core;
    }

    /**
     * 增加solr索引
     * @param array $fieldArr 索引字段及值
     * @return bool
     */
    public static function addDocument($fieldArr = [])
    {
        $client = new SolrClient(self::$options);
        $doc    = new SolrInputDocument();

        foreach($fieldArr as $k => $v){
            $doc->addField($k,$v);
        }

        $client->addDocument($doc);
        $client->commit();

        return true;
    }

    /**
     * 删除索引 根据pk
     * @param int||array  $id 主键id id可以为数组形式，应用于多选的情况
     * @return bool true
     */
    public static function delDocumentByPk($ids, $type='pk')
    {
        $client = new SolrClient(self::$options);

        if(is_array($ids))
            $client->deleteByIds($ids);
        else
            $client->deleteById($ids);

        $client->commit();

        return true;
    }

    /**
     * 删除索引 根据query
     * @param array||string $qwhere
     * @return bool true
     */
    public static  function delDocumentByQuery($qwhere)
    {
        $client = new SolrClient(self::$options);

        $query = $qwhere;

        if(is_array($qwhere)){
            foreach($qwhere as $k => $v){
                $query .= ' +'.$k.':'.$v;
            }
        }

        $client->deleteByQuery($query);
        $client->commit();

        return true;
    }


    /**
     * 查询
     * @param array $qwhere 关键字
     * @param array $fqwhere 附加条件，根据范围检索，适用于数值型
     * @param array $getField 查询字段
     * @param array $sort 排序 array('duration'=>'asc')  asc:升序，desc:降序
     * @param int $pageindex 查询页数
     * @param int $pagesize 每页显示条数
     * @return mixed
     */
    public static function selectQuery($qwhere=array(),$fqwhere=array(),$getField=array(),$sort=array(),$pageindex=1,$pagesize=20)
    {
        $client = new SolrClient(self::$options);
        $query  = new SolrQuery();
        $sel    = '';

        foreach($qwhere as $k => $v){
            //$sel .= "{$k} : \"{$v}\"";
            $sel .= ' +'.$k.':'.$v;
        }

        $query->setQuery($sel);
        //关键字检索

        //附加条件，根据范围检索，适用于数值型
        if($fqwhere){
            $query->setFacet(true);
            foreach($fqwhere as $k => $v)
                $query->addFacetQuery($v);
            //$query->addFacetQuery('price:[* TO 500]');
        }

        //查询字段
        if($getField){
            foreach($getField as $key => $val)
                $query->addField($val);
        }

        //排序
        if($sort){
            foreach($sort as $k => $v){
                if($v == 'asc')
                    $query->addSortField($k,SolrQuery::ORDER_ASC);
                elseif($v == 'desc')
                    $query->addSortField($k,SolrQuery::ORDER_DESC);
            }
        }

        //分页
        $query->setStart(self::getPageIndex($pageindex,$pagesize));
        $query->setRows($pagesize);

        $queryResponse = $client->query($query);

        $response = $queryResponse->getResponse();

        return $response;
    }

    /**
     * 分页数据处理
     */
    private static function getPageIndex($pageindex, $pagesize)
    {
        if($pageindex <= 1)
            $pageindex = 0;
        else
            $pageindex = ($pageindex-1)*$pagesize;

        return $pageindex;
    }


}
/*
//添加
$fieldArr = array(
    "id" => 15,
    "username" => "si sheng chao",
    "usertype" => 1,
    "last_update_time" => "2016-01-05T03:35:13Z",
);
 *
phpSolr::addDocument($fieldArr);

//删除
//phpsolr::delDocument(15);

 */