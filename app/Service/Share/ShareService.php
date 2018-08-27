<?php
namespace App\Service\Share;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

use App\Service\Share\ShareAbstractService;
use App\Model\ShareModel;

class ShareService  extends ShareAbstractService 
{
    protected static $instances = [];

    protected $model;

    protected function __construct(ShareModel $model)
    {

		$this->id = $model->id;
		$this->classId = $model->class_id;
		$this->title = $model->title;
		$this->abstracts = $model->abstracts;
		$this->cover = $model->cover;
		$this->urls = $model->urls;
		$this->downInfo = $model->down_info;
		$this->createdAt = $model->created_at;
		$this->updatedAt = $model->updated_at;


        $this->model = $model;

        self::$instances[$model->id] = $this;

        return $this;
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

        $model = ShareModel::find($uniqueKey);

        return $model ? new self($model) : null;
    }

    /**
     * 获取所有数据
     * @return ShareService|null
     */
    public static function getAll()
    {
        return ShareModel::all()->toArray();
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
			"title" => array_get($data,"title",""),
			"abstracts" => array_get($data,"abstracts",""),
			"cover" => array_get($data,"cover",""),
			"urls" => array_get($data,"urls",""),
			"down_info" => array_get($data,"down_info",""),

        ];

        $Service = DB::transaction(function()use($insertData){
            $model = ShareModel::create($insertData);
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
		$this->model->title = $this->title;
		$this->model->abstracts = $this->abstracts;
		$this->model->cover = $this->cover;
		$this->model->urls = $this->urls;
		$this->model->down_info = $this->downInfo;
		$this->model->created_at = $this->createdAt;
		$this->model->updated_at = $this->updatedAt;

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

    /*
     * 分类处理数据
     */
    public static function procSahreList($data)
    {
        if(empty($data))
            return [];
        $rest = [];

        foreach($data as $key => $share){

           if(isset($share['downInfo']) && !empty($share['downInfo'])){
               $rest['wp'][] = $share;
           }else{
               $rest['wl'][] = $share;
           }
        }

        return $rest;
    }

}
