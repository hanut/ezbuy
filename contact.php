<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<link rel="stylesheet" type="text/css" href="style1.css"/>

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
    <p>At EzBuy we care about our customers and care about your feedback</p><br/>
    For any and all queries please feel free to reach us at:
    <br/>
    <div style="font-size: 12px;">
        email:queries@ezbuy.com<br/>
        <u>Address</u><br/>
        Tech Towers<br/>
        First Floor<br/>
        Nodia<br/>
        <u>Phone Numbers:</u><br/>
        9811033638<br/>
        7883304425<br/>
    </div>
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
     }   
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
