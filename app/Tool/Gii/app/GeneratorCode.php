<?php
/**
 * Created by PhpStorm.
 * User: lihu
 * Date: 2018/8/10
 * Time: 下午8:21
 */

namespace App\Tool\Gii\app;

use App\Tool\Gii\app\GeneratorInterface;
use App\Tool\Gii\databases\MysqlClient;


class GeneratorCode
{
    private $insertContent;
    private $Generator;

    public function __construct( $insertContent = []){
        $this->insertContent = $insertContent;
        $this->Mysql = new MysqlClient();
    }

    public function setGenerator(GeneratorInterface $Generator){
        $this->Generator = $Generator;
    }

    public function GeneratorCode(){
        return $this->Generator->Generator();
    }

    public function showTables()
    {
        return  $this->Generator->showTables();
    }

    public function showModels()
    {
        return  $this->Generator->showModels();
    }
}