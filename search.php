<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
require_once('blogic.php');
session_start();
if(!isset($_SESSION["uid"])){
    header("location:index.php");
}
else{
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<link rel="stylesheet" type="text/css" href="style1.css"/>
<link rel="stylesheet" type="text/css" href="home.css"/>
<style type="text/css">
    #page:hover{border: 2px solid orange;}
    #page:active{border: 2px solid orangered;}
    #load:active,#load:hover{background-color: orangered;border: 1px solid white;color: white;}
    #load{
        background-color: orange;
        color: black;
        border:1px black solid;
        font-size: 18px;
        font-family: Arial;
    }
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="images/logo1.png" type="image/png" />

<title>EzBuy</title>

<script src="scripts/search.js" language="javascript" type="text/javascript">
</script>
<script src="scripts/hAJAX.js" language="javascript" type="text/javascript">
</script>



</head>

<body>
<div style="position: absolute;left: 30px;right: 30px;top: 20px;">
<table class="header1" cellpadding="0" cellspacing="0" style="position:relative;">
<tr>
<td><img src="images/logo1.png"  width="150" height="150" alt="EzBuy"/></td>
<td ><img src="images/header2.gif" alt="EzBuy"/></td>
</tr>
</table>

<table class="menu" cellpadding="0" cellspacing="0">
<tr class="links">
<td class="links_int"><a class="ex5" href="home.php">Home</a></td>
<td class="links_int"><a class="ex5" href="about_us.php">About Us</a></td>
<td class="links_int"><a class="ex5" href="buy_now.php">Buy Now</a></td>
<td class="links_int"><a class="ex5" href="contact.php">Contact Us</a></td>
<td class="links_int"><a href="#" class ="ex5" onclick="show_search()">Search Item</a></td>
</tr>
</table>
<div class="main_panel">
    <div id="leftcontent">
        <hr/><h2 style="background-color: white;"><center>Categories</center></h2><hr/>
<ul class="lMenu">
    <li><a class="links_left" href="category.php">Shoes</a></li>
    <li><a class="links_left" href="category.php">Trousers and Jeans</a></li>
    <li><a class="links_left" href="category.php">Eyewear</a></li>
    <li><a class="links_left" href="category.php">Footwear</a></li>
    <li><a class="links_left" href="category.php">Hats and Caps</a></li>
    <li><a class="links_left" href="category.php">&nbsp;</a></li>
    <li><a class="links_left" href="category.php">&nbsp;</a></li>
    <li><a class="links_left" href="category.php">&nbsp;</a></li>
    <li><a class="links_left" href="category.php">&nbsp;</a></li>
</ul></div>

<div id="centercontent">
<div class="content">
    <center><h2>Browse Items</h2><hr/></center>
<p>Please use the navigation controls below to browse our database</p>
    <select name="page" id="page">
        <?php
            $keywords=$_POST['q'];
            $range=get_view_range($vName);
           for($i=1;$i<=$range;$i++){
               echo "<option value='$i'>Page ".$i."</option>";
           }
        ?>
          </select>
</div>
</div>

<div id="rightcontent">
<div>
<form action="login.php" method="post" id="login_panel">
<div style="position:relative;top: 30px;left: 10px;">
    Hi <b><?php
           $user=new user($_SESSION['uid'],$_SESSION['pwd']);
           echo $user->getName()."<br/>";
           
    ?></b>
    or <a href="logout.php">LOGOUT</a>
</div>
</form>
</div>
</div>
    <div id="sbox" class="hide">
        search box
        <input type="text" onclick="clearbox()"  value="enter search text"/>
        <button onclick="search()">Search</button>
    </div>
</div>
    <div id="footer"><br/>   &copy; COPYRIGHT 2011 </div>
</div>

</body>
</html>
<?php
}
?>

