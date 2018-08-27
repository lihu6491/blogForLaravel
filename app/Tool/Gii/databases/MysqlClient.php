<?php
/**
 * 数据库操作类型
 * User: lihu
 * Date: 2018/8/10
 * Time: 下午2:52
 */

namespace App\Tool\Gii\databases;

use Illuminate\Support\Facades\DB;

class MysqlClient
{
    private $tableSchema = ''; // 数据库名称


    public function __construct($tableSchema =  NULL)
    {
        if(empty($tableSchema))
            $this->tableSchema = env('DB_DATABASE', 'forge');
    }

    /**
     * 获取数据库下的所有表名称
     * @return array
     */
    public function showTables()
    {
        $sql = "SELECT
                    table_name
                FROM
                    information_schema. TABLES
                WHERE
                    TABLE_SCHEMA = '{$this->tableSchema}' ";
        $tables = DB::select($sql);

        if(empty($tables))
            return [];

        $rest = [];

        foreach ($tables as $article){
            $tableName = isset($article->table_name) ? $article->table_name : $article->TABLE_NAME;
            $rest[] = $tableName;
        }
        return $rest;

    }

    /**获取表的结构
     * @param $tableName
     * @return array
     */
    public static  function showClumns($tableName)
    {
        if(empty($tableName))
            return [];

        $tableName = env('DB_PREFIX').$tableName;

        $sql = "show columns from {$tableName}";
        $clumns = DB::select($sql);

        if(empty($clumns))
            return [];

        $rest = [];

        foreach ($clumns as $article){

            if($article->Key == 'PRI'){
                $rest['pk'] = $article->Field;
                continue;
            }

            $rest[] = [
                'Field'    => $article->Field,
                'Type'     => $article->Type,
                'Null'     => $article->Null,
                'Key'      => $article->Key,
                'Default'  => $article->Default,
            ];
        }
        return $rest;
    }
}