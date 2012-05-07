<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
require_once('blogic.php');
session_start();
if(!isset($_SESSION["uid"])){
    header("location:index.php");
}
else{
    echo "<input type='hidden' id='uid' value='".$_SESSION["uid"]."'/>";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<link rel="stylesheet" type="text/css" href="style1.css"/>
<link rel="stylesheet" type="text/css" href="home.css"/>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="images/logo1.png" type="image/png" />

<title>EzBuy</title>

<script src="scripts/search.js" language="javascript" type="text/javascript">
</script>

<script src="scripts/gui.js" language="javascript" type="text/javascript">
</script>

<script src="scripts/imageView.js" language="javascript" type="text/javascript">
</script>
<script type="text/javascript">
    function userDelete(){
        window.location="delete.php";
    }
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
<td class="links_int"><a class ="ex5" onclick="show_search()">Search Item</a></td>
</tr>
</table>
<div class="main_panel">
<div id="leftcontent">
    <hr/><h2 style="background-color: white;"><center>Categories</center></h2><hr/>
<ul id="lMenu" class="lMenu">
    `<script>
        loadLeftMenu();
    </script>
</ul>
</div>

<div id="centercontent">
<div class="content">
    <p>Welcome back to EzBuy.com <b style="font-size: 17px;"><?php echo strtoupper($_SESSION['uid']); ?></b>. You can check out the 6 latest additions to our stock below or browse around on the
<a class="ex5" href="buy_now.php" style="color:orangered;background-image: none;display: inline;outline:0px;">
    Buy Now</a> page.
</p>
    <p>
        You can also use the menu on the left to browse the items by category.
        Yet another way is to simply search for an item using the navigation bar at the top right.
    </p>
<br/>
<?php
$p= <<<EOD
    <div align='center'><table class='table2' border=0 cellpadding=0 cellspacing=0>
        <thead class='thead2'><tr>
        <th class='th2'>Item Code</th>
        <th class='th2'>Item Name</th>
        <th class='th2'>Description</th>
        <th class='th2'>Cost</th>
        <th class='th2'>Stock</th>
        <th class='th2'>Seller</th>
        <th class='th2' style='border-right:none;'></th>
        </tr></thead>
        <tbody>
EOD;
echo $p;
$last=get_last_ic();
$i=6;
while($i>0 && $last!=0){
    $item=new item($last);
    $holder=$item->getStats();
    if($holder['name']=='fail'){
        $last--;
        unset ($item);
        continue;
    }
    echo "<div align=center>";
    $path=$item->getPicPath();
    echo "<tr><td class='td2'>".$holder['itemCode']."</td>";
    echo "<td class='td2'><a class='itemLink' href='sCart.php?action=add&itemCode=$last'>".$holder['name']."</a></td>";
    echo "<td class='td2'>".$holder['desc']."</td>";
    echo "<td class='td2'>Rs. ".$holder['cost']."</td>";
    echo "<td class='td2'>".$holder['stock']."</td>";
    echo "<td class='td2'>".$holder['sellerID']."</td>";
    echo "<td class='td2'>"."<img src=".$path." alt=kinky height='80' width='80'/></td></tr>";
    unset ($item);
    $last--;
    $i--;
}
    echo "</tbody>";
    echo "</table></div>";
?>
</div>
</div>

<div id="rightcontent">
<div>

<div style="position:relative;top: 30px;left: 10px;">
    Hi <b><?php
           $user=new user($_SESSION['uid'],$_SESSION['pwd']);
           echo $user->getName()."<br/>";
           
    echo "</b>";
    echo "<br/><br/>";
    echo "<a class='ex5' href='logout.php' style='width: 180px;height:30px;padding-top:9px;'>LOGOUT</a><br/>";
    echo "<a class='ex5' href='#' style='width: 180px;height:30px;padding-top:9px;' onclick='personalize()'>Personalize</a><br/>";
    echo "<a class='ex5' href='#' style='width: 180px;height:30px;padding-top:9px;' onclick='showItemPane()'>Add Item</a><br/>";
    echo "<a class='ex5' href='#' style='width: 180px;height:30px;padding-top:9px;' onclick='showItemPane2()'>Delete Item</a><br/>";
    ?></b>
</div>
<!--</form>-->
</div>
    <div class="sCart" id="sCart">
        <center><a href="sCart.php?action=view">
        <img src="images/sCart.png" height="60" width="100" alt=""></img></a>
         <br/>
        <a class="ex5" href="sCart.php?action=view" style="font-family: Arial;">
        Shopping Cart
        </a></center>
        </div>
</div>
    <div id="sbox" class="hide"></div>

     <div id="pbox" class="hide"></div>
    
   
    
    <div id="imageView" class="hide">
        <button class="close1" onclick="hide_imageView(event)">Close</button>
    </div>
   
</div>
    <div id="itemPane" class="hide" style="font-family: Arial;"></div>
    <div id="footer"><br/>   &copy; COPYRIGHT 2011 </div>
</div>
        
</body>
</html>
<?php
}
?>