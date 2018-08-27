<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUserModel extends Authenticatable
{
    public $table = 'admin_user';

    protected $primaryKey = 'user_id';

    public $timestamps = false;

    /**
     * getModelAttribute
     * @return array
     */
    public function getModelAttribute()
    {
        return [
			"user_name",
			"password",
			"sex",
			"email",
			"create_at",
			"update_at",
			"delete_at",

        ];
    }

}