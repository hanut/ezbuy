<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
        require_once 'blogic.php';
        
        $user_id=$_POST["UserID"];
        $pwd=$_POST["Password"];
        
        $user = new user($user_id, $pwd);
        $valid=$user->validate();
        if($valid){
            echo "Logged in...redirecting to homepage";
            $flag=session_start();
            $_SESSION['uid']=$user_id;
            $_SESSION['pwd']=$pwd;
            $_SESSION['sCart']=array();
            session_id();
            if($flag){
            header("location:home.php");
            }
            else{
                echo "hohoho";
            }
        }
        else{
            header("location:index.php?login=fail");
        }
        ?>
    </body>
</html>
