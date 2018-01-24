<?php

#-------------------------------------------#
if ($_GET['token']&&!$_GET['flag']) {
	# code...
	$token =$_GET['token'];
#Hiện ra id những người đã nhắn tin với mình
	$getiduser=json_decode(bot_reactions('https://graph.facebook.com/me/conversations?fields=participants,unread_count&access_token='.$token),true);
	if (!$getiduser[error]) {
		# code...
		foreach ($getiduser[data] as $value) {
	# code...
		#echo $value[participants][data][0][name].'-';
			echo $value[participants][data][0][id].'|'.$value[participants][data][0][name].'|';
			if ($value[unread_count]!=0) {
			# code...
				echo 'Có-';
			}else
			echo 'Không-';
		}
#idconservation = $value[data][$i][id]
	}else echo 'fail|fail|fail';
	echo '^';
	if (!$getiduser[error]) {
		# code...
		foreach ($getiduser[data] as $value) {
	# code...
		#echo $value[participants][data][0][name].'-';
			echo $value[participants][data][0][id].'|'.$value[id].'-';
		}
#idconservation = $value[data][$i][id]
	}
}
/*
#id của conservation
	$idconservation='t_mid.1399381460668:5c48ce932b1fdf5b96';
#---------------------

$getmsguser=json_decode(bot_reactions('https://graph.facebook.com/'.$idconservation.'?fields=messages,message_count&access_token='.$token),true);
for ($i=count($getmsguser[messages][data]); $i >0 ; $i--) { 
	# lấy ra tin nhắn theo trình tự
	echo $getmsguser[messages][data][$i-1][from][name].': '.$getmsguser[messages][data][$i-1][message].'<br/>';
}
#echo $getiduser[data][0][participants][data][0][name];
*/
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