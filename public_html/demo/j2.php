<?php

   if( $_POST["limit_post"] || $_POST["reactions_code"] || $_POST["token"] )
   {
		$limit_post=$_POST['limit_post'];
		$token=$_POST['token'];
		$reactions_code=$_POST['reactions_code'];
		$amonika = json_decode(bot_reactions('https://graph.facebook.com/me/home?fields=id,message,created_time,from,comments,type&access_token='.$token.'&offset=0&limit='.$limit_post.''),true);
		for($i=1;$i<=count($amonika[data]);$i++)
		{
			set_time_limit(0);
echo $amonika[data][$i-1][from];
			$reactions = array($reactions_code);
			$mess = $reactions[rand(0,count($reactions)-1)];	
			echo bot_reactions('https://graph.facebook.com/'.$amonika[data][$i-1][id].'/reactions?type='.$mess.'&method=post&access_token='.$token.'');
		}
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