<?php

require_once "blogic.php";
session_start();
if(isset($_SESSION['uid'])){
$action=$_REQUEST["submit"];



switch($action)
{
    case 'Add Item' :
    {
        $itemName=$_POST['itemName'];
        $cost=$_POST['price'];
        $desc=$_POST['desc'];
        $sellerID=$_SESSION['uid'];
        $stock=$_POST['stock'];
        $category=$_POST['category'];
        $keywords=$_POST['keywords'];
        $img_path=addImage();
        if($img_path==NULL){
            $img_path="images/default.png";}
            $test=item::add_item ($itemName, $cost, $desc, $img_path, $sellerID, $stock,$category,$keywords);
        if($test==false)
            echo "ERROR";
        else
            echo "booyah";
        header("location:home.php");
    }
    
    case 'fill' :
    {
        $s="";
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
        $start=($_REQUEST['page']*$_REQUEST['range'])-($_REQUEST['range']-1);
        $end=$_REQUEST['page']*$_REQUEST['range'];
        $index=$i=$start;
        while($i<=$end){
            $item=new item($index);
            $holder=$item->getStats();
            if($holder['name']=='fail'&&$holder['itemCode']<get_last_ic()){
             $index++;
            continue;
            }
            if($holder['name']=='fail'&&$holder['itemCode']>get_last_ic()){
                break;
            }
    $s.="<div align=center>";
    $path=$item->getPicPath();
    $s.= "<tr><td class='td2'>".$holder['itemCode']."</td>";
    $s.="<td class='td2'><a class='itemLink' href='sCart.php?action=add&itemCode=".$holder['itemCode']."'>".$holder['name']."</a></td>";
    $s.="<td class='td2'>".$holder['desc']."</td>";
    $s.= "<td class='td2'>Rs. ".$holder['cost']."</td>";
    $s.= "<td class='td2'>".$holder['stock']."</td>";
    $s.= "<td class='td2'>".$holder['sellerID']."</td>";
    $s.= "<td class='td2'><a href='sCart.php?action=add&itemCode=".$holder['itemCode']."'>"."<img src=".$path." alt=kinky height='80' width='80'/></a></td>";
   $index++;$i++;
        }
        $s.="</tbody>";
        $s.="</table></div>";
    echo $p.$s;
    break;
    }
    
    case 'fill_category' :
    {
        $categoryName=$_GET['category'];
        $s="";
        $p= <<<EOD
        <div align='center'><table class='table2' border=0 cellpadding=0 cellspacing=0>
        <thead class='thead2'><tr>
        <th class='th2'>Item Code</th>
        <th class='th2'>Item Name</th>
        <th class='th2'>Category</th>
        <th class='th2'>Cost</th>
        <th class='th2'>Stock</th>
        <th class='th2'>Seller</th>
        <th class='th2' style='border-right:none;'></th>
        </tr></thead>
        <tbody>
EOD;
        $page=$_REQUEST['page'];
        $range=$_REQUEST['range'];
        $category=new category($categoryName);
        for($i=($page*$range)-5;$i<=($page*$range)-1;$i++){
            $item=new item($category->fetch_item($i));
            $holder=$item->getStats();
            if($holder['name']=='fail'){
            continue;
            }
    $s.="<div align=center>";
    $path=$item->getPicPath();
    $s.= "<tr><td class='td2'>".$holder['itemCode']."</td>";
    $s.="<td class='td2'><a class='itemLink' href='sCart.php?action=add&itemCode=".$holder['itemCode']."'>".$holder['name']."</a></td>";
    $s.="<td class='td2'>".$holder['category']."</td>";
    $s.= "<td class='td2'>Rs. ".$holder['cost']."</td>";
    $s.= "<td class='td2'>".$holder['stock']."</td>";
    $s.= "<td class='td2'>".$holder['sellerID']."</td>";
    $s.= "<td class='td2'><a href='sCart.php?action=add&itemCode=".$holder['itemCode']."'>"."<img src=".$path." alt=kinky height='80' width='80'/></a></td>";
        }
        $s.="</tbody>";
        $s.="</table></div>";
    echo $p.$s;
    break;
    }
    
    
    case 'search':
    {
        $key=$_REQUEST['keys'];
        $dbcon=new dataHandler();
        $link=$dbcon->connect_db();
        $query="SELECT itemCode,itemName,price FROM items WHERE keywords LIKE '%".$key."%' LIMIT 6";
        $result=mysql_query($query,$link);
        echo "Searched for <b>".$key."</b><br/>";
        $i=0;$ic=array();
        while($row=mysql_fetch_array($result)){
        $ic[$i][0]=$row[0];
        $ic[$i][1]=$row[1];
        $ic[$i][2]=$row[2];
        $i++;
        }
        if(!$i>0){
            echo "No items found";
            die();
            
            }
        for($i=0;$i<count($ic);$i++){
        $item=new item($ic[$i][0]);
        echo "<div id='division$i' style='border:1px darkgrey solid;font-size:11px;margin-right:15px;float:left;'>";
        echo "<a href='sCart.php?action=add&itemCode=".$ic[$i][0]."' ";
        echo "style='display:block;text-decoration:none;color:orangered;font-family:Arial;height:40px;width:40px;'>Item Name : ".$ic[$i][1]."<br/> Price : ".
                                                        $ic[$i][2]."</a>";
        echo "<img src='".$item->getImgPath()."' height=60 width=60'></img>";
        echo "</div>";
        }
        break;
    }
    
    case 'getuic':
    {
        $uid=$_SESSION['uid'];
        $icList=getICByUser($uid);
        if(!$icList){
            echo "You havent added any items";
            break;
        }
        $p="";
        for($i=0;$i<count($icList);$i++){
            $item=new item($icList[$i]);
            $name=$item->getName();
            if(strlen($name)>12)
            {
                $name=str_split($name,12);
                $name=$name[0];
            }
            $itemCode=$item->getIC();
            $path=$item->getImgPath();
            $tmp=<<<EOD
            <div id="$i" class="iBox">
            <img src='$path' height=100 width=120 alt='$name'></img><br/>
            <center><b>Name</b>:$name</center><br/>
            <center><b>Item Code</b>:$itemCode
            <input type='radio' id='item' value='$itemCode' onclick="setVal($itemCode)"/></center>
                </div>
EOD;
            $p.=$tmp;
            unset ($item);
        }
        echo $p;
        break;
    }
    
    case 'Remove Item':
    {
        $itemCode=$_GET['itemCode'];
        $item=new item($itemCode);
        if($item->getSellerID()==$_SESSION['uid']){
            unset($item);
        $flag=item::del_item($itemCode);
        if($flag){
            echo "item Deleted";
        }
        else {
         echo "Fail"   ;
        }
        }
        else 
        {echo "fail";}
        break;
    }
    
    case 'addToCart':{
        
        $itemCode=$_GET['ic'];
        if(!isset($_SESSION['sCart'])){
            $_SESSION['sCart']=array();
        }
        array_push($_SESSION['sCart'], $itemCode);
        echo "Item added to Cart<br/>";
        echo "<a class='ex5' href='sCart.php?action=view'>View Cart</a>";
        break;
    }
    
   default :    echo "Error";break;
}
}
else{
    header("location:home.php");
}

function addImage(){
    if((($_FILES["img"]["type"]=="image/gif")
      ||($_FILES["img"]["type"]=="image/jpeg")
      ||($_FILES["img"]["type"]=="image/png"))
      &&($_FILES["img"]["size"]<1000000))
    {
      if($_FILES["img"]["error"]>0)
        {
            return NULL;
        }
      else
      {
          if(file_exists("upload/".$_FILES["img"]["name"]))
          {
              return NULL;
          }
          else
          {
              $md5=md5($_FILES["img"]["name"].(microtime()*time()));
              $tmp=str_split(str_shuffle($md5),8);
              $fname=$tmp[rand(0, 3)];
              move_uploaded_file($_FILES["img"]["tmp_name"],"upload/".$fname);
              return("upload/".$fname);
          }
      }
    }
    else
        return NULL;
}
?>
