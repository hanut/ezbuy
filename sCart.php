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
    .zEl{
        border-bottom: 1px solid orangered;
        background-color: white;
        color:black;
        font-size: 15px;
        font-weight: bold;
    }
    
    .Czz8h{
        color: darkslateblue;
        text-decoration: none;
    }
    
    .Czz8h:active,.Czz8h:hover{
        color: red;
        text-decoration: underline;
    }
    
    #mxcchj{
        text-decoration: none;
        font-size: 14px;
        color:white;
    }
    
    #mxcchj:active,#mxcchj:hover{
        text-decoration: underline;
        color: #F3E3E3;
    }
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="images/logo1.png" type="image/png" />

<title>EzBuy</title>

<script src="scripts/search.js" language="javascript" type="text/javascript">
</script>
<script src="scripts/hAJAX.js" language="javascript" type="text/javascript">
</script>
<script src="scripts/gui.js" language="javascript" type="text/javascript"></script>


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
        <hr/><center><h2 style="background-color: white;">Categories</h2></center><hr/>
<ul id="lMenu" class="lMenu">
    `<script>
        loadLeftMenu();
    </script>
</ul></div>

<div id="centercontent">
<div class="content">
    <center><h2>Shopping Cart</h2><hr/></center>
<br/>
        <?php
            if(!isset($_GET['action'])){
                header("location:home.php");
            }
            $action=$_GET['action'];
            switch($action){
                
            case 'view' :{
            if(!isset($_SESSION['sCart'])){
                echo "Nothing in your cart";
            }
            else{    
                echo "<center><div id='iGrid'>";
                $ic=0;
                echo "<table style='color:black;border:2px solid orange;background-color:white;font-size:18px;' cellpadding='0' cellspacing='0'><thead>";
                echo "<tr style='background-image:url(images/theader.png);color:white;'>
                      <th style='width: 105px;height:30px;border:1px orange solid;'><center>ITEM CODE</center></td>
                      <th style='height:30px;width:180px;border:1px orange solid;'><center>ITEM NAME</center></td>
                      <th style='height:30px;width:180px;border:1px orange solid;'><center>COST</center></td>
                      <th style='height:30px;border:1px orange solid;'></td>
                      <th style='height:30px;border:1px orange solid;'></td></tr>";
                $total=0;
                while($ic<count($_SESSION['sCart'])){
                    $itemCode=$_SESSION['sCart'][$ic];
                    $item=new item($itemCode);
                    echo "<tr style='font-size:14px;'>";
                    echo "<td style='border:1px orange solid;'><center>$itemCode</center></td>";
                    echo "<td style='border:1px orange solid;'><center><a class='itemLink' href='sCart.php?action=add&itemCode=$itemCode'>".$item->getName()."</a></center></td>";
                    echo "<td style='border:1px orange solid;'><center>".$item->getCost()."</center></td>";
                    echo "<td style='border:1px orange solid;'><center><img src='".$item->getImgPath()."' alt='' height=40 width=40></center></td>";
                    echo "<td style='border:1px orange solid;'><center><a class='Czz8h' href='sCart.php?action=delete&itemCode=".$ic."'>Remove</a></center></td>";
                    echo "</tr>";
                    $total+=$item->getCost();
                    $ic++;
                }
                echo "<tr><td>&nbsp;</td><td></td><td></td><td></td><td></td></tr><tr>";
                echo "<td></td><td><center>Total&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</center></td><td><center>".$total."</center></td><td></td></tr>";
                echo "</tbody></table></div></center>";
                echo "</br></br>";
                echo "<a id='mxcchj' href='sCart.php?action=checkout'><center>Checkout</center></a>";
                }   
                break;
            }
            
            case 'add'  :{
                $ic=$_GET['itemCode'];
                $item=new item($ic);
                $itemName=$item->getName();
                $itemCost=$item->getCost();
                $itemSID=$item->getSellerID();
                $itemStock=$item->getStock();
                $itemImg=$item->getImgPath();
                unset($item);
                
                $p=<<<EOD
                 <center><div id='itemToAdd' style='width:300px;'>
                   <img src='$itemImg' 
                    alt='$itemName' height=300 width=300></img>
                    <p style='clear:both;float:none;font-weight:bolder;font-size:18px;'>Details</p>
                    <div class='zEl'>Item Code:   $ic</div>
                    <div class='zEl'>Name:    $itemName</div>
                    <div class='zEl'>Cost:    $itemCost</div>
                    <div class='zEl'>Stock:    $itemStock</div>
                    <div class='zEl'>Seller:    $itemSID</div>
                    <br/>
                    <button name='addItemToCart' title='Add Item To Cart'
                    onclick='addToCart($ic)'>Add to Cart</button>
                </div>
                </center>
EOD;
                echo $p;
                break;
            }
            
       case 'delete':{
           $index=$_GET['itemCode'];
           $_SESSION['sCart']=mPOP($_SESSION['sCart'],$index);
           echo "Item Removed";
           header("location:sCart.php?action=view");
           break;
       }
       
       case 'checkout':{
          echo "Proceeding to payment gateway...        ";
       }
            
     default:   break;
            
            }
            ?>
</div>
</div>


<div id="rightcontent">
<div>
<div style="position:relative;top: 30px;left: 10px;">
        <?php
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
    <div class="sCart" id="sCart" style="top:160px;">
        <center><a href="sCart.php?action=view">
        <img src="images/sCart.png" height="60" width="100" alt=""></img></a>
         <br/>
        <a class="ex5" href="sCart.php?action=view" style="font-family: Arial;">
        Shopping Cart
        </a></center>
        </div>
</div>
    <div id="sbox" class="hide">
        search box
        <input type="text" onclick="clearbox()"  value="enter search text"/>
        <button onclick="search()">Search</button>
    </div>
</div>
    <div id="footer"><br/>   &copy; COPYRIGHT 2011 </div>
        
</body>
</html>
<?php
}
?>

