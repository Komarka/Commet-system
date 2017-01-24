<?php
ini_set('display_errors', 1); 
error_reporting(E_ALL);
$db=mysqli_connect("localhost","root","","mydb") or die(mysqli_error());

 
if(isset($_POST["text"]) && strlen($_POST["text"])>0)
{
if(isset($_POST["name"]) && strlen($_POST["name"])>0)
{

 

    $contentToSave = filter_var($_POST["text"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$contentToSave=(string)$contentToSave;
 $contentToSave_2 = filter_var($_POST["name"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$contentToSave_2=(string)$contentToSave_2;
  
  $sql="INSERT INTO comments(user_name,text)VALUES('$contentToSave_2','$contentToSave')";
  $result=mysqli_query($db,$sql);
  
    if($result)
    {
        $my_id = mysqli_insert_id($db); 
        $date=date("H:i:s | M.m.Y");
        echo '<li id="item_'.$my_id.'">';
        echo '<div class="del_wrapper"><a href="#" class="del" id="del-'.$my_id.'">';
        echo'<img src="http://s1.iconbird.com/ico/0512/C9d/w24h241337874507close.png"border="0" />';
        echo '</a></div>';
        echo "<div id=pers>";

          echo "<p class='nick'>".$contentToSave_2.'</p>';
           echo "<img src=http://icon-icons.com/icons2/20/PNG/256/businessapplication_accept_ok_male_man_you_negocio_2311.png width=90 height=110/>";
            echo "</div>";
        echo "<p id=mess>".$contentToSave."</p>";
     echo "<br/>";
     echo "<p class='time'>".$date.'</p>';
     echo '<div class="like"><a href="#" class="like" id="like-'.$my_id.'">';
echo '<img src="http://www.pngmart.com/files/3/Facebook-Like-PNG-Transparent-Image.png" border="0" height=30px />';
echo "<span class=liker></span>";
echo '</a></div>';
  echo '<div class="dislike"><a href="#" class="dislike" id="dislike-'.$my_id.'">';
echo '<img src="https://habrastorage.org/getpro/geektimes/post_images/d70/b6e/956/d70b6e956d7d0fee8b0624a97b0dfd47.png" border="0" height=30px />';
echo "<span class=disliker></span>";
echo '</a></div>';
       echo "<hr>";
       echo '</li>';
       



        mysqli_close($db);


    }else{
       
        header('HTTP/1.1 500 Looks like mysql error, could not insert record!');
        exit();
    }

}
}

elseif(isset($_POST["ToDelete"]) && strlen($_POST["ToDelete"])>0 && is_numeric($_POST["ToDelete"]))
{



    $idToDelete = filter_var($_POST["ToDelete"],FILTER_SANITIZE_NUMBER_INT);

    $sql_delete="DELETE FROM comments WHERE id='$idToDelete'";
    $result_2=mysqli_query($db,$sql_delete);
    if(!$result_2)
    {
       
        header('HTTP/1.1 500 Could not delete record!');
        exit();
    }
    

}
elseif(isset($_POST["AddLike"]) && strlen($_POST["AddLike"])>0 && is_numeric($_POST["AddLike"]))
{
    $idToLike = filter_var($_POST["AddLike"],FILTER_SANITIZE_NUMBER_INT);
    $sql_update="UPDATE `comments` SET `like` = `like` + 1 WHERE id='$idToLike'";
    $result_3=mysqli_query($db,$sql_update);
 if(!$result_3)
    {
       
        header('HTTP/1.1 500 Could not add record!');
        exit();
    }
}
elseif(isset($_POST["AdddisLike"]) && strlen($_POST["AdddisLike"])>0 && is_numeric($_POST["AdddisLike"]))
{
    $idTodisLike = filter_var($_POST["AdddisLike"],FILTER_SANITIZE_NUMBER_INT);
    $sql_update_2="UPDATE `comments` SET `dislike` = `dislike` + 1 WHERE id='$idTodisLike'";
    $result_4=mysqli_query($db,$sql_update_2);
 if(!$result_4)
    {
       
        header('HTTP/1.1 500 Could not add record!');
        exit();
    }
}
else{

    //Output error
    header('HTTP/1.1 500 Error occurred, Could not process request!');
    exit();
}

  ?>
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
 .liker{
  color:green;
 }
 a{
  text-decoration: none;
 }
 .dislike{
    margin-top:0px;
    margin-left:70px;
 }
.like{
  margin-top:20px;
}
.disliker{
  color:red;
}
  </style>








  
