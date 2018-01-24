<?php
echo logoutFB();
echo loadPage();









function loadPage()
{
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_USERAGENT,'Opera/9.80 (J2ME/MIDP; Opera Mini/9.80 (J2ME/23.377; U; vi) Presto/2.5.25 Version/10.54');
	curl_setopt($ch, CURLOPT_URL,'https://m.facebook.com/');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
	curl_setopt($ch,CURLOPT_COOKIEJAR,'cookie.txt');
	$result=curl_exec($ch);
	curl_close($ch);
	return $result;
}
function logoutFB()
{
	$data = loadPage();
	$vitri1 = strpos($data, 'href="/logout.php');
	$vitri2 = strpos($data, '>Đăng xuất');
	$url = 'https://m.facebook.com/logout.php'.substr($data, $vitri1+17, $vitri2-1-$vitri1-17);
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_USERAGENT,'Opera/9.80 (J2ME/MIDP; Opera Mini/9.80 (J2ME/23.377; U; vi) Presto/2.5.25 Version/10.54');
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch,CURLOPT_COOKIEFILE,'cookie.txt');
	curl_setopt($ch,CURLOPT_COOKIEJAR,'cookie.txt');
	curl_exec($ch);
	curl_close($ch);
}
?>