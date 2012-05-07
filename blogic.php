<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include_once 'dbcon.php';

class user{
    private $uname;
    private $upass;
    public $dbcon;
    
    
    function __construct($u_name,$u_pass) {
        $this->uname=$u_name;
        $this->upass=$u_pass;
        $this->dbcon=new dataHandler();
    }
    
    function validate(){
      $link=$this->dbcon->connect_db();
      $query="SELECT password FROM users_login WHERE userID='$this->uname'";
      $result=mysql_query($query,$link);
      if(mysql_num_rows($result)){
          while($row=  mysql_fetch_array($result)){
              if($this->upass==$row[0])
                      return TRUE;
              else
                  return FALSE;
          }
      }
      else
          echo "user not found";
          $this->dbcon->close_db($link);
    }
    
    function register($rquery){
      $link=$this->dbcon->connect_db();
      $query=$rquery;
      $result=mysql_query($query,$link);
      if(!$result){
          echo "failure";
      }
      if(mysql_affected_rows($link)){
          $this->dbcon->close_db($link);
          return TRUE;
          }
      else{
          $this->dbcon->close_db($link);
          return FALSE;
                   
          }
    }
    
   static function delete($uid){
       $dbcon=new dataHandler();
        $link=$dbcon->connect_db();
        $query="DELETE FROM users_login WHERE userID='$uid'";
        $result=mysql_query($query);
        if(!$result){
            return false;
        }
        else{
            return true;
        }
        $this->dbcon->close_db($link);
    }
    
    function getName(){
        $link=$this->dbcon->connect_db();
        $query="SELECT firstName FROM users_login WHERE userID='$this->uname'";
        $result=mysql_query($query, $link);
        $row=mysql_fetch_array($result);
        $this->dbcon->close_db($link);      
        return $row[0];
    }
    static function fetchUserInfo($uid){
        $dbcon=new dataHandler();
        $link=$dbcon->connect_db();
        $query="SELECT * FROM users_login WHERE userID='$uid'";
        $result=mysql_query($query);
        $row=mysql_fetch_array($result);
        $tmp=array();
        for($i=0;$i<10;$i++){
            $tmp[$i]=$row[$i];
        }
        $dbcon->close_db($link);
        return $tmp;
    }
    
    static function getExistingUsers(){
        $dbcon=new dataHandler();
        $link=$dbcon->connect_db();
        $query="SELECT userID FROM users_login";
        $result=mysql_query($query);
        $arr=array();
        $i=0;
        while($row= mysql_fetch_array($result, MYSQL_NUM)){
            $arr[$i]=$row[0];
            $i++;
        }
        return $arr;
    }

}

class item{
    private $name;
    private $itemCode;
    private $img_path;
    private $stock;
    private $cost;
    private $sellerID;
    private $desc;
    private $category;
    private $keywords;
    
   /* function __construct($name,$quantity,$cost,$sellerID){
        $this->name=$name;
        $this->img_path=$this->getPicPath();
        $this->stock=$quantity;
        $this->cost=$cost;
        $this->sellerID=$sellerID;
    }*/
    
    function __construct($itemCode){
        $dbcon=new dataHandler();
        $link=$dbcon->connect_db();
        $this->itemCode=$itemCode;
        $query="SELECT itemName, price, img_path, sellerID, avail, item_desc,category,keywords FROM items WHERE itemCode=$itemCode";
        $result=mysql_query($query, $link);
        if(!$result){
            $this->name="fail";
            return;
        }
        $row=mysql_fetch_array($result);
        $dbcon->close_db($link);
        if(!$row){
            $this->name="fail";
            return;
        }
        $this->name=$row[0];
        $this->img_path=$row[2];
        $this->stock=$row[4];
        $this->cost=$row[1];
        $this->sellerID=$row[3];
        $this->desc=$row[5];
        $this->category=$row[6];
        $this->keywords=$row[7];
        
    }
    
    static function add_item($name, $cost, $desc, $path, $sellerID, $stock,$category,$keywords){
    $dbcon=new dataHandler();
    $link=$dbcon->connect_db();
    echo $category.$keywords;
    $query="INSERT INTO `mydb`.`items` (`itemName`, `price`, `item_desc`, `img_path`, `sellerID`, `avail`,`category`,`keywords`) VALUES ('$name', '$cost', '$desc', '$path', '$sellerID', '$stock','$category','$keywords')";
    $result=mysql_query($query,$link) or die("bc");
      if(!$result){
          echo "failure";
      }
      if(mysql_affected_rows($link)){
          $dbcon->close_db($link);
          return TRUE;
          }
      else{
          $dbcon->close_db($link);
          return FALSE;
                   
          }
    }
    
    static function del_item($itemCode){
    $dbcon=new dataHandler();
    $link=$dbcon->connect_db();
    $query="DELETE FROM items WHERE itemCode=$itemCode";
    $result= mysql_query($query,$link) or die("Fail");
    if(!$result){
          echo "failure";
      }
      if(mysql_affected_rows($link)){
          $dbcon->close_db($link);
          return TRUE;
          }
      else{
          $dbcon->close_db($link);
          return FALSE;
                   
          }
    }
    
    function getPicPath(){
    $dbcon=new dataHandler();
    $link=$dbcon->connect_db();
    $query="SELECT img_path FROM items WHERE itemCode=$this->itemCode";
    $result= mysql_query($query,$link);
    if($result){
    $row=mysql_fetch_array($result);
    $dbcon->close_db($link);
    return $row[0];
    }
    else{close_db($link);
        return 'images/default.png';
    }
    }
    
    function getStats(){
        $arr['name']=$this->name;
        $arr['img_path']=$this->img_path;
        $arr['stock']=$this->stock;
        $arr['cost']=$this->cost;
        $arr['sellerID']=$this->sellerID;
        $arr['desc']=$this->desc;
        $arr['itemCode']=$this->itemCode;
        $arr['category']=$this->category;
        return $arr;
    }
    
    function getName(){
        return $this->name;
    }
    function getImgPath(){
        return $this->img_path;
    }
    function getStock(){
        return $this->stock;
    }
    function getCost(){
        return $this->cost;
    }
    function getIC(){
        return $this->itemCode;
    }
    function getSellerID(){
        return $this->sellerID;
    }
}

function get_range(){
    $dbcon=new dataHandler();
    $link=$dbcon->connect_db();
    $query="SELECT COUNT(itemCODE) FROM items";
    $result=mysql_query($query,$link);
    $row=mysql_fetch_array($result);
    $range=ceil($row[0]/5);
    $dbcon->close_db($link);
    return $range;
}

/*function get_view_range($vName){
    $dbcon=new dataHandler();
    $link=$dbcon->connect_db();
    $query="SELECT COUNT(itemCODE) FROM $vName";
    $result=mysql_query($query,$link);
    $row=mysql_fetch_array($result);
    $range=ceil($row[0]/6);
    $dbcon->close_db($link);
    return $range;
}*/

    function get_max_items(){
    $dbcon=new dataHandler();
    $link=$dbcon->connect_db();
    $query="SELECT COUNT(itemCODE) FROM items";
    $result=mysql_query($query,$link);
    $row=mysql_fetch_array($result);
    $dbcon->close_db($link);
    return $row[0];
}

function get_max_items_category($category){
    $dbcon=new dataHandler();
    $link=$dbcon->connect_db();
    $query="SELECT COUNT(itemCODE) FROM (SELECT itemCode FROM items WHERE category LIKE '".$category."') AS a";
    $result=mysql_query($query,$link);
    $row=mysql_fetch_array($result);
    $dbcon->close_db($link);
    return $row[0];
}

function get_last_ic(){
    $dbcon=new dataHandler();
    $link=$dbcon->connect_db();
    $query="SELECT itemCode FROM items ORDER BY itemCode DESC LIMIT 1";
    $result=mysql_query($query,$link);
    $row=mysql_fetch_array($result);
    $ic=$row[0];
    $dbcon->close_db($link);
    return $ic;
}

function getICByUser($seller){
    $dbcon=new dataHandler();
    $link=$dbcon->connect_db();
    $query="SELECT itemCode FROM items WHERE sellerID='".$seller."'";
    $result=mysql_query($query,$link);
    if(mysql_affected_rows()<1){
        return false;
    }
    $i=0;
    while($row=mysql_fetch_array($result)){
        $ic[$i]=$row[0];
        $i++;
    }
    $dbcon->close_db($link);
    return $ic;
}

/***********************************************************************************************
 * The category class below was pure inspiration to code.                                      *
 * It contains two private members categoryName and itemList.                                  *
 * The latter stores the list of itemCodes of all items of the category object                 *
 * as a numeric array.The included functions can then be used to load the objects as required. *
 ***********************************************************************************************/

class category{
    private $categoryName;  //Name of the Category
    private $itemList;      //Array of all itemCodes for items of this category
    
    function __construct($name) {
        $this->categoryName=$name;
        $this->itemList=$this->get_items($name);
    }
    
    private function get_items($category){
        $dbcon=new dataHandler();
        $link=$dbcon->connect_db();
        $query="SELECT itemCode FROM items WHERE category LIKE '".$category."'";
        $result=mysql_query($query);
        $i=0;$arr=array();
        while($row=mysql_fetch_array($result)){
            $arr[$i]=$row[0];
            $i++;
        }
        $dbcon->close_db($link);
        return $arr;
    }
    
    function fetch_item($index){
        if(!isset ($this->itemList[$index])){
            return;
        }
        return $this->itemList[$index];
    }
    
  static  function test(){
      $test=new category("Eyewear");
      for($i=0;$i<count($test->itemList);$i++){
          $ic=$test->itemList[$i];
          $item=new item($ic);
          echo "<img src='".$item->getImgPath()."' alt='test' title='grandios' height=80 width=80></img>";
      }
  }
  
 static function get_range_category($category){
    $result=get_max_items_category($category);
    $range=ceil($result[0]/6);
    return $range;
}
}

/*
 * The following function extends the useability of the pop function.
 * It allows you to pop off an item from a particular index instead
 * of just popping the first element off.
 */
function mPOP($array,$index){
    $tmp=array();$loc=0;
    for($i=0;$i<count($array);$i++){
        if($i==$index)
            continue;
        $tmp[$loc]=$array[$i];
        $loc++;
    }
   return $tmp;
}

?>
