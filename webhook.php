<?php


$hubVerifyToken = 'TOKEN123456abcd';
$accessToken = "EAAEsPnhI9PsBAPaKEmS67h4zmEkrTZB6FZBZAc9RwIxmu62Qk7ZCPRZCZBvVZCZAc11taUEi2a8Tx5C9bapUSZCPylxaGfi76frnE7HJtlZBKqzmBgE7Go4sK0HPDjp8xmSvjAWVa85UMF6JuGlOVszOevipT66SRJf97dxZAdOC8SdMwZDZD";
// check token at setup
if ($_REQUEST['hub_verify_token'] === $hubVerifyToken) {
  echo $_REQUEST['hub_challenge'];
  exit;
}
$input = json_decode(file_get_contents('php://input'), true);
$senderId = $input['entry'][0]['messaging'][0]['sender']['id'];
$messageText = $input['entry'][0]['messaging'][0]['message']['text'];
$response = null;
//set Message
if($messageText == "hi") {
    $answer = "Hello";
}elseif($messageText == "today"){
  $answer = ["attachment"=>[
       "type"=>"template",
       "payload"=>[
         "template_type"=>"list",
         "elements"=>[
           [
              "title"=> "Classic T-Shirt Collection",
                     "image_url"=> "https://www.cloudways.com/blog/wp-content/uploads/Migrating-Your-Symfony-Website-To-Cloudways-Banner.jpg",
                     "subtitle"=> "See all our colors",
                     "default_action"=> [
                         "type"=> "web_url",
                         "url"=> "https://www.cloudways.com/blog/migrate-symfony-from-cpanel-to-cloud-hosting/",                       
                         "webview_height_ratio"=> "tall",
                         // "messenger_extensions"=> true,
                         // "fallback_url"=> "https://peterssendreceiveapp.ngrok.io/"
                     ],
             "buttons"=>[
               [
                 "type"=>"web_url",
                 "url"=>"https://petersfancybrownhats.com",
                 "title"=>"View Website"
               ],
             ]
           ],
             [
             "title"=>"Welcome to Peter\'s Hats",
             "item_url"=>"https://www.cloudways.com/blog/migrate-symfony-from-cpanel-to-cloud-hosting/",
             "image_url"=>"https://www.cloudways.com/blog/wp-content/uploads/Migrating-Your-Symfony-Website-To-Cloudways-Banner.jpg",
             "subtitle"=>"We\'ve got the right hat for everyone.",
             "buttons"=>[
               [
                 "type"=>"web_url",
                 "url"=>"https://petersfancybrownhats.com",
                 "title"=>"View Website"
               ],
             ]
           ],
             [
             "title"=>"Welcome to Peter\'s Hats",
             "item_url"=>"https://www.cloudways.com/blog/migrate-symfony-from-cpanel-to-cloud-hosting/",
             "image_url"=>"https://www.cloudways.com/blog/wp-content/uploads/Migrating-Your-Symfony-Website-To-Cloudways-Banner.jpg",
             "subtitle"=>"We\'ve got the right hat for everyone.",
             "buttons"=>[
               [
                 "type"=>"web_url",
                 "url"=>"https://petersfancybrownhats.com",
                 "title"=>"View Website"
               ],
             ]
           ]
         ]
       ]
     ]];
//send message to facebook bot
$response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => [ 'text' => $answer ]
];
$ch = curl_init('https://graph.facebook.com/v2.6/me/messages?access_token='.$accessToken);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($response));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
if(!empty($input)){
$result = curl_exec($ch);
}
curl_close($ch);
  
}