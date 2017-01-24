<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<title>Authorization</title>

</head>
<body>
<div  hidden id="topics">
<h1>Topics for discussion</h1>
<hr>
<ul>
<li><a href="content.php" >Current situation in Syria</a></li>
<li><a href="#">Can you imagine your future in Ukraine?</a></li>
<li><a href="#">Global warming is not far</a></li>
</ul>
</div>
</body>
</html>
<style>
body{
  background:#eff7cd;
}
#topics{
  position:absolute;
  top:0px;
  left:300px;
  width:500px;
  height:300px;
  font-size: 20px;
border-radius: 79px 65px 35px 27px;
-moz-border-radius: 79px 65px 35px 27px;
-webkit-border-radius: 79px 65px 35px 27px;
border: 16px inset #8f9965;
background-color: #d6b475;
}
a{
  text-decoration: none;

}
a:hover{
  color:red;
}
h1{
  text-align: center;
}
</style>
<script>
  $(document).ready(function(){
$("#topics").slideDown('2000');
})
  $("#reg").click(function(){
    $("#regist").fadeToggle();
  })
</script>

