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

class User extends BaseModel implements AuthenticatableContract, JWTSubject

{   //软删除和用户验证attempt
    use SoftDeletes,Authenticatable;
    //查询用户的时候,不暴露密码
    protected $hidden=['password','deleted_at'];
    protected $casts=['cover'=>'array'];
    public function userFansJoins()
    {
        return $this->hasMany(UserFansJoin::class);
    }
    public function userFollowJoins()
    {
        return $this->hasMany(UserFollowJoin::class);
    }
    public function comConfigs()
    {
       return $this->belongsToMany(ComConfig::class,'user_tag_joins','user_id','tag_id');
    }
    public function Areas()
    {
        return $this->hasOne(Area::class,'region_id','city');
    }
    public function evaluates()
    {
        return $this->belongsToMany(Evaluate::class,'user_evaluate_joins','user_id','evaluate_id');
    }
    public function DynamicImgs()
    {
        return $this->hasMany(DynamicImg::class);
    }
    public function UserDynamics()
    {
        return $this->hasMany(UserDynamic::class);
    }
    //jwt需要实现的方法
    public function getJWTIdentifier()
    {
        // TODO: Implement getJWTIdentifier() method.
        return $this->getKey();
    }
    //jwt 需要实现的方法
    public function getJWTCustomClaims()
    {
        // TODO: Implement getJWTCustomClaims() method.
        return [];
    }
}