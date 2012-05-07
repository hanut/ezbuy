<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<link rel="stylesheet" type="text/css" href="style1.css"/>
<link rel="stylesheet" type="text/css" href="funStuff.css"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="images/logo1.png" type="image/png" />

<title>EzBuy</title>
<script src="scripts/search.js" language="javascript" type="text/javascript">
</script>

</head>

<body>

    
<div style="position: absolute;left: 30px;right: 30px;top: 20px;">
<table class="header1" cellpadding="0" cellspacing="0" style="position:relative;">
<tr>
<td><img src="images/logo1.png"  width="150" height="150"/></td>
<td ><img src="images/header2.gif"/></td>
</tr>
</table>

<table class="menu" cellpadding="0" cellspacing="0">
<tr class="links">
<td class="links_int"><a class="ex5" href="home.php">Home</a></td>
<td class="links_int"><a class="ex5" href="about_us.php">About Us</a></td>
<td class="links_int"><a class="ex5" href="buy_now.php">Buy Now</a></td>
<td class="links_int"><a class="ex5" href="contact.php">Contact Us</a></td>
<?php
if(isset($_SESSION['uid'])){
?>
<td class="links_int"><a href="#" class ="ex5" onclick="show_search()">Search Item</a></td>
<?php
}
?>

</tr>
</table>
<div class="main_panel">
<div id="leftcontent">
<img src="images/lmenuBG.png" alt="funky" title="Phonons" height="700" width="200"/>
</div>

    <div id="centercontent">
<div class="content">
    <p>EzBuy is an online shopping portal dedicated to providing its customers with and easy to use and intuitive way
    to purchase the latest in fashion accessories. The catch-phrase however is FAST. Using the speed and versatility of 
    PHP/MySQL we deliver the best in the market to our customers at lightning speed.</p>
    <p>Our database is constantly updated and both buyers as well as sellers can sign-up for our services
    with dedicated features for both kinds of users.</p>
    <p>
       Visitors to the site are encouraged to send us their feed-back about the layout and features of the web portal.
       After all, our main goal is to make sure <b>YOU</b> enjoy our services!
    </p>
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
<br/>

</div>
</div>

<div id="rightcontent">
<div>
<div style="position:relative;top: 30px;left: 10px;">

    <?php
    session_start();
    if(!isset ($_SESSION["uid"])){
        echo "<br/><br/>";
        echo "<a href='index.php'><font color='#FFFFFF' size='+1' >Click to Login</font></a><br/>";
        }
     else{
    echo "<br/><br/><br/>";
    echo "<a href='logout.php' class='ex5' style='width: 180px;height:30px;padding-top:9px;'>LOGOUT</a><br/>";
    ?>
    
    <?php }   
    ?>

</div>
</div>
</div>

</div>
<div id="footer">
    <br/>   &copy; COPYRIGHT  2011 </div>
</div>

    <div id="sbox" class="hide">
        search box
        <input type="text" onclick="clearbox()"  value="enter search text"/>
        <button onclick="search()">Search</button>
    </div>
    
</body>
</html>
