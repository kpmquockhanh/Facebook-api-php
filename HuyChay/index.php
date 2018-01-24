<?php
$limit_post = 25;
$token =file_get_contents('token.txt');

#$commentne='Thật sự là tao không auto đâu nên mày đừng đổ oan cho tao T_T';
$reactions_code = 'LIKE'; # LIKE/LOVE/HAHA/WOW/SAD/ANRY#
#-------------------------------------------#
# Get danh sách ID đặc biệt
// $file=file_get_contents('IDlove.txt');
// $dsLOVE=explode("|", $file);
// $file=file_get_contents('IDangry.txt');
// $dsANGRY=explode("|", $file);
#--------------------------------------------

$amonika = json_decode(bot_reactions('https://graph.facebook.com/me/home?fields=id,from,to&access_token='.$token.'&offset=0&limit='.$limit_post.''),true);
$count=0;
$countpage=0;
$nangcao=true;

foreach ($amonika[data] as $data) {
	
	# Không like nhưng bài viết đăng lên tường nhà người khác và các bài của page kiểu như Chúc mừng sinh nhật
	set_time_limit(0);
	# Theo thông thường vẫn like những bài viết
	$kq= bot_reactions('https://graph.facebook.com/'.$data[id].'/reactions?type=LIKE&method=post&access_token='.$token);
	if (!strcmp($kq, '{"success":true}')) {
		echo "Đã LIKE ".$data[from][name]."<br/>";
		$count++;
	}
	else
	{
		$kq= bot_reactions('https://graph.facebook.com/'.$data[id].'/reactions?type=LIKE&method=post&access_token='.$token);
		if (!strcmp($kq, '{"success":true}')) {
			echo "Đã LIKE ".$data[from][name]."<br/>";
			$flag=true;
			$count++;
		}
	}

		# Phần auto comment
	/*
	if ($amonika[data][$i-1][from][id]==100005742789387)
	{
		$cmt=json_decode(bot_reactions('https://graph.facebook.com/'.$amonika[data][$i-1][id].'/comments?fields=id,from,message&access_token='.$token),true);
		foreach ($cmt[data] as $caccmt)
		{
			if (!strcmp($caccmt[message], $commentne))
				$f1=false;
			break;
		}
		if($f1)
			echo bot_reactions('https://graph.facebook.com/'.$amonika[data][$i-1][id].'/comments?message='.urlencode($commentne).'&method=post&access_token='.$token);
	}
	*/
}
echo "Tổng hợp: Thành công $count/$limit_post bài viết<br/>Trong đó $countpage bài của page không được LIKE";




#--------------------------------#
function bot_reactions($bot)
{
	$data = curl_init();
	curl_setopt($data, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($data, CURLOPT_URL, $bot);
	$result = curl_exec($data);
	curl_close($data);
	return $result;
}
?>