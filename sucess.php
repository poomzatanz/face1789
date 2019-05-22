
<?php 
 curl -X POST -H "Content-Type: application/json" -d '{
     "recipient":{
       "id":"2396068373784859"
     },
     "message":{
       "attachment":{
         "type":"template",
         "payload":{
           "template_type":"button",
           "text":"What do you want to do next?",
           "buttons":[
             {
               "type":"web_url",
               "url":"https://www.anime-sugoi.com",
               "title":"Visit Messenger"
             }
           ]
         }
       }
     }
   }' "https://graph.facebook.com/v2.6/me/messages?access_token=EAAEsPnhI9PsBAPaKEmS67h4zmEkrTZB6FZBZAc9RwIxmu62Qk7ZCPRZCZBvVZCZAc11taUEi2a8Tx5C9bapUSZCPylxaGfi76frnE7HJtlZBKqzmBgE7Go4sK0HPDjp8xmSvjAWVa85UMF6JuGlOVszOevipT66SRJf97dxZAdOC8SdMwZDZD"
  
?>
