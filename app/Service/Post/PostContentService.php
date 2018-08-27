<?php
namespace App\Service\Post;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

use App\Service\Post\PostContentAbstractService;
use App\Model\PostContentModel;

class PostContentService  extends PostContentAbstractService 
{
    protected static $instances = [];

    protected $model;

    protected function __construct(PostContentModel $model)
    {

		$this->id = $model->id;
		$this->postId = $model->post_id;
		$this->postContentMarkdownDoc = $model->post_content_markdown_doc;
		$this->postContentHtmlCode = $model->post_content_html_code;


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

        $model = PostContentModel::where('post_id', $uniqueKey)->first();
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
			"post_id" => array_get($data,"post_id",""),
			"post_content_markdown_doc" => array_get($data,"post_content_markdown_doc",""),
			"post_content_html_code" => array_get($data,"post_content_html_code",""),

        ];

        $Service = DB::transaction(function()use($insertData){
            $model = PostContentModel::create($insertData);
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
		$this->model->post_id = $this->postId;
		$this->model->post_content_markdown_doc = $this->postContentMarkdownDoc;
		$this->model->post_content_html_code = $this->postContentHtmlCode;

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
