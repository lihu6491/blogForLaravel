<?php
/**
 * 创建模型类
 * User: lihu
 * Date: 2018/8/10
 * Time: 下午8:04
 */

namespace App\Tool\Gii\app;

use App\Tool\Gii\app\GeneratorInterface;
use App\Tool\Gii\files\FileBase;
use App\Tool\Gii\databases\MysqlClient;

class GeneratorModel extends GeneratorAbstract implements GeneratorInterface
{
    protected $Mysql;

    public function __construct($params)
    {
        parent ::__construct($params);

        $this->templateContent  = $this->getTemplateContent('model');
        $this->Mysql = new MysqlClient();
        $this->generatorPath = base_path()."/app/Model/";
    }

    public function Generator()
    {
        $this->GeneratorModelName();
        $this->GeneratorTableName();
        $this->GeneratorPK();
        $this->GeneratorCloseTimestamps();
        $this->GeneratorFillable();
        $this->GeneratorGetAttribute();
        $file = $this->generatorPath.$this->params['model_name'].".php";
        return $this->fileBase->write($file, $this->templateContent);
    }

    /**
     * 替换模型名称
     * @return mixed
     */
    protected function GeneratorModelName()
    {
        $ModeName = $this->params['model_name'];
        return $this->templateContent = str_replace("[ModelName]",$ModeName,$this->templateContent);
    }

    /**
     * 替换表名
     * @return mixed
     */
    protected function GeneratorTableName()
    {
        $TableName = $this->params['table_name'];
        $DB_PREFIX = env('DB_PREFIX');

        if(isset($DB_PREFIX) && !empty($DB_PREFIX))
            $TableName = str_replace($DB_PREFIX,'',$TableName);

        return $this->templateContent = str_replace("[TableName]",$TableName,$this->templateContent);
    }

    /**
     * 替换主键
     * @return mixed
     */
    protected function GeneratorPK()
    {
        $tableName = $this->params['table_name'];
        $tableName = str_replace(env('DB_PREFIX'),'',$tableName);
        $Clumns = MysqlClient::showClumns($tableName);
        return $this->templateContent = str_replace("[PK]", $Clumns['pk'],$this->templateContent);
    }

    /**
     * 替换自动更新字段
     * @return mixed
     */
    protected function GeneratorCloseTimestamps()
    {
        $ifGenerator = isset($this->params['Close_timestamps'])  ? 'false' : ' true';
        return $this->templateContent = str_replace("[CloseTimestamps]", $ifGenerator,$this->templateContent);
    }

    /**
     * 替换白名单字段
     * @return mixed|string
     */
    protected  function GeneratorFillable()
    {
        $GetAttributeStr = "";

        if(isset($this->params['Generate_GetAttribute'])) {
            $tableName = $this->params['table_name'];
            $tableName = str_replace(env('DB_PREFIX'),'',$tableName);
            $Clumns = MysqlClient::showClumns($tableName);
            foreach($Clumns as $key => $clumn){
                if(!isset($clumn['Field']))
                    continue;

                $GetAttributeStr .= FileBase::TAB.FileBase::TAB.'"'.$clumn['Field'].'"'.",".FileBase::N;
            }
        }

        return $this->templateContent = str_replace("[Fillable]", $GetAttributeStr,$this->templateContent);
    }

    /**
     * 替换GetAttribute
     * @return mixed|string
     */
    protected function GeneratorGetAttribute()
    {
        $GetAttributeStr = "";

        if(isset($this->params['Generate_GetAttribute'])) {
            $tableName = $this->params['table_name'];
            $tableName = str_replace(env('DB_PREFIX'),'',$tableName);
            $Clumns = MysqlClient::showClumns($tableName);
            foreach($Clumns as $key => $clumn){
                if(!isset($clumn['Field']))
                    continue;

                $GetAttributeStr .= FileBase::TAB.FileBase::TAB.FileBase::TAB.'"'.$clumn['Field'].'"'.",".FileBase::N;
            }
        }

        return $this->templateContent = str_replace("[Generate_GetAttribute]", $GetAttributeStr,$this->templateContent);

    }

    /**
     * 获取全部的表名称
     * @return array
     */
    public function showTables()
    {
        return $this->Mysql->showTables();
    }

}