<?php
$host="db4free.net";
$user="poomzatan123456";
$password="0811582889zX";
$connect=mysqli_connect($host,$user,$password,"testdb1234567");
mysqli_set_charset($connect,"UTF8");
if($connect)
{

$hubVerifyToken = 'TOKEN123456abcd';
$accessToken = "EAAEsPnhI9PsBAPaKEmS67h4zmEkrTZB6FZBZAc9RwIxmu62Qk7ZCPRZCZBvVZCZAc11taUEi2a8Tx5C9bapUSZCPylxaGfi76frnE7HJtlZBKqzmBgE7Go4sK0HPDjp8xmSvjAWVa85UMF6JuGlOVszOevipT66SRJf97dxZAdOC8SdMwZDZD";
// check token at setup
if ($_REQUEST['hub_verify_token'] === $hubVerifyToken) {
  
  exit;
}
 $n=$_POST['name'];
 $l=$_POST['last'];
$input = json_decode(file_get_contents('php://input'), true);
        $sqltext1 = "SELECT * FROM `Learn` WHERE input = '".$n."'";
		$qury1 = mysqli_query($connect,$sqltext1);
        $result=mysqli_fetch_array($qury1,MYSQLI_ASSOC);

        $sqltext1 = "SELECT * FROM `idFace` ORDER BY `id` DESC LIMIT 1";
		$qury1 = mysqli_query($connect,$sqltext1);
        $result1=mysqli_fetch_array($qury1,MYSQLI_ASSOC);
    $id = $result1['idface'];
    if(!$result){
        $sqltext = "INSERT INTO `Learn` (`id_learn`, `input`, `out`) VALUES (NULL, '$n', '$l');";
    $qury = mysqli_query($connect,$sqltext);
    
	if($qury){
        $message = "ขอบคุณที่สอนครับ";
	}
    }else {
        $message = "ขอโทษครับนี้สอนไปแล้วครับ";
    }
    	
$response = [
    'recipient' => [ 'id' => $id ],
    'message' => [ 'text' => $message ]
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