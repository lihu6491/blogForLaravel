<?php
/**
 * Created by PhpStorm.
 * User: lihu
 * Date: 2018/8/10
 * Time: 下午6:05
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tool\Gii\app\GeneratorCode;
use App\Tool\Gii\app\GeneratorModel;
use App\Tool\Gii\app\GeneratorContraller;
use App\Tool\Gii\app\service\GeneratorInterfaceService;
use App\Tool\Gii\app\service\GeneratorAbstractService;
use App\Tool\Gii\app\service\GeneratorService;
use App\Tool\Gii\app\service\GeneratorQueryService;

class GiiController extends  Controller
{
    protected $GeneratorCode;

    public function __construct(GeneratorCode $GeneratorCode)
    {
        $this->GeneratorCode = $GeneratorCode;
    }

    /**进入创建model的界面
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createModel(Request $request)
    {
        $params = $request->all();
        $this->GeneratorCode->setGenerator(new GeneratorModel($params));
        $tables = $this->GeneratorCode->showTables();

        return view("gii.model",['tables'=>$tables]);
    }

    /**创建model
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function generatorModel(Request $request)
    {
        $params = $request->all();

        $this->GeneratorCode->setGenerator(new GeneratorModel($params));
        $this->GeneratorCode->GeneratorCode();

        return redirect()->route('giiModel');
    }

    /**
     * 创建controller
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function generatorController(Request $request)
    {
        $params = $request->all();

        $this->GeneratorCode->setGenerator(new GeneratorContraller($params));
        $this->GeneratorCode->GeneratorCode();
        return redirect()->route('giiController');
    }

    /**
     * 进入创建Service的界面
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createService(Request $request)
    {
        $params = $request->all();
        $this->GeneratorCode->setGenerator(new GeneratorService($params));
        $models = $this->GeneratorCode->showModels();

        return view("gii.service",['models'=>$models]);
    }

    /**
     * 创建Service
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function generatorService(Request $request)
    {

        $params = $request->all();

        if(isset($params['Generate_Interface_Service'])){
            //创建接口类
            $this->GeneratorCode->setGenerator(new GeneratorInterfaceService($params));
            $this->GeneratorCode->GeneratorCode();
        }

        //创建抽象类
        $this->GeneratorCode->setGenerator(new GeneratorAbstractService($params));
        $this->GeneratorCode->GeneratorCode();

        //创建Service类
        $this->GeneratorCode->setGenerator(new GeneratorService($params));
        $this->GeneratorCode->GeneratorCode();

        //创建Service的列表类
        if(isset($params['Generate_Query_Service'])){
            $this->GeneratorCode->setGenerator(new GeneratorQueryService($params));
            $this->GeneratorCode->GeneratorCode();
        }

        return redirect()->route('giiService');
    }

}