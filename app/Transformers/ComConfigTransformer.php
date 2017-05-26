<?php
namespace App\Transformers;
use App\Models\ComConfig as ccm;
use App\Transformers\BaseTransformer;
class ComconfigTransformer extends BaseTransformer{
    public function getAnchorTagsData(){
        $ccm=new ccm();
        $anchorTags=$ccm->where('type',900)->get(['id','config_name'])->toArray();
        return $anchorTags?$anchorTags:[];
    }
}