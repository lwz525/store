<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/23
 * Time: 18:43
 */
namespace App\Http\Controllers\Api\V1;
use Dingo\Http\Routing\Helpers;
use App\Http\Controllers\Controller;
use Dingo\Api\Exception\ValidationHttpException;
use DB;
use Illuminate\Http\Request;
class BaseController extends Controller
{
    //接口帮助调用
    use Helpers;
    protected $request;
    public function __construct(Request $request)
    {
        DB::connnection()->enableQueryLog();
        $this->request=$request;
    }
    //返回错误的请求
    protected function errorBadRequest($validator)
    {
        $result=[];
        $messsages=$validator->errors()->toArray();
        if($messsages){
            foreach($messsages as $field=>$errors){
                foreach($errors as $error){
                    $result[]=[
                        'field'=>$field,
                        'errormsg'=>$error
                    ];
                }
            }
        }
        return $this->returnErrorResponse(422,$result[0]['errormsg']);
    }
    public function returnSuccessResponse($data=[],$token=[]){
        $arr=[
            'status_code'=>0,
            'message'=>'success'
        ];
        $arr['data']=$data;
        if($token) $arr['tokenInfo']=$token;
        return response()->json($arr);
    }

    public function returnErrorResponse($status_code=0,$message=''){
        if(!$message){
            $errorArr=config('app.errorCode');
            $keys=array_keys($errorArr);
            if(!in_array($status_code,$keys)){
                return false;
            }
            $message=$errorArr[$status_code];
        }
        return response()->json([
            'status_code'=>$status_code,
            'message'=>$message
        ],400);
        exit;
    }
    public function getLastSql()
    {
        $sql=DB::getQueryLog();//调用 getQueryLog 方法可以同时获取多个查询执行后的日志:
        $query=end($sql);//将数组的内部指针指向最后一个单元
        $tmp=str_replace('?','"'.'%s'.'"', $query["query"]);
        $query['query']=vprintf($tmp,$query['bindings']);//输出格式化字符串在一个格式化字符串中显示多个值。

        //作用与 printf() 函数类似，但是接收一个数组参数，而不是一系列可变数量的参数。
        unset($query['bindings']);
        return $query;
    }
    public function http_post_json($url,$jsonStr)
    {
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$jsonStr);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_HTTPHEADER,array(
            'Content-Type:application/json;charset=utf-8',
            'Content-Length:'.strlen($jsonStr
            )
        ));
        $response=curl_exec($ch);
        $httpCode=curl_getinfo($ch,CURLINFO_HTTP_CODE);
        curl_close($ch);
        return array($httpCode,$response);
    }

}