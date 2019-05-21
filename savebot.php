<?php
 $accessToken = "EAAEsPnhI9PsBAPaKEmS67h4zmEkrTZB6FZBZAc9RwIxmu62Qk7ZCPRZCZBvVZCZAc11taUEi2a8Tx5C9bapUSZCPylxaGfi76frnE7HJtlZBKqzmBgE7Go4sK0HPDjp8xmSvjAWVa85UMF6JuGlOVszOevipT66SRJf97dxZAdOC8SdMwZDZD";
 if ($_REQUEST['hub_verify_token'] === $hubVerifyToken) {
     echo $_REQUEST['hub_challenge'];
     exit;
   }
 $input = json_decode(file_get_contents('php://input'), true); 
 $answer = "test";
 $senderId = "2396068373784859";
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


?>