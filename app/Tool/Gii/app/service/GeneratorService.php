<?php
/**
 * Created by PhpStorm.
 * User: lihu
 * Date: 2018/8/10
 * Time: 下午8:20
 */

namespace App\Tool\Gii\app\service;

use App\Tool\Gii\app\GeneratorInterface;
use App\Tool\Gii\app\GeneratorAbstract;
use App\Tool\Gii\files\FileBase;
use App\Tool\Gii\databases\MysqlClient;

class GeneratorService extends GeneratorAbstract implements GeneratorInterface
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

        $this->templateContent  = $this->getTemplateContent('service');
        if(isset($this->params['Model_Class'])) {
            $tableName = $this->getTableNameByModelClass($this->params['Model_Class']);
            $this->ModelClumns = MysqlClient::showClumns($tableName);
        }

    }

    public function Generator()
    {
        $this->GeneratorNamespace();
        $this->GeneratorInterfaceUSE();
        $this->GeneratorAbstractUSE();
        $this->GeneratorServiceName();
        $this->GeneratorConstructParams();
        $this->GeneratorServiceAttribute();

        if(isset($this->params['Generate_CRUD'])){
            $this->GeneratorInsertData();
            $this->GeneratorUpdateData();
        }

        $file = $this->generatorPath."/".$this->params['Service_Directory']."/".$this->params['Service_Name'].".php";
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
    public function GeneratorAbstractUSE()
    {

        $Namespace = str_replace('namespace ','',$this->params['NamespaceVal']);
        $ServiceName = $this->params['Service_Name'];
        $AbstractServiceName = str_replace('Service','AbstractService',$ServiceName).'';
        $USEServiceAbstract = "use ".$Namespace."\\".$AbstractServiceName.";";
        $this->templateContent = str_replace("[USEServiceAbstract]",$USEServiceAbstract,$this->templateContent);

    }

    /**
     * 替换引入部分
     * @return mixed
     */
    public function GeneratorInterfaceUSE()
    {
        if(!isset($this->params['Generate_Interface_Service']))
            return $this->templateContent = str_replace("[USEServiceInterface]",'',$this->templateContent);


        $Namespace = str_replace('namespace ','',$this->params['NamespaceVal']);
        $ServiceName = $this->params['Service_Name'];
        $AbstractServiceName = str_replace('Service','InterfaceService',$ServiceName).'';
        $USEServiceInterface = "use ".$Namespace."\\".$AbstractServiceName.";";
        $this->templateContent = str_replace("[USEServiceInterface]",$USEServiceInterface,$this->templateContent);
    }

    /**
     * 替换类名
     * @return mixed
     */
    public function GeneratorServiceName()
    {
        $ServiceName = $this->params['Service_Name'];
        $this->templateContent = str_replace("[ServiceName]",$ServiceName,$this->templateContent);

        $AbstractServiceName = str_replace('Service','AbstractService',$ServiceName).'';
        $this->templateContent = str_replace("[ServiceAbstract]"," extends ".$AbstractServiceName,$this->templateContent);

        if(isset($this->params['Generate_Interface_Service'])){
            $AbstractServiceName = str_replace('Service','InterfaceService',$ServiceName).'';
            $this->templateContent = str_replace("[ServiceInterface]"," implements ".$AbstractServiceName,$this->templateContent);
        }else{
            $this->templateContent = str_replace("[ServiceInterface]",'',$this->templateContent);
        }
    }

    /**
     * 替换命名空间的参数
     * @return mixed
     */
    public function GeneratorConstructParams()
    {
        $ModelClass = $this->params['Model_Class'];
        $this->templateContent = str_replace("[USEModelClass]","use ".$ModelClass.";",$this->templateContent);
        $ModelClass = str_replace('App\\Model\\','',$this->params['Model_Class']);
        $this->templateContent = str_replace("[ModelClass]",$ModelClass,$this->templateContent);

    }

    /**
     * 替换默认属性
     * @return mixed
     */
    public function GeneratorServiceAttribute()
    {
        $ServiceAttribute = '';
        $modelPk = $this->ModelClumns['pk'];

        $this->templateContent = str_replace("[ModelPK]",$modelPk,$this->templateContent);

        foreach($this->ModelClumns as $key => $clumn){
            $attributeWord = '';
            $attributeVal  = '';
            if(!isset($clumn['Field'])){
                $attributeVal = $this->ModelClumns['pk'];
            }else{
                $attributeVal = $clumn['Field'];
            }

            $attributeWord = $this->convertUnderline($attributeVal);

            $ServiceAttribute .= FileBase::TAB.FileBase::TAB.'$this->'.$attributeWord." = ".'$model->'.$attributeVal.';'.FileBase::N;
        }

        $this->templateContent = str_replace("[ServiceAttribute]",$ServiceAttribute,$this->templateContent);

    }

    /**
     * 替换添加数据
     * @return mixed
     */

    public function GeneratorInsertData()
    {
        $insertData = '';
        foreach($this->ModelClumns as $key => $clumn){

            if(!isset($clumn['Field']))
                continue;
            $insertData .= FileBase::TAB.FileBase::TAB.FileBase::TAB.'"'.$clumn['Field'].'" => array_get($data,"'.$clumn['Field'].'",""),'.FileBase::N;
        }
        $this->templateContent = str_replace("[InsertData]",$insertData,$this->templateContent);

    }

    /**
     * 替换更新数据
     * @return mixed
     */

    public function GeneratorUpdateData()
    {
        $updateData = '';
        foreach($this->ModelClumns as $key => $clumn) {

            if (!isset($clumn['Field']))
                continue;
            $updateData .= FileBase::TAB.FileBase::TAB.'$this->model->'.$clumn['Field'].' = $this->'.$this->convertUnderline($clumn['Field']).';'.FileBase::N;
        }

        $this->templateContent = str_replace("[UpdateData]",$updateData,$this->templateContent);

    }



    /**
     * 显示所有的模型类
     * @return array
     */
    public function showModels()
    {
        $models = $this->FileBase->getDir('app/Model');
        $rest = [];
        foreach($models as $key => $model){
            if(substr(strrchr($model, '.'), 1) !='php')
                continue;

            $model = str_replace(base_path()."/app/","App\\",$model);
            $model = str_replace(".php","",str_replace("/","\\",$model));
            $rest [] = $model;
        }

        return $rest;
    }


}