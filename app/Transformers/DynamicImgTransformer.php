<?php
namespace App\Transformers;
use App\Transformers\UserTransformer as ut;
use App\Transformers\BaseTransformer;
use App\Models\DynamicImg as di;
use App\Transformers\UserPayDynamicsRecordTransformer as updrt;
use App\Transformers\DynamicsPariseTransformer as dpt;
class DynamicImgTransformer extends BaseTransformer{
    public function getDys($model='',$userModel=''){
        if(!$model || !$userModel){
            return false;
        }
        $userDyModelArr=collect($model)->toArray();
        $data=$userDyModelArr['data'];
        $data=$this->prendArr($data,$userModel);
        if(!empty($data)){
            unset($userDyModelArr['data']);
            $pageInfo=$userDyModelArr;
        }
    }
}