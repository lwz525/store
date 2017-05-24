<?php
if(!function_exists('auth_user')){
    // get the auth_user
    function auth_user()
    {
        return app('Dingo\Api\Auth\Auth')->user();
    }
}
if(!function_exists('dingo_route')){
    /**
     * 根据别名获得url.
     *
     * @param string $version
     * @param string $name
     * @param string $params
     *
     * @return string
     */
     return app('Dingo\Api\Routing\Urlgererator')
     ->version($version)
     ->route($name,$params);
}

if(!function_exists('trans')){
    /**
     * Translate the given message.
     *
     * @param string $id
     * @param array  $parameters
     * @param string $domain
     * @param string $locale
     *
     * @return string
     */
     function trans($id=null,$parameters=[],$domain='messages',$locale=null)
     {
         if(is_null($id)){
             return app('translator')->trans($id,$parameters,$domain,$locale);
         }
     }
}
if(!function_exists('p')){
    function p($data,$ex=0){
        $str='<pre>';
        if(is_bool($data)){
            $show_data=$data?'true':'false';
        }elseif(is_null($data)){
            $show_data='null';
        }else{
            $show_data=print_r($data,true);
        }
        $str.=$show_data;
        $str.='</pre>';
        echo $str;
        if($ex){
            exit;
        }
    }
}