<?php
require "vendor/autoload.php";
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');
$strAccessToken = "9dBMbNELf4MfazUdpjf7Ut4tMHFJANUDNXGMvO/c4FQTp1m+c387phVRsKDcptKLYavvrpVcX1392F86W484NNwZf8iptnpLuuCSsztf8qdkVnLUHyHG+Onam1PfTX7NieDHHVXSJWse35NIaqfQMgdB04t89/1O/w1cDnyilFU=";
 
$strUrl = "https://api.line.me/v2/bot/message/push";

$host="db4free.net";
$user="poomzatan123456";
$password="0811582889zX";
$connect=mysqli_connect($host,$user,$password,"testdb1234567");
mysqli_set_charset($connect,"UTF8");
if($connect)
{
    $n=$_POST['name'];
    $l=$_POST['last'];
    
    $sqltext1 = "SELECT * FROM `Learn` WHERE input = '".$n."'";
		$qury1 = mysqli_query($connect,$sqltext1);
        $result=mysqli_fetch_array($qury1,MYSQLI_ASSOC);
  
    if(!$result){
        $sqltext = "INSERT INTO `Learn` (`id_learn`, `input`, `out`) VALUES (NULL, '$n', '$l');";
    $qury = mysqli_query($connect,$sqltext);
    
	if($qury){
       
        echo "<h1>ขอบคุณสำหรับการสอนนะครับ...</h1>";
        exit;
	}
    }else {
        $sqltext1 = "SELECT * FROM `idLine` ORDER BY `id` DESC LIMIT 1";
		$qury1 = mysqli_query($connect,$sqltext1);
        $result1=mysqli_fetch_array($qury1,MYSQLI_ASSOC);

        $arrHeader = array();
        $arrHeader[] = "Content-Type: application/json";
        $arrHeader[] = "Authorization: Bearer {$strAccessToken}";
        

        $arrPostData = array();
        $arrPostData['to'] = $result1['idLine'];
        $arrPostData['messages'][0]['type'] = "text";
        $arrPostData['messages'][0]['text'] = "ขอโทษครับมีข้อมูลแล้วครับ";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$strUrl);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrPostData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close ($ch);
        
        echo "<h1>ขอบคุณสำหรับการสอนนะครับ...</h1>";
        exit;
    }
    	

}

?>