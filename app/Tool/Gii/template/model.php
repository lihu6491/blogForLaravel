<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class [ModelName] extends Model
{
    public $table = '[TableName]';

    protected $primaryKey = '[PK]';

    public $timestamps = [CloseTimestamps];

    protected $fillable = [
[Fillable]
    ];//开启白名单字段

    /**
     * getModelAttribute
     * @return array
     */
    public function getModelAttribute()
    {
        return [
[Generate_GetAttribute]
        ];
    }

}