<?php


$hubVerifyToken = 'TOKEN123456abcd';
$accessToken = "EAAEsPnhI9PsBAPaKEmS67h4zmEkrTZB6FZBZAc9RwIxmu62Qk7ZCPRZCZBvVZCZAc11taUEi2a8Tx5C9bapUSZCPylxaGfi76frnE7HJtlZBKqzmBgE7Go4sK0HPDjp8xmSvjAWVa85UMF6JuGlOVszOevipT66SRJf97dxZAdOC8SdMwZDZD";
// check token at setup
if ($_REQUEST['hub_verify_token'] === $hubVerifyToken) {
  echo $_REQUEST['hub_challenge'];
  exit;
}
$host="db4free.net";
$user="poomzatan123456";
$password="0811582889zX";
$connect=mysqli_connect($host,$user,$password,"testdb1234567");
mysqli_set_charset($connect,"UTF8");
if($connect)
{
$input = json_decode(file_get_contents('php://input'), true);
$senderId = $input['entry'][0]['messaging'][0]['sender']['id'];
$messageText = $input['entry'][0]['messaging'][0]['message']['text'];

$sqltext = "INSERT INTO `idFace` (`id`, `idface`) VALUES (NULL, '$senderId');";
	$qury = mysqli_query($connect,$sqltext);
	if($qury){
               echo"<h1>ชื่อของคุณได้เก็บเข้าระบบแล้วครับ</h1>";
               echo "<script type='text/javascript'>window.close();</script>";
  }	
  
  $sqltext1 = "SELECT * FROM `Learn` WHERE input = '".$messageText."'";
  $qury1 = mysqli_query($connect,$sqltext1);
    $result=mysqli_fetch_array($qury1,MYSQLI_ASSOC);

if($messageText == "hello") {
    $answer = "Hello ".$senderId." ";
}
elseif ($result) {
    $answer = $result['out'];
}elseif($answer=='test'){
  $answer = [
    'attachment' => [
      'type' => 'template',
      'payload'=> [
        'template_type' => 'button',
        'text' => 'test',
        'buttons' =>  [
            'type' => 'web_url',
            'url' => 'https://www.anime-sugoi.com',
            'title' => 'test'
          ]
        
      ]
    ]
  ];
}
}
else{
  $answer = 'test';
$response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => [ 'text' => $answer ]
];
$ch = curl_init('https://graph.facebook.com/v3.3/me/messages?access_token='.$accessToken);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($response));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_exec($ch);
curl_close($ch);
mysqli_close($connect);
exit;
}