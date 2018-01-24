<?php
$tk='kpmquockhanh';
$mk='khongnhomatkhau';
$data=request('https://api.facebook.com/restserver.php?api_key=3e7c78e35a76a9299309885393b02d97&email='.$tk.'&format=JSON&locale=vi_vn&method=auth.login&password='.$mk.'&return_ssl_resources=0&v=1.0&sig=d6d03c6009960db33d53a01082c2f3e0');
$token=json_decode($data,true);
echo $token[access_token];
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
