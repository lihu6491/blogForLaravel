<?php
/**
 * Created by PhpStorm.
 * User: lihu
 * Date: 2018/8/10
 * Time: 下午8:18
 */

namespace App\Tool\Gii\app;

use App\Tool\Gii\files\FileBase;

class GeneratorAbstract
{
    private $templatePath;
    protected $fileBase;
    protected $templateContent;
    protected $params;
    protected $generatorPath;

    public function __construct($params)
    {
        $this->params = $params;
        $this->templatePath = base_path()."/app/Tool/Gii/template/";
        $this->fileBase = new FileBase();
    }

    /**
     * 获取模版的内容
     * @param $type
     * @return string
     */
    public function getTemplateContent($type)
    {

        $lines = $this->fileBase->lineGenerator($this->templatePath.$type.".php");
        $TemplateContent = '';
        foreach($lines as $line) {
            $TemplateContent .= $line;
        }

        return  $TemplateContent;

    }

    /**
     * 通过模型类名获取表名称
     * @param $className
     * @return mixed
     */
    public function getTableNameByModelClass($className)
    {
        $myClass = new $className();
        $classVars = get_class_vars(get_class($myClass));
        return $classVars['table'];
    }

    /**
     * 下划线转驼峰
     * @param $str
     * @return null|string|string[]
     */
    public function convertUnderline($str)
    {
        $str = preg_replace_callback('/([-_]+([a-z]{1}))/i',function($matches){
            return strtoupper($matches[2]);
        },$str);
        return $str;
    }

    /**
     * 驼峰转下划线
     * @param $str
     * @return null|string|string[]
     */
    public function humpToLine($str)
    {
        $str = preg_replace_callback('/([A-Z]{1})/',function($matches){
            return '_'.strtolower($matches[0]);
        },$str);
        return $str;
    }

}