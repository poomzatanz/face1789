<html>
<body>
<h1>ขอโทษนะครับ ซ้ำครับ</h1>
<?php 
echo"<script>
var timeleft = 5;
var downloadTimer = setInterval(function(){
  document.getElementById('progressBar').value = 5 - timeleft;
  timeleft -= 1;
  if(timeleft <= 0){
   window.location='username.php';
  }else{ 
        
}, 1000);
</script>
<progress value='0' max='5' id='progressBar'></progress>
";

?>
</body>
</html>