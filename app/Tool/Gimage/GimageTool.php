<?php
/**
 * Created by PhpStorm.
 * User: lihu
 * Date: 2018/8/7
 * Time: 下午4:35
 */

namespace App\Tools\Gimage;

use App\Tools\Gimage\GimageInterface;

class GimageTool
{
    private $insertContent;
    private $Gimage;

    public function __construct( $insertContent = []){
        $this->insertContent = $insertContent;
    }

    public function setGimage(GimageInterface $Gimage){
        $this->Gimage = $Gimage;
    }

    public function generatorImage(){
        return $this->Gimage->generatorImage();
    }

}