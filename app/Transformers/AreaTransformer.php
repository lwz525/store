<?php
namespace App\Transformers;
use App\Models\Area;
class AreaTransformer extends BaseTransformer
{
    public function getAllCity()
    {
        $am=new Area();
        $allData=$am->select('region_id as id','parent_id as pid','region_name as area')->whereBetween('region_type',[1,2])->get()->toArray();
        $idData=collect($allData)->keyBy('id')->all();
        $area=$this->find_child($idData);
        $return_data=$area?$area:array();
        return $return_data?$return_data:array();
    }
    public function find_child($arr='')
    {
        if(!is_array($arr)){
            return false;
        }
        foreach($arr as $k=>$v){
            if(isset($arr[$v['pid']])){
                $arr[$v['pid']]['son'][]=&$arr[$v['id']];
            }else{
                $tree[]=&$arr[$v['id']];
            }
        }
        return $tree;
    }
}