<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PostContentModel extends Model
{
    public $table = 'post_content';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
		"post_id",
		"post_content_markdown_doc",
		"post_content_html_code",

    ];//开启白名单字段

    /**
     * getModelAttribute
     * @return array
     */
    public function getModelAttribute()
    {
        return [
			"post_id",
			"post_content_markdown_doc",
			"post_content_html_code",

        ];
    }

}