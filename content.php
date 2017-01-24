<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery.min.js" type="text/javascript"></script>
<title>Authorization</title>

</head>
<body>

<h1>Current situation in Syria</h1>
<hr>
<div id="main">
<ul id="respond">
<?php
$db=mysqli_connect("localhost","root","","mydb") or die(mysqli_error());
$sql_get="SELECT user_name,text FROM comments";
$result=mysqli_query($db,$sql_get);
if($result){
	while($row = mysqli_fetch_array($result))
{
    $date=date("H:i:s | M.m.Y");
echo '<li id="item_'.$row["id"].'">';
echo '<div class="del_wrapper"><a href="#" class="del" id="del-'.$row["id"].'">';
echo '<img src="http://s1.iconbird.com/ico/0512/C9d/w24h241337874507close.png" border="0" />';
echo '</a></div>';
echo "<div id=pers>";
 echo "<p class='nick'>".$row['user_name'].'</p>';
 echo "<img  src=http://icon-icons.com/icons2/20/PNG/256/businessapplication_accept_ok_male_man_you_negocio_2311.png width=90 height=110 />";
 echo "</div>";
echo "<p id=mess>". $row["text"]."</p>";
echo "<br/>";
echo "<p class='time'>".$date.'</p>';
echo '<div class="like"><a href="#" class="like" id="like-'.$row["id"].'">';
echo '<img src="http://www.pngmart.com/files/3/Facebook-Like-PNG-Transparent-Image.png" border="0" height=30px />';
echo "<p>". $row["like"]."</p>";;
echo '</a></div>';
echo '<div class="dislike"><a href="#" class="dislike" id="dislike-'.$my_id.'">';
echo '<img src="https://habrastorage.org/getpro/geektimes/post_images/d70/b6e/956/d70b6e956d7d0fee8b0624a97b0dfd47.png" border="0" height=30px />';
echo "<span class=disliker></span>";
echo '</a></div>';
echo "<hr>";
echo '</li>';


}
}
mysqli_close($db);
?>

</ul>
</div>
</div>
<button id="add_form">Comment</button>
<p></p>
<div  hidden id="form">
Name: <br />
<input name="name"  id="name" type="text" maxlength="10" /> <br />
Text: <br />
 <p><textarea rows="10" cols="45" name="text" maxlength="300" id="text"></textarea></p>
<input type="button" id="send" value="Add comment">
</form>
</body>

<script>
var i=0;
var d=0;
$("body").on("click", "#respond .like", function(e) {
        e.preventDefault();
        var liked = this.id.split("-"); 
        var LikedID = liked[1]; 
        var LikeData = 'AddLike='+ LikedID;
        $.ajax({
            type: "POST", // HTTP метод  POST или GET
            url: "edit.php", //url-адрес, по которому будет отправлен запрос
            dataType:"text", // Тип данных
            data:LikeData,
            success:function(result){
                i=i+1;
            var liker=$('.liker').val();
            $('.liker').text("+"+i);
            }, //post переменные
            
        });
    });
$("body").on("click", "#respond .dislike", function(e) {
        e.preventDefault();
        var disliked = this.id.split("-"); 
        var disLikedID = disliked[1]; 
        var disLikeData = 'AdddisLike='+ disLikedID;
        $.ajax({
            type: "POST", // HTTP метод  POST или GET
            url: "edit.php", //url-адрес, по которому будет отправлен запрос
            dataType:"text", // Тип данных
            data:disLikeData,
            success:function(result){
                d=d+1;
            var liker=$('.disliker').val();
            $('.disliker').text("+"+d);
            }, //post переменные
            
        });
    });

	$("#add_form").click(function(){
		$("#form").fadeToggle();
	});
	$("#send").click(function(e){
		e.preventDefault();
		$("#form").hide();
		if($("#text").val()==="") 
        {
            alert("Fill the text!");
            return false;
        }if($("#name").val()==="") 
        {
            alert("Fill the name!");
   }
var Data_1 = "text="+ $("#text").val()+"&"+"name="+$("#name").val();
$.ajax({
            type: "POST", 
            url: "edit.php",
            dataType:"text",
            data:Data_1,
            success:function(result){
            $("#respond").append(result);
            $("#text").val(''); 
            $("#name").val('');
            },
            error:function (xhr, ajaxOptions, thrownError){
                alert(thrownError); 
            }
});
});
	$("body").on("click", "#respond .del", function(e) {
        e.preventDefault();
        var clicked = this.id.split("-"); 
        var NumberID = clicked[1]; 
        var Data = 'ToDelete='+ NumberID; 

        $.ajax({
            type: "POST", // HTTP метод  POST или GET
            url: "edit.php", //url-адрес, по которому будет отправлен запрос
            dataType:"text", // Тип данных
            data:Data, //post переменные
            success:function(result){
            // в случае успеха, скрываем, выбранный пользователем для удаления, элемент
            $('#item_'+ NumberID).slideUp('fast');
            },
            error:function (xhr, ajaxOptions, thrownError){
                //выводим ошибку
                alert(thrownError);
            }
        });
    });

		
	
</script>

	
<style>
#fo{
	margin-left:25px;
}
#form{
	height:290px;
	width:400px;
	border-radius: 54px 75px 115px 115px;
-moz-border-radius: 54px 75px 115px 115px;
-webkit-border-radius: 54px 75px 115px 115px;
border: 12px double #59857c;
background: #c0e0c8;


}
body{
	background:#ffffff;
}
h1{
	text-align: center;
}
#main{
    margin-left:30px;
}
.nick{
    color:#1e67cc;
    cursor:pointer;
font-size:24px;
    margin-left:122px;
}
     li {
    list-style-type: none; /* Убираем маркеры */
 }
 #pers img{
    margin-top:-50px;
 }
 .nick:hover{
    text-decoration: underline;
 }
 #mess{
    margin-top:-70px;
    overflow-wrap: break-word;  /* не поддерживает IE, Firefox; является копией word-wrap */ 
  word-wrap: break-word;
  word-break: break-all;  /* не поддерживает Opera12.14, значение keep-all не поддерживается IE, Chrome */ 
  line-break: normal;  /* нет поддержки для русского языка */ 
 -webkit-hyphens: none; -ms-hyphens: none; hyphens: none;  /* значение auto не поддерживается Chrome */ 
    margin-left:122px;
 }
 .time{
   color: #9c9890;
   font-size: 10px;

 }
 .dislike{
    margin-top:-40px;
    margin-left:70px;
 }
</style>
</body>
</html>
