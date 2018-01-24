<?php
#Khai báo ID người nhận và Nội dung tin nhắn
// echo loadPage('https://m.facebook.com/messages/?tid=mid.1481868137793%3Ae85bf39360&gfid=AQCfQqkxQVwwMZDf&refid=11');
maskAsread();
// logoutFB();
# Đăng nhập vào đẻ lấy cookie
// echo loadPage();
function maskAsread()
{
	$data=loadPage();
	if (strpos($data,'Sukurti profilį')||strpos($data,'đăng nhập')) {
		loginFB();
		$data=loadPage();
	}
	// $link=loadPage('https://m.facebook.com/messages/');
	// $vitri1= strpos($link, $id)-5;
	// $vitri2= strpos($link, $name)-2;
	// $ahihi= substr($link, $vitri1,$vitri2-$vitri1);
	// return loadPage('https://m.facebook.com/messages/');
	loadPage('https://m.facebook.com/messages/read/?tid=mid.1481868137807%3Af4e00f2433&gfid=AQCdpARTNIxEGoYg');
}
function loadPage(string $link='https://m.facebook.com/')
{
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_USERAGENT,'Opera/9.80 (J2ME/MIDP; Opera Mini/9.80 (J2ME/23.377; U; vi) Presto/2.5.25 Version/10.54');
	curl_setopt($ch, CURLOPT_URL,$link);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
	curl_setopt($ch,CURLOPT_COOKIEJAR,'cookie.txt');
	$result=curl_exec($ch);
	curl_close($ch);
	return $result;
}

function loginFB()
{
	logoutFB();
	$url = 'https://m.facebook.com/login.php';
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_USERAGENT,'Opera/9.80 (J2ME/MIDP; Opera Mini/9.80 (J2ME/23.377; U; vi) Presto/2.5.25 Version/10.54');
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, true);    // we want headers
	curl_setopt($ch, CURLOPT_NOBODY, true);    // we don't need body
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch,CURLOPT_COOKIEFILE,'cookie.txt');
	curl_setopt($ch,CURLOPT_COOKIEJAR,'cookie.txt');
	curl_setopt($ch, CURLOPT_POSTFIELDS,array(
		'email' => 'mabusenn',
		'pass' => 'matkhau'));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
}
function logoutFB()
{
	$data = loadPage();
	$vitri1 = strpos($data, 'href="/logout.php');
	$vitri2 = strpos($data, '>Tạo tài khoản Facebook mới');
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