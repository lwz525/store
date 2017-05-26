<?php
namespace App\Transformers;
use DB;
use League\Fractal\TransformerAbstract;
class BaseTransformer extends TransformerAbstract
{
    public function __construct()
    {
        DB::connection()->enableQueryLog();
    }
    public function getLastSql()
    {
        $sql=DB::getQueryLog();
        $query=end($sql);
        $tmp=str_replace('?','"'.'%s'.'"',$query['query']);
        $query['query']=vsprintf($tmp,$query['bindings']);
        unset($query['bindings']);
        return $query;
    }
}