<?php
$limit_post = 25;
$token =file_get_contents('token.txt');

#$commentne='Thật sự là tao không auto đâu nên mày đừng đổ oan cho tao T_T';
$reactions_code = 'LIKE'; # LIKE/LOVE/HAHA/WOW/SAD/ANRY#
#-------------------------------------------#
# Get danh sách ID đặc biệt
$file=file_get_contents('listID/IDlove.txt');
$dsLOVE=explode("|", $file);
$file=file_get_contents('listID/IDangry.txt');
$dsANGRY=explode("|", $file);
#--------------------------------------------

$amonika = json_decode(bot_reactions('https://graph.facebook.com/me/home?fields=id,from,to&access_token='.$token.'&offset=0&limit='.$limit_post.''),true);
$count=0;
$countpage=0;
$likeSinhNhat=false;

foreach ($amonika[data] as $data) {
	# Không like nhưng bài viết đăng lên tường nhà người khác và các bài của page kiểu như Chúc mừng sinh nhật

	if (!$data[to]&&!$data[from][category]||$likeSinhNhat) {

	# $flag là biến cờ TRUE sẽ là đã LOVE hoặc ANGRY rồi
		$flag=false;
		set_time_limit(0);
	# Nếu id có trong danh sách đặc biệt thì LOVE
		foreach ($dsLOVE as $idsp) {

			if (!strcmp($idsp, $data[from][id])) {
				$kq= bot_reactions('https://graph.facebook.com/'.$data[id].'/reactions?type=LOVE&method=post&access_token='.$token);
				# Thử lại nếu react thất bại
				if (!strcmp($kq, '{"success":true}')) {
					echo "Đã YÊU THÍCH ".$data[from][name]."<br/>";
					$flag=true;
					$count++;
				}

				else
				{
					$kq= bot_reactions('https://graph.facebook.com/'.$data[id].'/reactions?type=LOVE&method=post&access_token='.$token);
					# Thử lại nếu react thất bại
					if (!strcmp($kq, '{"success":true}')) {
						echo "Đã YÊU THÍCH ".$data[from][name]."<br/>";
						$flag=true;
						$count++;
					}
				}
				break;	
			}
		}
		# Nếu id có trong danh sách đặc biệt thì ANGRY
		if (!$flag) {
			foreach ($dsANGRY as $idsp) {
				if (!strcmp($idsp, $data[from][id])) {
					$kq= bot_reactions('https://graph.facebook.com/'.$data[id].'/reactions?type=ANGRY&method=post&access_token='.$token);
					if (!strcmp($kq, '{"success":true}')) {
						echo "Đã TỨC GIẬN ".$data[from][name]."<br/>";
						$flag=true;
						$count++;
					}
					
					else
					{
						$kq= bot_reactions('https://graph.facebook.com/'.$data[id].'/reactions?type=ANGRY&method=post&access_token='.$token);
						if (!strcmp($kq, '{"success":true}')) {
							echo "Đã TỨC GIẬN ".$data[from][name]."<br/>";
							$flag=true;
							$count++;
						}
					}
					break;
				}
			}
		}
	# Theo thông thường vẫn like những bài viết
		if (!$flag) {
			foreach ($ds_RANDOM as $idsp) {
				if (!strcmp($idsp, $data[from][id]))
				{
					$randomLIKE=rand(1,10);
					if ($randomLIKE<=2)
					{
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
								
								$count++;
							}
						}
					}
					$flag=true;
				}
			}
			
		}
		if (!$flag) {
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
else
	$countpage++;
}
echo "Tổng hợp: Thành công $count/$limit_post bài viết<br/>Trong đó $countpage bài của page hoặc sinh nhật không được LIKE";




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