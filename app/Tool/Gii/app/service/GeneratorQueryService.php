<?php

namespace App\Tool\Gii\app\service;

use App\Tool\Gii\app\GeneratorInterface;
use App\Tool\Gii\app\GeneratorAbstract;
use App\Tool\Gii\files\FileBase;
use App\Tool\Gii\databases\MysqlClient;

class GeneratorQueryService extends GeneratorAbstract implements GeneratorInterface
{
    protected $FileBase;
    protected $Mysql;
    protected $ModelClumns;

    public function __construct($params = [])
    {
        parent ::__construct($params);
        $this->FileBase = new FileBase();
        $this->Mysql = new MysqlClient();
        $this->generatorPath = base_path();

        $this->templateContent  = $this->getTemplateContent('serviceQuery');
        $tableName = $this->getTableNameByModelClass($this->params['Model_Class']);
        $this->ModelClumns = MysqlClient::showClumns($tableName);

    }

    public function Generator()
    {
        $this->GeneratorNamespace();
        $this->GeneratorUSEModel();
        $this->GeneratorQueryServiceName();
        $this->GeneratorModelClass();
        $this->GeneratorSelectColumn();
        $this->GeneratorPK();

        $file = $this->generatorPath."/".$this->params['QueryPath'];
        return $this->fileBase->write($file, $this->templateContent);

    }

    /**
     * 替换命名空间
     * @return mixed
     */
    protected function GeneratorNamespace()
    {
        $Namespace = $this->params['NamespaceVal'].";";
        $this->templateContent = str_replace("[Namespace]",$Namespace,$this->templateContent);
    }

    /**
     * 替换引入部分
     * @return mixed
     */
    public function GeneratorUSEModel()
    {

        $USEModel = 'use '.$this->params['Model_Class'].";";
        $this->templateContent = str_replace("[USEModel]",$USEModel,$this->templateContent);

    }

    /**
     * 替换类名
     * @return mixed
     */
    public function GeneratorQueryServiceName()
    {
        $ServiceName = $this->params['Service_Name'];
        $ClassName = str_replace('Service','QueryService',$ServiceName)  ;
        $this->templateContent = str_replace("[ClassName]",$ClassName,$this->templateContent);
    }

    /**
     * 替换模型类名
     * @return mixed
     */
    public function GeneratorModelClass()
    {
        $modelClass = str_replace('App\\Model\\','',$this->params['Model_Class']);
        $this->templateContent = str_replace("[ModelClass]",$modelClass,$this->templateContent);
    }

    /**
     * 替换默认显示列字段
     */
    public function GeneratorSelectColumn()
    {
        $attribute = '';
        foreach($this->ModelClumns as $key => $clumn){
            if(!isset($clumn['Field'])){
                $attributeWord = $this->ModelClumns['pk'];
            }else{
                $attributeWord = $clumn['Field'];
            }

            $attribute .= FileBase::TAB.FileBase::TAB.FileBase::TAB.FileBase::TAB."'$attributeWord',".FileBase::N;

        }

        return $this->templateContent = str_replace("[SelectColumn]",$attribute,$this->templateContent);
    }

    /**
     * 替换主键
     */
    public function GeneratorPK()
    {
        return $this->templateContent = str_replace("[pk]",$this->ModelClumns['pk'],$this->templateContent);
    }

}