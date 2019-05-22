<?php


$hubVerifyToken = 'TOKEN123456abcd';
$accessToken = "EAAEsPnhI9PsBAPaKEmS67h4zmEkrTZB6FZBZAc9RwIxmu62Qk7ZCPRZCZBvVZCZAc11taUEi2a8Tx5C9bapUSZCPylxaGfi76frnE7HJtlZBKqzmBgE7Go4sK0HPDjp8xmSvjAWVa85UMF6JuGlOVszOevipT66SRJf97dxZAdOC8SdMwZDZD";
// check token at setup
if ($_REQUEST['hub_verify_token'] === $hubVerifyToken) {
  echo $_REQUEST['hub_challenge'];
  exit;
}
$input = json_decode(file_get_contents('php://input'), true);
$page_id = $input['entry'][0]['id'];
$sender = $input['entry'][0]['messaging'][0]['sender']['id'];
$message = isset($input['entry'][0]['messaging'][0]['message']['text']) ? $input['entry'][0]['messaging'][0]['message']['text']: '' ;
$postback = isset($input['entry'][0]['messaging'][0]['postback']['payload']) ? $input['entry'][0]['messaging'][0]['postback']['payload']: '' ;
if($message || $postback) { 
  
  
  if($message) {
       // If Page receives Message, process the Message and prepare content to reply
       $reply = 'Message received: ' . $message;
  }
  else {
    
    // If Page receives Postback, process the Postback and prepare content to reply
      
    switch($postback) {
    
      case 'DEVELOPER_DEFINED_PAYLOAD_FOR_HELP':
        $reply = 'You clicked Help button';
        break;
        
      case 'DEVELOPER_DEFINED_PAYLOAD_FOR_LATEST_POSTS':
        $reply = 'You clicked Latest Post button';
        break;
    
    
    }
  
  }
  
  
   $responseJSON = '{
    "recipient":{
      "id":"'.$sender.'"
    },
    "message": {
            "text":"'. $reply .'"
        }
  }';
  $access_token = 'your_page_access_token';
  
  //Graph API URL
  $url = 'https://graph.facebook.com/v2.7/me/messages?access_token='.$accessToken;
  // Using cURL to send a JSON POST data
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $responseJSON);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  $result = curl_exec($ch);
  curl_close($ch);
  
}