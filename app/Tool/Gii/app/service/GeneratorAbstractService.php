<?php
/**
 * Created by PhpStorm.
 * User: lihu
 * Date: 2018/8/12
 * Time: 下午7:57
 */

namespace App\Tool\Gii\app\service;

use App\Tool\Gii\app\GeneratorInterface;
use App\Tool\Gii\app\GeneratorAbstract;
use App\Tool\Gii\files\FileBase;
use App\Tool\Gii\databases\MysqlClient;

class GeneratorAbstractService extends GeneratorAbstract implements GeneratorInterface
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

        $this->templateContent  = $this->getTemplateContent('serviceAbstract');
        if(isset($this->params['Model_Class'])) {
            $tableName = $this->getTableNameByModelClass($this->params['Model_Class']);
            $this->ModelClumns = MysqlClient::showClumns($tableName);
        }

    }

    public function Generator()
    {
        $this->GeneratorNamespace();
        $this->GeneratorAbstractServiceName();
        $this->GeneratorModelAttribute();
        $this->GeneratorSetModelAttribute();
        $this->GeneratorGetModelAttribute();

        $file = $this->generatorPath."/".$this->params['AbstractPath'];
        return $this->fileBase->write($file, $this->templateContent);

    }

    /**
     * 替换命名空间
     * @return mixed
     */
    protected function GeneratorNamespace()
    {
        $Namespace = $this->params['NamespaceVal'].";";
        return $this->templateContent = str_replace("[Namespace]",$Namespace,$this->templateContent);
    }

    /**
     * 替换抽象类名
     * @return mixed
     */
    protected function GeneratorAbstractServiceName()
    {
        $ServiceName = $this->params['Service_Name'];
        $AbstractServiceName = str_replace('Service','AbstractService',$ServiceName).'';
        return $this->templateContent = str_replace("[AbstractServiceName]",$AbstractServiceName,$this->templateContent);
    }

    /**
     * 替换属性
     * @return mixed
     */
    protected function GeneratorModelAttribute()
    {
        $attribute = '';
        foreach($this->ModelClumns as $key => $clumn){
            if(!isset($clumn['Field'])){
                $attributeWord = $this->ModelClumns['pk'];
            }else{
                $attributeWord = $clumn['Field'];
            }
            $attributeWord = $this->convertUnderline($attributeWord);

            $attribute .= FileBase::TAB."protected "."$".$attributeWord.';'.FileBase::N;
        }

        return $this->templateContent = str_replace("[ModelAttribute]",$attribute,$this->templateContent);
    }

    /**
     * 替换替换set方法
     * @return mixed
     */
    protected function GeneratorSetModelAttribute()
    {
        $attribute = '';
        foreach($this->ModelClumns as $key => $clumn){
            if(!isset($clumn['Field'])){
                $attributeWord = $this->ModelClumns['pk'];
            }else{
                $attributeWord = $clumn['Field'];
            }
            $attributeWord = $this->convertUnderline($attributeWord);

            $funStr  = FileBase::TAB.'public function set'.ucwords($attributeWord).'($'.$attributeWord.')'.FileBase::N;
            $funStr .= FileBase::TAB.'{'.FileBase::N;
            $funStr .= FileBase::TAB.FileBase::TAB.'$this->'.$attributeWord." = $".$attributeWord.";".FileBase::N;
            $funStr .= FileBase::TAB.'}'.FileBase::N.FileBase::N;

            $attribute .= $funStr;
        }

        return $this->templateContent = str_replace("[SetModelAttribute]",$attribute,$this->templateContent);
    }

    /**
     * 替换get方法
     * @return mixed
     */
    protected function GeneratorGetModelAttribute()
    {
        $attribute = '';
        foreach($this->ModelClumns as $key => $clumn){
            if(!isset($clumn['Field'])){
                $attributeWord = $this->ModelClumns['pk'];
            }else{
                $attributeWord = $clumn['Field'];
            }
            $attributeWord = $this->convertUnderline($attributeWord);

            $funStr  = FileBase::TAB.'public function get'.ucwords($attributeWord).'()'.FileBase::N;
            $funStr .= FileBase::TAB.'{'.FileBase::N;
            $funStr .= FileBase::TAB.FileBase::TAB.'return $this->'.$attributeWord.";".FileBase::N;
            $funStr .= FileBase::TAB.'}'.FileBase::N.FileBase::N;
            $attribute .= $funStr;
        }

        return $this->templateContent = str_replace("[GetModelAttribute]",$attribute,$this->templateContent);
    }

}