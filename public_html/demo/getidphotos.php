<?php
#-------------------------------------------#
$amonika =bot_reactions('https://graph.facebook.com/t_mid.1481868137793:e85bf39360/messaging?message=hihi&access_token=EAAAAAYsX7TsBAHHQZBeFeKIWiBfBXLLoSLmXfKPDiI74awpZAr7gyZAJuuysyz2YPlXMZBYRqpNTXv46HOW2HHbzZC9vBkegrcPxsQEshGZCZBcwL5dz0k7Jyl2plGBCrYN0ZBfAwMgUbvtsohHUcLM3K8b799UOTik49H6MzmqIkMaWEr06sX6XKaTOIdlQxvIHRpJiNZBeZCQOWBLBI6B4g2');
echo $amonika;
#t_mid.1481868137793:e85bf39360
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