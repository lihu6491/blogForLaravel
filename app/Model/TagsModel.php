<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TagsModel extends Model
{
    public $table = 'tags';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
		"name",
		"num",

    ];//开启白名单字段

    /**
     * getModelAttribute
     * @return array
     */
    public function getModelAttribute()
    {
        return [
			"name",
			"num",

        ];
    }

}