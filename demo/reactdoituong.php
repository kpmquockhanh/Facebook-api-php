<?php

if($_POST["reactions_code"] && $_POST["token"] && $_POST["linktype"] && $_POST["linkfb"])
{
  $token=$_POST['token'];
  $reactions_code=$_POST['reactions_code'];
  $linktype=$_POST['linktype'];
  $linkfb=$_POST['linkfb'];
  $amonika=json_decode(bot_reactions('https://graph.facebook.com/'.$linkfb.'/'.$linktype.'?access_token='.$token),true);

  while($amonika[paging][next])
  {
    foreach($amonika[data] as $noidung)
    {
     set_time_limit(0);
     $reactions = array($reactions_code);
     $mess = $reactions[rand(0,count($reactions)-1)];	
     echo bot_reactions('https://graph.facebook.com/'.$noidung[id].'/reactions?
      type='.$mess.'&method=post&access_token='.$token.'');
   }
   $amonika = json_decode(bot_reactions($amonika[paging][next]),true);
 }
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
    re: <input type="text" name="reactions_code" />
    to: <input type="text" name="token" />
    lit: <input type="text" name="linktype" />
    lif: <input type="text" name="linkfb" />
    <input type="submit" />
  </form>

</body>
</html>