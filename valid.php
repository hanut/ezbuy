<?php
require_once "blogic.php";
$type=$_GET['type'];
$value=$_GET['value'];
if(isset($_SESSION['uid'])){
    die();
}
switch($type)
{
    case 'email' :  $response=filter_var($value,FILTER_VALIDATE_EMAIL);
                    if(!$response)
                        $response="not valid";
                    break;
                    
    case 'user'     : {
        $userList=user::getExistingUsers();
        $response="";
        for($i=0;$i<count($userList);$i++){
            if($value==$userList[$i]){
                $response="User Name Exists";
                break;
            }
        }
        break;
        }
    default :  $response=false;
                    break;

}
echo $response;
?>
