<?php
require_once('blogic.php');
session_start();
if(!isset($_SESSION["uid"])){
    header("location:index.php");
}
else{
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<link rel="stylesheet" type="text/css" href="style1.css"/>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="images/logo1.png" type="image/png" />

<title>EzBuy</title>

<script src="scripts/search.js" language="javascript" type="text/javascript">
</script>
<script src="scripts/validation.js" language="javascript" type="text/javascript">
</script>
<script type="text/javascript">
    
    function delete_nosave(){
        var x=window.location;
        x+="?q=nosave";
        window.location=x;
    }
    
    function delete_save(){
        var x=window.location;
        x+="?q=save";
        window.location=x;
    }
    
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
    <img src="images/lmenuBG.png" alt="funky" title="Phonons" height="700" width="200"/>
</div>

    <div id="centercontent">
<div class="content">
    <?php
        if(isset($_GET['q'])){
            $method=$_GET['q'];
            if($method=='nosave'){
                echo "Deleted(Completely)";
            }
            if($method=='save'){
                $valid=user::delete($_SESSION["uid"]);
                if(!$valid){
                    die();
                }
                else{
                    echo "Your account has been successfully deleted.";
                    header("location:logout.php");
                }
            }
    ?>
    <?php    
        }
        else{
        ?>
    <p>Are you sure you want to delete your account ?</p>
    <p>All items you have added will be deleted and cannot be recovered.</p>
    <button onclick="delete_nosave()" disabled="disabled">Delete</button>
    <button onclick="delete_save()">Delete but save items</button>
    <?php
        }
    ?>
</div>
</div>

<div id="rightcontent">
    <div style="margin-top: 40px;">
        <img src="images/right_ad.gif" alt="right ad" title="EzBuy"></img>
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

<?php
}
?>