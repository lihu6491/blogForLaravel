<?php
/**
 * Created by PhpStorm.
 * User: lihu
 * Date: 2018/8/12
 * Time: 下午7:58
 */

namespace App\Tool\Gii\app\service;

use App\Tool\Gii\app\GeneratorInterface;
use App\Tool\Gii\app\GeneratorAbstract;

class GeneratorInterfaceService  extends GeneratorAbstract implements GeneratorInterface
{
    public function __construct($params = [])
    {
        parent::__construct($params);

        $this->generatorPath = base_path();
        $this->templateContent = $this->getTemplateContent('serviceInterface');

    }

    public function Generator()
    {
        $this->GeneratorNamespace();
        $this->GeneratorInterfaceServiceName();
        $file = $this->generatorPath."/".$this->params['InterfacePath'];
        return $this->fileBase->write($file, $this->templateContent);
    }

    /**
     * 替换命名空间
     * @return mixed
     */

    public function GeneratorNamespace()
    {
        $Namespace = $this->params['NamespaceVal'].";";
        return $this->templateContent = str_replace("[Namespace]",$Namespace,$this->templateContent);
    }

    /**
     * 替换接口类名
     * @return mixed
     */
    public function GeneratorInterfaceServiceName()
    {
        $ServiceName = $this->params['Service_Name'];
        $InterfaceServiceName = str_replace('Service','InterfaceService',$ServiceName)  ;
        $this->templateContent = str_replace("[InterfaceServiceName]",$InterfaceServiceName,$this->templateContent);
    }


}