<?php
// parameters
$hubVerifyToken = 'token1235Tsd';
$accessToken = "EAAPDFjlEvZAEBAEVcG1TuUUZCe7sZBHSG2LKx8ZCUB6qix3dCYwRPkP2qzwtj8EXmU811lEgHVedt8Iq74riTZCmhgOCcU4uTm9EGIPoZCKt1zc4F7sswvOUYl8mdiZCU5BBCzsFaVH6ymoCtaupQUugEyjGidZC9FmWBs7hAYMbjAZDZD";
// check token at setup
if ($_REQUEST['hub_verify_token'] === $hubVerifyToken) {
  echo $_REQUEST['hub_challenge'];
  exit;
}
// handle bot's anwser
$input = json_decode(file_get_contents('php://input'), true);
$senderId = $input['entry'][0]['messaging'][0]['sender']['id'];
$messageText = $input['entry'][0]['messaging'][0]['message']['text'];
$answer = "I don't understand. Ask me 'hi'.";
if($messageText == "hi") {
    $answer = "Hello";
}
$response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => [ 'text' => $answer ]
];
$ch = curl_init('https://graph.facebook.com/v2.6/me/messages?access_token='.$accessToken);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($response));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_exec($ch);
curl_close($ch);
?>