<?php

#-------------------------------------------#
if ($_GET['idcon']||$_GET['token']) {
#id của conservation
	$idconservation=$_GET['idcon'];
	$token=$_GET['token'];
	$getmsguser=json_decode(bot_reactions('https://graph.facebook.com/'.$idconservation.'?fields=messages,message_count&access_token='.$token),true);
	
	for ($i=count($getmsguser[messages][data]); $i >0 ; $i--) { 
	# lấy ra tin nhắn theo trình tự
		echo $getmsguser[messages][data][$i-1][from][name].': '.$getmsguser[messages][data][$i-1][message].'|';
	}
	#echo $getiduser[data][0][participants][data][0][name];
}

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