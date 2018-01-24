<?php
$limit=10;
//$msg=json_decode(bot_reactions('https://graph.facebook.com/t_mid.1481868137807%3Af4e00f2433?fields=messages,message_count&access_token='.$token),true);
$access_token=file_get_contents('token.txt');

$msg=json_decode(request('https://graph.facebook.com/t_mid.1481868137807%3Af4e00f2433?fields=messages,message_count&access_token='.$access_token),true);
$c=0;
for ($i=count($msg['messages']['data'])-1; $i >=0 ; $i--) { 
	if (strcmp($msg['messages']['data'][$i]['tags']['data'][1]['name'], 'read')!=0) {
		//send msg
		request('http://kpm.000webhostapp.com/chatBOT/sendmsg.php?id=100004648470648&msg='.urlencode($msg['messages']['data'][$i]['message']));
	}
}

// Mask as Read
// request('http://kpm.000webhostapp.com/chatBOT/maskasread.php');
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