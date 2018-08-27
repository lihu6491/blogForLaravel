<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ShareModel extends Model
{
    public $table = 'share';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
		"class_id",
		"title",
		"abstracts",
		"cover",
		"urls",
		"down_info",
		"created_at",
		"updated_at",

    ];//开启白名单字段

    /**
     * getModelAttribute
     * @return array
     */
    public function getModelAttribute()
    {
        return [
			"class_id",
			"title",
			"abstracts",
			"cover",
			"urls",
			"down_info",
			"created_at",
			"updated_at",

        ];
    }

}