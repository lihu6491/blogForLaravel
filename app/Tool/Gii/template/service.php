<?php
[Namespace]

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
[USEServiceInterface]
[USEServiceAbstract]
[USEModelClass]

class [ServiceName] [ServiceAbstract] [ServiceInterface]
{
    protected static $instances = [];

    protected $model;

    protected function __construct([ModelClass] $model)
    {

[ServiceAttribute]

        $this->model = $model;

        self::$instances[$model->[ModelPK]] = $this;

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

        $model = [ModelClass]::find($uniqueKey);

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
[InsertData]
        ];

        $Service = DB::transaction(function()use($insertData){
            $model = [ModelClass]::create($insertData);
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
[UpdateData]
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


}
