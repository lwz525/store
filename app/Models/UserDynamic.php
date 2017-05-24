<?php
namespace App\Models;
class UserDynamic extends BaseModel
{
    public function dynamicImgs()
    {
        return $this->hasMany(DynamicImg::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}