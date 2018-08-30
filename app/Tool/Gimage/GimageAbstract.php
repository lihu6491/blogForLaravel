<?php
/**
 * Created by PhpStorm.
 * User: lihu
 * Date: 2018/8/7
 * Time: 下午3:13
 */

namespace App\Tools\Gimage;

//use Intervention\Image\ImageManagerStatic as Image;
use App\Tools\Gimage\ImgCompress;

abstract class GimageAbstract
{
    protected $imgObj;
    protected $saveDirectory = '';
    protected $imgType  = 'jpeg';
    protected $baseSavePath = '';
    protected $insertContent = [];

    public function __construct($insertContent = []){

        $this->imgObj   = self::canvas();
        $this->baseSavePath = base_path().'/public/images/share/';
        if(!empty($insertContent))
            $this->insertContent = $insertContent;
    }


    /**
     * 创建默认的Image
     */
    public static function canvas($width = '750', $height = '980' ,$backgroud = '#FFFFFF'){
        return Image::canvas($width, $height, $backgroud);
    }

    /**
     * 预览Image
     */
    public function preview(){
        return $this->imgObj->response($this->imgType);
    }

    /**
     * 保存图片到本地并返回图片的实例
     * @param string $savePath
     * @return mixed
     */
    public function save($imgName, $savePath = ''){

        if(empty($savePath))
            $savePath = $this->baseSavePath."/".$this->saveDirectory;

        if (!is_dir($savePath))
            mkdir($savePath, 0777,true);

        $files = $savePath."/".$imgName;
        $dst_img = $savePath."/dst_".$imgName;

        if(file_exists($dst_img))
            unlink($dst_img);

        $this->imgObj->save($files);


        (new ImgCompress($files,1))->compressImg($dst_img);

        if(file_exists($files))
            unlink($files);

        return env('APP_URL')."/images/share/".$this->saveDirectory."/dst_".$imgName;
    }

    /**
     * 获取字体路径
     */
    public static function getFontPath()
    {
        return base_path().'/app/Tools/Gimage/font/wrf.ttf';
    }

    /**裁剪图片为圆形图片
     * @param $imgpath
     * @return resource
     */
    public function generatorRoundImg($imgpath) {
        $src_img = '';
        try{
            $src_img = @imagecreatefrompng($imgpath);
        }catch ( Exception $exception){
            $src_img = @imagecreatefromjpeg($imgpath);
        }

        $wh  = getimagesize($imgpath);
        $w   = $wh[0];
        $h   = $wh[1];
        $w   = min($w, $h);
        $h   = $w;
        $img = imagecreatetruecolor($w, $h);
        //这一句一定要有
        imagesavealpha($img, true);
        //拾取一个完全透明的颜色,最后一个参数127为全透明
        $bg = imagecolorallocatealpha($img, 255, 255, 255, 127);
        imagefill($img, 0, 0, $bg);
        $r   = $w /2; //圆半径
        $y_x = $r; //圆心X坐标
        $y_y = $r; //圆心Y坐标
        for ($x = 0; $x < $w; $x++) {
            for ($y = 0; $y < $h; $y++) {
                $rgbColor = imagecolorat($src_img, $x, $y);
                if (((($x - $r) * ($x - $r) + ($y - $r) * ($y - $r)) < ($r * $r))) {
                    imagesetpixel($img, $x, $y, $rgbColor);
                }
            }
        }

        return $img;
    }


}