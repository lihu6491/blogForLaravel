<?php
namespace App\Service\Post;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

use App\Service\Post\PostAbstractService;
use App\Model\PostModel;

class PostService  extends PostAbstractService 
{
    protected static $instances = [];

    protected $model;

    protected function __construct(PostModel $model)
    {

		$this->id = $model->id;
		$this->title = $model->title;
		$this->abstracts = $model->abstracts;
		$this->slightly = $model->slightly;
		$this->auth = $model->auth;
		$this->isOriginal = $model->is_original;
		$this->classify = $model->classify;
		$this->tags = $model->tags;
		$this->topOrder = $model->top_order;
		$this->commentsNum = $model->comments_num;
		$this->zanNum = $model->zan_num;
		$this->readNum = $model->read_num;
		$this->status = $model->status;
		$this->isTop = $model->is_top;
		$this->isHide = $model->is_hide;
		$this->isDel = $model->is_del;
		$this->updatedAt = $model->updated_at;
		$this->createdAt = $model->created_at;
		$this->deletedAt = $model->deleted_at;


        $this->model = $model;

        self::$instances[$model->id] = $this;

        return $this;
    }

    /**
     * 获取所有数据
     * @return PostService|null
     */
    public static function getAll()
    {
        return PostModel::all('tags')->toArray();
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

        $model = PostModel::find($uniqueKey);

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
			"title" => array_get($data,"title",""),
			"abstracts" => array_get($data,"abstracts",""),
			"slightly" => array_get($data,"slightly","http://localhost/uploads/default.jpg"),
			"auth" => array_get($data,"auth","admin"),
			"is_original" => array_get($data,"is_original","1"),
			"classify" => array_get($data,"classify","1"),
			"tags" => array_get($data,"tags",""),
			"top_order" => array_get($data,"top_order","1"),
			"comments_num" => array_get($data,"comments_num","0"),
			"zan_num" => array_get($data,"zan_num","0"),
			"read_num" => array_get($data,"read_num","1"),
			"status" => array_get($data,"status","1"),
			"is_top" => array_get($data,"is_top","1"),
			"is_hide" => array_get($data,"is_hide","0"),
			"is_del" => array_get($data,"is_del","0"),
        ];

        $Service = DB::transaction(function()use($insertData){
            $model = PostModel::create($insertData);
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

		$this->model->title = $this->title;
		$this->model->abstracts = $this->abstracts;
		$this->model->slightly = $this->slightly;
		$this->model->auth = $this->auth;
		$this->model->is_original = $this->isOriginal;
		$this->model->classify = $this->classify;
		$this->model->tags = $this->tags;
		$this->model->top_order = $this->topOrder;
		$this->model->comments_num = $this->commentsNum;
		$this->model->zan_num = $this->zanNum;
		$this->model->read_num = $this->readNum;
		$this->model->status = $this->status;
		$this->model->is_top = $this->isTop;
		$this->model->is_hide = $this->isHide;
		$this->model->is_del = $this->isDel;


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

    /**
     * 获取所有的标签
     * @return \Illuminate\Support\Collection
     */
    public static function getTagsAll()
    {
        return DB::table('tags')->get();
    }

    public static function procTags($datas)
    {
        if(empty($datas))
            return [];

        $style = [
            '',
            'layui-bg-orange',
            'layui-bg-green',
            'layui-bg-cyan',
            'layui-bg-blue',
            'layui-bg-black',
        ];

        $rest = [];
        foreach($datas as $key=>$val)
        {

            $tags['name'] = $val->name;
            $tags['style'] = $style[rand(0, 5)];
            $tags['num'] = $val->num;
            $rest [] = $tags;

        }
        return $rest;
    }

    /**获取上一篇 下一篇的文章
     * @param $postId
     * @return array
     */
    public static  function getOrderPost($postId)
    {
        $rest = [
            'next' => [
                'post_id' => 0,
                'title'   => '没有了'
            ],
            'last' => [
                'post_id' => 0,
                'title'   => '没有了'
            ]
        ];

        $nextModel = PostModel::where('id','<' ,$postId)
                                ->where('is_del','<' ,1)
                                ->orderby('id','desc')
                                ->first();

        if(isset($nextModel) && !empty($nextModel)){
            $nextModel = $nextModel->toArray();
            $rest['next'] = [
                'post_id' => $nextModel['id'],
                'title'   => $nextModel['title']
            ];
        }

        $lastModel = PostModel::where('id','>' ,$postId)
            ->where('is_del','<' ,1)
            ->orderby('id','asc')
            ->first();

        if(isset($lastModel) && !empty($lastModel)){
            $lastModel = $lastModel->toArray();
            $rest['last'] = [
                'post_id' => $lastModel['id'],
                'title'   => $lastModel['title']
            ];
        }

        return $rest;
    }


}
