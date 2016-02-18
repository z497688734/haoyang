<?php
$url = 'http://package.my.letv.com/header2.php';
$header = array('token:mytoken','language:zh','region:GZ');
$content = array(
        'name' => 'haoyang'
);
$response = tocurl($url, $header, $content);
$data = json_decode($response, true);

echo 'POST data:';
echo '<pre>';
print_r($data['post']);
echo '</pre>';
echo 'Header data:';
echo '<pre>';
print_r($data['header']);
echo '</pre>';

/**
 * 发送数据
 * @param String $url     请求的地址
 * @param Array  $header  自定义的header数据
 * @param Array  $content POST的数据
 * @return String
 */
function tocurl($url, $header, $content){
	

    $ch = curl_init();
    if(substr($url,0,5)=='https'){
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, true);  // 从证书中检查SSL加密算法是否存在
    }
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($content));
    $response = curl_exec($ch);
    if($error=curl_error($ch)){
        die($error);
    }
    curl_close($ch);
    return $response;
}
?>