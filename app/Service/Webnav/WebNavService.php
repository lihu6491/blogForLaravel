<?php
namespace App\Service\Webnav;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

use App\Service\Webnav\WebNavAbstractService;
use App\Model\WebNavModel;

class WebNavService  extends WebNavAbstractService 
{
    protected static $instances = [];

    protected $model;

    protected function __construct(WebNavModel $model)
    {

		$this->id = $model->id;
		$this->classId = $model->class_id;
		$this->name = $model->name;
		$this->urls = $model->urls;
		$this->cover = $model->cover;


        $this->model = $model;

        self::$instances[$model->id] = $this;

        return $this;
    }

    /**
     * 获取所有数据
     * @return ShareService|null
     */
    public static function getAll()
    {
        return WebNavModel::all()->toArray();
    }

    /**
     * 获取实例
     * @param $uniqueKey
     * @return mixed
     */
    public static function getInstance($uniqueKey)
    {
        if (array_get(self::$instances,$uniqueKey)){
            return self::$instances[$uniqueKey];
        }

        $model = WebNavModel::find($uniqueKey);

        return $model ? new self($model) : null;
    }

    /**
     * 获取模型
     * @return mixed
     */
    public function getModel()
    {
        return $this->model->toArray();
    }

    /**
     * 批量初始化
     * @param $models
     * @return array
     */
    public static function initInstances(Collection $models)
    {
        return $models->map(function($model,$key){
            return new self($model);
        })->toArray();
    }

    /**
     * @param array $data
     * @return Service
     */
    public static function create(array $data)
    {
        $insertData = [
			"class_id" => array_get($data,"class_id",""),
			"name" => array_get($data,"name",""),
			"urls" => array_get($data,"urls",""),
			"cover" => array_get($data,"cover",""),

        ];

        $Service = DB::transaction(function()use($insertData){
            $model = WebNavModel::create($insertData);
            $Service = new self($model);

            return $Service;
        });

        return $Service;
    }

    /**
     * 更新基本数据
     */
    public function update()
    {
		$this->model->class_id = $this->classId;
		$this->model->name = $this->name;
		$this->model->urls = $this->urls;
		$this->model->cover = $this->cover;

        return $this->model->save();
        /*
        DB::transaction(function(){
            $this->model->save();
        });
        */
    }

    /**
     * 删除数据
     * @return mixed
     */
    public function delete()
    {
        return $this->model->delete();
        /*
           DB::transaction(function(){
               $this->model->delete();
           });
        */
    }

    /**分类处理数据
     * @param $data
     * @return array
     */
    public static function procList($data)
    {
        if(empty($data) )
            return [];
        $rest = [];
        foreach($data as $key => $nav){

            switch ($nav['class_id']){
                case 1:
                    $rest['gfwz'][] = $nav;
                    break;
                case 2:
                    $rest['zxgj'][] = $nav;
                    break;
                case 3:
                    $rest['gspxxw'][] = $nav;
                    break;
                case 4:
                    $rest['kfwd'][] = $nav;
                    break;
                case 5:
                    $rest['zyk'][] = $nav;
                    break;
                case 6:
                    $rest['zh'][] = $nav;
                    break;
            }
        }
        return $rest;
    }

}
