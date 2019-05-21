<html>
<body>
<script>
  var timeleft = 5;
  var downloadTimer = setInterval(function(){
    document.getElementById('progressBar').value = 5 - timeleft;
    timeleft -= 1;
    if(timeleft <= 0){
     window.location='upgradebot.php';
    }else{ 
          
  }, 1000);
  </script>
<h1>ขอโทษนะครับ ซ้ำครับ</h1>
</body>
</html>