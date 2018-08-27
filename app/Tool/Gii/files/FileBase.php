<?php
/**
 * 文件操作类
 * User: lihu
 * Date: 2018/8/10
 * Time: 下午4:30
 */

namespace App\Tool\Gii\files;


class FileBase
{
    private $basePath = '';

    const R = "\n\r";
    const N = "\n";
    const TAB = "\t";

    public function __construct()
    {
        $this->basePath = base_path();
    }


    /**
     * 获取目录下的所有文件
     * @param $dir
     * @return array
     */
    function getDir($dir = ''){

        $dir = $this->basePath."/".$dir;
        $data = [];
        $this->searchDir($dir,$data);

        return $data;
    }


    /**
     * 为指定路径的文件写入内容
     * @param $files
     * @param $content
     * @return bool
     */
    public function write($files,$content)
    {
        if(empty($files) || empty($content))
            return false;

        if ( !is_dir( dirname($files) ) )
            mkdir(dirname($files), 0755, true);

        if(file_exists($files))
            unlink($files);

        try{
            if(!$fileRest =  fopen ($files,"x"))
                return false;

            if(!fwrite ($fileRest,$content))
                return false;

        } finally{
            fclose($fileRest);
        }

        //if (!file_put_contents($files, $content))
        //    return false;

        return true;

    }

    /**
     * 协程遍历文件的内容
     * @param $file
     * @return \Generator
     */
    public function lineGenerator($file) {
        $fp = fopen($file, 'rb');
        try {
            while($line = fgets($fp)) {
                yield $line;
            }
        } finally {
            fclose($fp);
        }

    }


    /**
     * 搜索文件夹
     * @param $path
     * @param $data
     * @param $isfile
     */
    private function searchDir($path,&$data){

        if(is_dir($path)){
            $dp=dir($path);
            while($file=$dp->read()){
                if($file!='.'&& $file!='..'){
                    $this->searchDir($path.'/'.$file,$data);
                }
            }
            $dp->close();
        }

        if(is_file($path))
            $data[]=$path;
    }




}