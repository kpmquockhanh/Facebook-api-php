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
	$tk='kpmquockhanh';
	$mk='quockhanh1';
	$data=request('https://api.facebook.com/restserver.php?api_key=3e7c78e35a76a9299309885393b02d97&email='.$tk.'&format=JSON&locale=vi_vn&method=auth.login&password='.$mk.'&return_ssl_resources=0&v=1.0&sig=72749d7a452f2c43bc2e9de508639346');
	$token=json_decode($data,true);
  if($token[access_token])
  {
    echo 'Get token thành công!';
    return $token[access_token];
  }
  
  else
    echo 'Get token thất bại!';
}
function request($bot)
{
  $data = curl_init();
  curl_setopt($data, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($data, CURLOPT_URL, $bot);
  $result = curl_exec($data);
  curl_close($data);
  return $result;
}
?>