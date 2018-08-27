<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class WebNavModel extends Model
{
    public $table = 'web_nav';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
		"class_id",
		"name",
		"urls",
		"cover",

    ];//开启白名单字段

    /**
     * getModelAttribute
     * @return array
     */
    public function getModelAttribute()
    {
        return [
			"class_id",
			"name",
			"urls",
			"cover",

        ];
    }

}