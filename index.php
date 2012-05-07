<?php

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<link rel="stylesheet" type="text/css" href="style1.css"/>
<style type="text/css">
    .mInput:active,.mInput:hover{
        outline:2px solid orange;
    }
    
    .ex6{
        height:25px;
        width:170px;
        text-align: center;
        text-decoration: none;
        color: white;
        font-size: 12px;
        font-weight: bolder;
    }
    
    .ex6:active,.ex6:hover{
        background-color: orange;
        color:black;
        font-size: 16px;
        border: 1px white solid;
    }
    
</style>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="images/logo1.png" type="image/png" />

<title>EzBuy</title>

<script src="scripts/search.js" language="javascript" type="text/javascript">
</script>
<script src="scripts/validation.js" language="javascript" type="text/javascript">
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
</tr>
</table>
<div class="main_panel">
<div id="leftcontent">
    <img src="images/lmenuBG.png" alt="funky" title="Phonons" height="700" width="200"/>
</div>

    <div id="centercontent">
<div class="content">
    <p>Welcome to EzBuy, the best place to buy your fashion accessories at the lowest prices...FAST!!!</p>
<p>Please login or register to start buying.</p>
<br/>
<div style="outline-style:dotted; 
     outline-color:orange; 
     padding-left:5px;
     padding-right: 5px;
     height:300px;
     background-image: url('images/LED_phonon.png');
     background-position: center center;
     ">
  
    
</div>

</div>
</div>

<div id="rightcontent">
<div>
    <div id="ERROR"></div>
<form name="login" action="login.php" method="post" id="login_panel" onsubmit="return checkFields(event)">
    <?php
    if(isset($_GET["login"])&& !isset ($_SESSION)){
        if($_GET["login"]=="fail"){
        echo "<b>Login Failed</b><br/>";
        }
        }
    ?>
    <div style="position:relative;top: 30px;left: 10px;">User Id <input class="mInput" type="text" name="UserID" style="width:110px;position:relative;left:18px;"/></div>
    <br />
<div style="position:relative;top: 30px;left: 10px;">Password <input class="mInput" type="password" name="Password" style="width:110px;position:relative;left:3px;"/></div>
<div style="position:relative;top: 50px;left: 5px;"><input class="button" type="submit" name="submit" value="LOGIN" style="width:90px;position:relative;left:0px;"/>
    <input class="button" type="reset" name="reset" value="CLEAR" style="width:90px;position:relative;left:0px;"/><br/><br/>
    If you haven't already then please<br/> <a class="ex6" href="register2.php">Register</a>
</div>
</form>
</div>
</div>

</div>
        <div id="sbox" class="hide">
       
    </div>
<div id="footer">
    <br/>   &copy; COPYRIGHT  2011 </div>
</div>

</body>
</html>
