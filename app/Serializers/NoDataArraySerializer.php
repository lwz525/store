<?php
namespace App\Serializers;
use League\Fractal\Serializer\ArraySerializer;
class NoDataArraySerializer extends ArraySerializer
{
    public function collection($resourceKey, array $data)
    {
        return [$resourceKey?:'result'=>$data];
    }
    public function item($resourceKey,array $data)
    {
        return ($resourceKey)?[$resourceKey=>$data]:$data;
    }
}