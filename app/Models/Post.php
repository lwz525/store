<?php
namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
class Post extends BaseModel
{
	use SoftDeletes;//新增一个  deleted_at 列 用于软删除.
	protected $casts=['extra'=>'array'];//模型中的 $casts 属性为属性字段转换到通用数据类型提供了便利方法 。 $casts 属性是数组格式，其键是要被转换的属性名称，其值时你想要转换的类型
	public function user()
	{
		return $this->belongsTo(User::class);
	}
	public function comments()
	{
		return $this->hasMany(PostComment::class);
	}
}