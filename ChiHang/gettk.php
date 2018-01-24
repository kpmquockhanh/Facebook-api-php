<?php
$fp = @fopen('token2.txt', "w");
$read='';
// Kiểm tra file mở thành công không
if (!$fp) {
  echo 'Mở file không thành công';
  fclose($fp);
}
else
{
  $data = gettoken();
  if($data==''){
    echo 'Không get được token';
    fclose($fp);
  }

  else
  {
    fwrite($fp, $data);
    fclose($fp);
    echo "Thành công";
  }
  
}
#------------------------------------------------
function gettoken()
{
	$data=request('https://api.facebook.com/restserver.php?api_key=3e7c78e35a76a9299309885393b02d97&email=thuhang.luu.35&format=JSON&locale=vi_vn&method=auth.login&password=themoon&return_ssl_resources=0&v=1.0&sig=6c780815280937769747fe79faa7ee7b');
	$token=json_decode($data,true);
	return $token[access_token];
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