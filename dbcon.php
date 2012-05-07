<?php

class dataHandler{

private $db_server="localhost";
private $db_name="mydb";
private $usr="root";
private $pass='';
public $query="";


    
    function connect_db(){
    $dblink=  mysql_connect($this->db_server,  $this->usr,  $this->pass) or die("Couldnt connect to DB server.");
    $db_got= mysql_select_db($this->db_name) or die("Couldn't read database");
    return $dblink;
}

    function erase($id){
        $link=connect_db();
        close_db($link);
    }
    
    function close_db($link){
        mysql_close($link);
    }
    

}
?>
