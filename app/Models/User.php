<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/24
 * Time: 9:01
 */
namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends BaseModel implements AuthenticatableContract,JWTSubject
{   //软删除和用户验证attempt
    use SoftDeletes,Authenticatable;
    //查询用户的时候,不暴露密码
    protected $hidden=['password','deleted_at'];
    protected $casts
}