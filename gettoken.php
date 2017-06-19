<?php
function get_token($appid,$appsecret){
  $token_content = file_get_contents('token.txt');
  $token_arr = explode(' ',$token_content);
  $access_token = $token_arr[0];
  $create_time = $token_arr[1];
  echo $create_time;
  $now = time();
  $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
  if($now-$create_time>7000){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    $jsoninfo = json_decode($output, true);
    $access_token = $jsoninfo["access_token"];
    $ct = time();    
    $token_str = "$access_token $ct";
    file_put_contents('token.txt',$token_str);
  }
  return $access_token;

}
$appid = 'wxab58cff39b56733f';
$appsecret = '330fbb88d01b71a875cd9dd7e346186c';
echo get_token($appid,$appsecret);
?>
