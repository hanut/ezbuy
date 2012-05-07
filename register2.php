<?php
session_start();
require_once 'blogic.php';
if(isset($_SESSION['uid'])){
    header("location:home.php");
}
else{
if(isset($_POST['SUBMIT'])){
    $type=$_POST['r'];
    $firstName=$_POST['firstName'];
    $lastName=$_POST['lastName'];
    $day=$_POST['day'];
    $month=$_POST['month'];
    $year=$_POST['year'];
    $date=$day."/".$month."/".$year;
    $street=$_POST['addy'];
    $city=$_POST['city'];
    $country=$_POST['country'];
    $contactNo=$_POST['contactNo'];
    if(!($_POST['email_id']==$_POST['email_id_2'])){
       echo "<script type='text/javascript'>alert('Email doesnt match');</script>";
       die('email auth failed');
    }
    else{
        $email=$_POST['email_id'];
    }
    $userID=$_POST['userID'];
    if(!($_POST['password']==$_POST['confirmPassword'])){
       echo "<script type='text/javascript'>alert('Passwords Dont match!');</script>";
       die('Pass matching failed');
        
    }
    else{
        $pwd=$_POST['password'];
    }
    $question=$_POST['question'];
    $ans=$_POST['answer'];
    $user=new user($userID, $pwd);
    $rquery="INSERT INTO `users_login` (`DOB`, `Address`, `Country`, `contactNo`, `City`, `emailID`, `userID`, `password`, `firstName`, `lastname`) VALUES ('$year-$month-$day', '$street', '$country', '$contactNo', '$city', '$email', '$userID', '$pwd', '$firstName', '$lastName')";
    $flag=$user->register($rquery);
    if($flag){
        $_SESSION['uid']=$userID;
        $_SESSION['pwd']=$pwd;
        session_id();
        header("location:home.php");
    }
    else
        echo "Couldnt register";
        }       
else{
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<link rel="stylesheet" type="text/css" href="style1.css"/>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="images/logo1.png" type="image/png" />
<script src="scripts/search.js" language="javascript" type="text/javascript">
</script>

<title>EzBuy</title>

<script src="scripts/validation.js" language="javascript" type="text/javascript">
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
<td class="links_int"><a href="#" class ="ex5" onclick="show_search()">Search Item</a></td>
</tr>
</table>
<div class="main_panel">
<div id="leftcontent">
<img src="images/lmenuBG.png" alt="funky" title="Phonons" height="700" width="200"/>
</div>

<div id="centercontent">
<div class="content">
    <div style="">
<form name="register"  onsubmit="return checkFields(event)" action="register2.php" method="post">
<hr/> <center><b><i><font size="5" color="white">Registration</font></i></b></center>
<hr/> 

<table border="1" cellpadding="0" cellspacing="0" style="width: 335px;font-size: 14px;">
<tr><td>User Type:<br/><input type="radio" name="r" value="Buyer"/>Buyer<br/><input type="radio" name="r" value="Seller" style="border: 1px solid orange;"/>Seller </td></tr>
</table>

<table border="1" cellpadding="0" cellspacing="0" style="font-size: 14px;width: 335px;">
<th><font size="2" color="lightpink"><b>Personal Details:</b></font></th>
<tr><td>First Name:<br /><input type="text" name="firstName" style="border: 1px solid orange;"/></td></tr><tr><td>Last Name:<br /><input type="text" name="lastName" style="border: 1px solid orange;"/></td></tr>
<tr><td>D.O.B.:
<br/>DD<select name="day"><option/><?php
for($i=1;$i<=31;$i++){
    echo "<option value='$i'>$i</option>";
}
?>
</select>/
MM<select name="month"><option/>
<option value="01">Jan</option>
<option value="02">Feb</option>
<option value="03">March</option>
<option value="04">April</option>
<option value="05">May</option>
<option value="06">June</option>
<option value="07">July</option>
<option value="08">August</option>
<option value="09">September</option>
<option value="10">October</option>
<option value="11">November</option>
<option value="12">December</option>
</select>/
YYYY<select name="year"><option/><?php
for($i=1950;$i<=2007;$i++){
    echo "<option value='$i'>$i</option>";
}
?>
</select></td></tr>
</table>
<br>

<table border="1" cellpadding="0" cellspacing="0" style="width: 335px; font-size: 14px;">
<th><font size="2" color="lightpink"><b>Contact Details:</b></font></th>
<tr><td>Street Address:<br/><input type="text" name="addy" style="width: 270px;border: 1px solid orange;"/></td></tr>
<tr><td>City:<br/><input type="text" name="city" style="width: 270px;border: 1px solid orange;"/></td></tr>
<tr><td>Country:<br/><input type="text" name="country" style="width: 270px;border: 1px solid orange;"/></td></tr>
<tr><td>Contact No.:<br/><input type="text" name="contactNo" style="width: 270px;border: 1px solid orange;"/></td></tr>
<tr><td>Email id:<br/><input type="text" id="email" name="email_id" style="width: 270px;border: 1px solid orange;"/></td></tr>
<tr><td>Confirm Email id:<br/><input type="text" id="email" name="email_id_2" style="width: 270px;border: 1px solid orange;"/></td></tr>
</table>
    </div>
    
    <div style="position: absolute;top:110px;left:52%;">
<table border="1" cellpadding="0" cellspacing="0" style="width: 335px;font-size: 14px;">
<th><font size="2" color="lightpink"><b>Choose your User id and Password:</b></font></th>
<tr><td>User id:<br/><input type="text" name="userID" style="width: 270px;border: 1px solid orange;" onkeyup="validUserId()"/></td></tr>
<tr><td>Password:<br/><input type="password" name="password" style="width: 270px;border: 1px solid orange;"/></td></tr>
<tr><td>Confirm Password:<br/><input type="password" name="confirmPassword" style="width: 270px;border: 1px solid orange;"/></td></tr>
<tr><td>Enter your own secret question:<br/><input type="text" name="question" style="width: 270px;border: 1px solid orange;"/></td></tr>
<tr><td>Your Secret Answer:<br/><input type="text" name="answer" style="width: 270px;border: 1px solid orange;"/></td></tr>
</table>

<br/>


<center><input type="reset" name="RESET"/><input type="submit" name="SUBMIT"/></center>
<br/>
<div id="ERROR" style="text-align: center;font-size: 12px;"></div>
</form></div>
</div>
</div>

<div id="rightcontent">
<div>
Ad Placeholder
</div>
</div>

</div>
    <div id="footer"><br/>   &copy; COPYRIGHT 2011 </div>
</div>
<div id="sbox" class="hide">
       
    </div>
</body>
</html>
<?php
}
}
?>