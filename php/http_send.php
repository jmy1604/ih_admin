<?php
/**
  * 发送post请求
  * @param string $url 请求地址
  * @param array $post_data post键值对数据
  * @return string
  */
 function send_post($url, $post_data) {
    $options = array(
        'http' => array(
             'method' => 'POST',
             'header' => 'Content-type:application/x-www-form-urlencoded',
             'content' => $post_data,
             'timeout' => 5 // 超时时间（单位:s）
        )
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
 
    return $result;
}

function sock_post($url, $query) 
{ 
    $info = parse_url($url); 
    $fp = fsockopen($info['host'], $info["port"], $errno, $errstr, 3); 
    $head = "POST ".$info['path']." HTTP/1.0\r\n"; 
    $head .= "Host: ".$info['host']."\r\n"; 
    $head .= "Referer: http://".$info['host'].$info['path']."\r\n"; 
    $head .= "Content-type: application/x-www-form-urlencoded\r\n"; 
    $head .= "Content-Length: ".strlen(trim($query))."\r\n"; 
    $head .= "\r\n"; 
    $head .= trim($query);
    $write = fputs($fp, $head); 
    //print_r(fgets($fp));
    while (!feof($fp)) 
    { 
        $line = fgets($fp); 
        echo $line."<br>"; 
    } 
} 

?>