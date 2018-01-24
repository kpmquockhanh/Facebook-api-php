<?php
$limit_post = 50;
$token =file_get_contents('token.txt');
$count=0;



$dataget1 = json_decode(request('https://graph.facebook.com/1627991397487791/feed?fields=message&access_token='.$token.'&offset=0&limit='.$limit_post.''),true);
$dataget2 = json_decode(request('https://graph.facebook.com/1307129839300551/feed?fields=message&access_token='.$token.'&offset=0&limit='.$limit_post.''),true);

$dataget= array_merge($dataget1['data'],$dataget2['data']);
// echo count($dataget);
// var_dump($dataget);
foreach ($dataget as $data) {
	if (isset($data['message'])) {

		$message=strtolower($data['message']);
		$dataid=$data['id'];
		if (strpos($message, ' xe ôm ')||strpos($message, ' chở ')||strpos($message, ' đưa mình ')) {
			$id=file_get_contents('id.txt');
			if ($id==='') {
				$fp=fopen('id.txt', 'w');
				fwrite($fp,'|'.$dataid.'~0');
				fclose($fp);
			}
			else {
				$eleid=explode('|', $id);
				$f=false;
				$phan='';
				foreach ($eleid as $ele) {
					$content_id=explode('~', $ele)[0];
					if ($dataid===$content_id) {
						$f=true;
						$phan=$ele;
						break;
					}
				}
				if ($f) {
					$level=explode('~', $phan)[1];
					if ($level==200) {
						//del id
						$temp=file_get_contents('id.txt');
						$temp=str_replace('|'.$phan, '', $temp);
						$fp=fopen('id.txt', 'w');
						fwrite($fp, $temp);
						fclose($fp);
					}
					else
					{
						$temp=file_get_contents('id.txt');
						$temp=str_replace($phan, $dataid.'~'.($level+1), $temp);
						$fp=fopen('id.txt', 'w');
						fwrite($fp, $temp);
						fclose($fp);
					}
				}
				else
				{
					// add
					$temp=file_get_contents('id.txt');
					$fp=fopen('id.txt', 'w');
					fwrite($fp, $temp.'|'.$dataid.'~'.'0');
					fclose($fp);
					//echo $data['message'].'</br>';

					$content2='Link: fb.com/'.$data['id'];

					request('http://kpm.000webhostapp.com/chatBOT/sendmsg.php?id=100004648470648&msg='.urlencode($data['message']));

					request('http://kpm.000webhostapp.com/chatBOT/sendmsg.php?id=100004648470648&msg='.urlencode($content2));	


					
					$count++;
				}
			}
			

		}				
	}
}
echo "$count/$limit_post</br>";
#--------------------------------#

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