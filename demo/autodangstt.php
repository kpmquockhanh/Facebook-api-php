<?php
/*
$msg='test cai multi';
$token='EAAAAAYsX7TsBALfspxGAlS7CZAGnYrZA8xyrRhQ0mYSDcO7csZBbZBFx5iCteBSdb46Lc2NRHNmt2AU6ZCxKtZC5oi5WLmQDKVVUKsTUPxbUWLRK2deAGrTtwd67q0LgYRBa5XznfZCIJNk2R33IT5uUf4Tebo84TvOLJR1V19bnX75ZBliCpQL0LKa35owfcpINxwOVzZCbNoFD7Ay401hBl';

echo bot_reactions('https://graph.facebook.com/457827091244148/feed?access_token='.$token.'&attached_media[0]={"media_fbid":"288402441626707"}&attached_media[1]={"media_fbid":"288402684960016"}'.'&caption='.urlencode($msg).'&method=post');
//288402441626707
//288402684960016
//http://digitalsmiledesign.com/static/i/menu-intro/planning-center.png
*/
#--------------------------------#
if($_POST["linkimg"] && $_POST["token"] && $_POST["caption"] && $_POST["idgroup"])
{
	$linkimg=$_POST['linkimg'];
	$token=$_POST['token'];
	$caption=$_POST['caption'];
	$idgroup=$_POST['idgroup'];
	//Xử lí id group
	$mangid=explode(',', $idgroup);
	//-----------------------------
	//Upload 1 ảnh
	$dem=0;
	$soid=count($mangid);
	foreach ($mangid as $id) {
		$dieukien=bot_reactions('https://graph.facebook.com/'.$id.'/photos?access_token='.$token.'&url='.$linkimg.'&caption='.urlencode($caption).'&method=post');
		$key=explode('"', $dieukien);
		$fl=false;
		foreach ($key as $aa) {
			if (strcmp($aa, "post_id")==0)
			{
				$fl=true;
				break;
			}
		}
		if ($fl) {
			$dem=$dem+1;
		}
	}
	echo "Đăng thành công $dem bài, vui lòng kiểm tra lại lịch sử hoạt động";
	//Đăng lên
	//echo bot_reactions('https://graph.facebook.com/457827091244148/feed?access_token='.$token.'&attached_media[0]={"media_fbid":"288402441626707"}&attached_media[1]={"media_fbid":"288402684960016"}'.'&caption='.urlencode($msg).'&method=post');
	exit();
}
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
<html>
<body>
	<form action="<?php $_PHP_SELF ?>" method="POST">
		<center><h1 >Auto đăng bài vào nhóm</h1></center>
		<center><input type="text" name="linkimg" size="100" placeholder="Link ảnh" /><br /></center>
		<center><input type="text" name="token" size="100" placeholder="Token" /><br /></center>
		<center><textarea rows="15" cols="100" type="text" name="caption" placeholder="Nhập vào nội dung caption"></textarea> <br /></center>
		<center><textarea rows="5" cols="100" placeholder="Nhập vào dãy ID cách nhau  bởi dấu ," name="idgroup"></textarea><br /></center>
		<center><input value="Đăng bài" type="submit" /></center>
	</form>

</body>
</html>