<?php
#Khai báo ID người nhận và Nội dung tin nhắn
if ($_GET['id']&&$_GET['msg']){
	$ID=$_GET['id'];
	$msg=$_GET['msg'];
	$kq=sendFB($ID,$msg);
	if (!$kq) {
		echo 'Gửi thành công tin nhắn: '.'"'.$msg.'"';
	}
	else
		echo "Không thành công tin nhắn";
}
else
	echo 'Không đủ dữ liệu';
// logoutFB();
# Đăng nhập vào đẻ lấy cookie
// echo loadPage();
function sendFB($id,$messages)
{
	$data=loadPage();
	if (strpos($data,'Sukurti profilį')||strpos($data,'đăng nhập')) {
		loginFB();
		$data=loadPage();
	}
	$vitri = strpos($data, 'name="fb_dtsg"');
	$fb_dtsg = substr($data, $vitri+22, 25);
	// $dulieu='fb_dtsg='.$fb_dtsg.'&body=2222222&tids=mid.1481868137793%3Ae85bf39360&ids%5B100013708598031%5D=100013708598031: undefined';
	$dulieu2='fb_dtsg='.$fb_dtsg.'&ids%5B'.$id.'%5D='.$id.'&body='.urlencode($messages);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
	curl_setopt($ch,CURLOPT_COOKIEJAR,'cookie.txt');
	curl_setopt($ch,CURLOPT_USERAGENT,'Opera/9.80 (J2ME/MIDP; Opera Mini/9.80 (J2ME/23.377; U; vi) Presto/2.5.25 Version/10.54');
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_URL,'https://m.facebook.com/messages/send/');
	curl_setopt($ch, CURLOPT_POSTFIELDS,$dulieu2);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$kq = curl_exec ($ch);
	curl_close ($ch);
	return $kq;
	
}

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
		'email' => 'kpmquockhanh',
		'pass' => 'khongmatkhau'));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	$result = curl_exec($ch);
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