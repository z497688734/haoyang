<?php
$post_data = $_POST;
$header = get_all_headers();

$ret = array();
$ret['post'] = $post_data;
$ret['header'] = $header;

header('content-type:application/json;charset=utf8');
echo json_encode($ret, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);

/**
 * 获取自定义的header数据
 */
function get_all_headers(){

    // 忽略获取的header数据
    $ignore = array('host','accept','content-length','content-type');

    $headers = array();

    
    foreach($_SERVER as $key=>$value){
    	
        if(substr($key, 0, 5)==='HTTP_'){
            $key = substr($key, 5);
            $key = str_replace('_', ' ', $key);
            $key = str_replace(' ', '-', $key);
            $key = strtolower($key);

            if(!in_array($key, $ignore)){
                $headers[$key] = $value;
            }
        }
    }

    return $headers;

}
?> 