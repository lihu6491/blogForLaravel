<?php
/**
 * Created by PhpStorm.
 * User: lihu
 * Date: 2018/8/10
 * Time: 下午11:51
 */

namespace App\Tool\Gii\app;

use App\Tool\Gii\app\GeneratorInterface;
use App\Tool\Gii\files\FileBase;

class GeneratorContraller extends GeneratorAbstract implements GeneratorInterface
{

    public function __construct($params)
    {
        parent ::__construct($params);

        $this->templateContent  = $this->getTemplateContent('controller');
    }

    public function Generator()
    {
        $this->GeneratorNamespace();
        $this->GeneratorControllerName();
        $this->GeneratorDefaultAction();
        $file = base_path()."/".$this->params['Controller_Directory']."/".$this->params['Controller_Name'].".php";
        return $this->fileBase->write($file, $this->templateContent);
    }

    /**
     * 替换命名空间
     * @return mixed
     */
    protected function GeneratorNamespace()
    {
        $Namespace = $this->params['Namespace'];
        return $this->templateContent = str_replace("[Namespace]",$Namespace,$this->templateContent);
    }


    /**
     * 替换控制器名称
     * @return mixed
     */
    protected function GeneratorControllerName()
    {
        $ControllerName = $this->params['Controller_Name'];
        return $this->templateContent = str_replace("[ControllerName]",$ControllerName,$this->templateContent);
    }

    /**
     * 替换默认action名称
     * @return mixed
     */
    protected function GeneratorDefaultAction()
    {
        $ActionIDs = $this->params['Action_IDs'];
        return $this->templateContent = str_replace("[ActionIDs]",$ActionIDs,$this->templateContent);
    }

}