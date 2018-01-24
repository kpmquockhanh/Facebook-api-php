<?php
$fp = @fopen('token.txt', "w");
$read='';
// Kiểm tra file mở thành công không
if (!$fp) {
  echo 'Mở file không thành công</br>';
}
else
{
  echo "Mở file Thành công</br>";
  $data = gettoken();
  fwrite($fp, $data);
  fclose($fp);
  
}
#------------------------------------------------
function gettoken()
{
  
	$data=request('https://api.facebook.com/restserver.php?api_key=3e7c78e35a76a9299309885393b02d97&email=100008592752666&format=JSON&locale=vi_vn&method=auth.login&password=Beckhuyenbullcho84&return_ssl_resources=0&v=1.0&sig=2db294d2da78ec1e3bb2fb260f362acd');
	$token=json_decode($data,true);
  if($token[access_token])
  {
    echo 'Get token thành công!';
    return $token[access_token];
  }
  
  else
    echo 'Get token thất bại!';
  return '';
}
function request($bot)
{
  $data = curl_init();
  curl_setopt($data, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($data, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36');
  curl_setopt($data, CURLOPT_URL, $bot);
  $result = curl_exec($data);
  curl_close($data);
  return $result;
}
?>