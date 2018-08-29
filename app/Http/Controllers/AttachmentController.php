<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;//必须,用于接收附件文件
use Illuminate\Support\Facades\Storage;//必须,用于编辑文件


class AttachmentController extends  Controller
{
    //允许上传文件类型
    protected $allowMimeType = [
        'AVI'=>'video/x-msvideo',
        'WMV'=>'audio/x-ms-wmv',
        'ASF'=>'video/x-ms-asf',
        'ASX'=>'video/x-ms-asf',
        'RM'=>'audio/x-pn-realaudio',
        'RMVB'=>'audio/x-pn-realaudio',
        'MPG'=>'video/mpeg',
        'MPEG'=>'video/mpeg',
        'MPE'=>'video/mpeg',
        '3GP'=>'video/3gpp',
        'MOV'=>'video/quicktime',
        'MP4'=>'video/mp4',
        'MP4S'=>'application/octet-stream',
        'M4V'=>'video/m4v',
        //'DAT'=>'application/octet-stream',//exe也是此类型
        'MKV'=>'video/x-matroska',
        'FLV'=>'video/x-flv',
        'VOB'=>'video/x-ms-vob',
        'BMP'=>'image/x-ms-bmp',
        'JPG'=>'image/jpeg',
        'JPEG'=>'image/jpeg',
        'TIF'=>'image/tiff',
        'TIFF'=>'image/tiff',
        'PNG'=>'image/png',
        'GIF'=>'image/gif',
        'DOC'=>'application/msword',
        'DOCX'=>'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'XLS'=>'application/vnd.ms-excel',
        'XLS2'=>'application/vnd.ms-office',
        'XLSX'=>'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'PPT'=>'application/vnd.ms-powerpoint',
        'PPTX'=>'application/vnd.openxmlformats-officedocument.presentationml.presentation',
        'TXT'=>'text/plain',
        'PDF'=>'application/pdf',
        'PAGES'=>'',
        'NUMBERS'=>'',
        'RAR'=>'application/x-rar-compressed',
        'RARS'=>'application/x-rar',
        'ZIP'=>'application/zip',
        '7Z'=>'application/x-7z-compressed',
        '7ZS'=>'application/x-7z',
        'CAB'=>'application/vnd.ms-cab-compressed',
        'CAR'=>'application/vnd.curl.car',
        'JAR'=>'application/java-archive',
        'EMPTY'=>'inode/x-empty'
    ];

    protected $allowSizeMin = 1;//允许文件上传最小大小单位B

    protected $allowSizeMax = 10485760;//允许文件上传最大大小 单位B

    /**
     * 上传附件
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function uploads(Request $request){

        $file      = $request->file('file');//得到控件name为[file]的附件对象

        //对附件做有效性验证
        $validRes  = $this->AttachmentisValid ( $file, $this->allowSizeMin, $this->allowSizeMax, $this->allowMimeType );

        if($validRes['Status'] == 'Erro')
            return $validRes;

        //关键处
        // 上传文件至blogPublic本地存储空间（目录）
        $res = Storage::disk('blogPublic')->put($validRes['Msg']['fileName'], file_get_contents($validRes['Msg']['realPath']));

        //获取公开访问地址
        $url = Storage::disk('blogPublic')->url($validRes['Msg']['fileName']);

        if(!$res)
            return response()->json(['Status'=>'Erro','Msg'=>config('msg.attachment.2')]);

        return response()->json(['Status'=>'Success','Msg'=> ['url'=>$url]]);

    }

    /**上传文章封面
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function uploadsPostCover(Request $request)
    {
        $file      = $request->file('file');//得到控件name为[file]的附件对象

        //对附件做有效性验证
        $validRes  = $this->AttachmentisValid ( $file, $this->allowSizeMin, $this->allowSizeMax, $this->allowMimeType );

        if($validRes['Status'] == 'Erro')
            return $validRes;

        //关键处
        // 上传文件至blogPublic本地存储空间（目录）
        $res = Storage::disk('blogPublic')->put($validRes['Msg']['fileName'], file_get_contents($validRes['Msg']['realPath']));

        //获取公开访问地址
        $url = Storage::disk('blogPublic')->url($validRes['Msg']['fileName']);

        if(!$res)
            return response()->json(['Status'=>'Erro','Msg'=>config('msg.attachment.2')]);

        return response()->json(['Status'=>'Success','Msg'=> ['url'=>$url]]);
    }

    /**
     * 验证文件是否可以上传
     * @param $file
     * @param $allowSizeMin
     * @param $allowSizeMax
     * @param $allowMimeType
     * @return array|\Illuminate\Http\JsonResponse
     */

    private function AttachmentisValid($file, $allowSizeMin, $allowSizeMax, $allowMimeType){

        if(!$file->isValid())
            return ['Status'=>'Erro','Msg'=>config('msg.attachment.9')];

        //获取文件的类型
        $mimeType = $file->getMimeType();
        //获取文件的大小
        $fileSize = $file->getClientSize();

        /**
         * 空文件
         */
        if($mimeType == 'inode/x-empty'){
            return ['Status'=>'Erro','Msg'=>config('msg.attachment.5')];
        }

        /**
         * 检测文件大小
         */
        if($fileSize < $allowSizeMin || $fileSize > $allowSizeMax){
            return ['Status'=>'F','Erro'=>'文件不能大小小于'.$allowSizeMin.',不能大于'.$allowSizeMax];
        }

        /**
         * 检测文件类型
         */
        if(!in_array($mimeType, $allowMimeType)){
            return ['Status'=>'Erro','Msg'=>config('msg.attachment.6')];
        }

        $clientFileName = $file->getClientOriginalName();// 文件原名
        $extnsion       = $file->getClientOriginalExtension();//获取文件后缀名
        $realPath       = $file->getRealPath();   //临时文件的绝对路径

        //文件重命名
        $fileName = date('His') . uniqid() . '.' . $extnsion;

        return ['Status'=>'Success','Msg'=>['fileName'=>$fileName,'realPath'=>$realPath]];

        /*
       return array(2) {
         ["Status"]=>
         string(7) "Success"
         ["Msg"]=>
         array(2) {
           ["fileName"]=>
           string(23) "1811245b029b4c9b5e3.jpg"
           ["realPath"]=>
           string(14) "/tmp/phptkXlh5"
         }
       }*/


    }



}