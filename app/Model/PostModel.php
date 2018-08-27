<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PostModel extends Model
{
    public $table = 'post';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
		"title",
		"abstracts",
		"slightly",
		"auth",
		"is_original",
		"classify",
		"tags",
		"top_order",
		"comments_num",
		"zan_num",
		"read_num",
		"status",
		"is_top",
		"is_hide",
		"is_del",
		"updated_at",
		"created_at",
		"deleted_at",

    ];//开启白名单字段

    /**
     * getModelAttribute
     * @return array
     */
    public function getModelAttribute()
    {
        return [
			"title",
			"abstracts",
			"slightly",
			"auth",
			"is_original",
			"classify",
			"tags",
			"top_order",
			"comments_num",
			"zan_num",
			"read_num",
			"status",
			"is_top",
			"is_hide",
			"is_del",
			"updated_at",
			"created_at",
			"deleted_at",

        ];
    }

}