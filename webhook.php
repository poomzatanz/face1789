<?php

$access_token = "EAAEsPnhI9PsBAPaKEmS67h4zmEkrTZB6FZBZAc9RwIxmu62Qk7ZCPRZCZBvVZCZAc11taUEi2a8Tx5C9bapUSZCPylxaGfi76frnE7HJtlZBKqzmBgE7Go4sK0HPDjp8xmSvjAWVa85UMF6JuGlOVszOevipT66SRJf97dxZAdOC8SdMwZDZD";
$verify_token = "TOKEN123456abcd";
$hub_verify_token = null;

if(isset($_REQUEST['hub_challenge'])) {
 $challenge = $_REQUEST['hub_challenge'];
 $hub_verify_token = $_REQUEST['hub_verify_token'];
}
if ($hub_verify_token === $verify_token) {
 echo $challenge;
}

// handle bot's anwser
$input = json_decode(file_get_contents('php://input'), true);
$senderId = $input['entry'][0]['messaging'][0]['sender']['id'];
$messageText = $input['entry'][0]['messaging'][0]['message']['text'];

if($messageText == "hi") {
    $answer = "Hello";
    $response = [
      'recipient' => [ 'id' => $senderId ],
      'message' => [ 'text' => $answer ]
  ];
  pushMsg($response,$access_token);
}else{
  $answer = "I don't understand. Ask me 'hi'.";
  $response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => [ 'text' => $answer ]
];
pushMsg($response,$access_token);
}

function pushMsg($response,$accessToken){
$ch = curl_init('https://graph.facebook.com/v3.3/me/messages?access_token='.$accessToken);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($response));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_exec($ch);
curl_close($ch);
}
exit;