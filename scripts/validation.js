/*
 ############################################################
 #    @@@____________Author::"Hanut Singh"____________@@@   #
 #____________________( Validation.js )_____________________#
 #                  Script for Login Validation             #
 ############################################################
 */

var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }

function checkFields(evt)
{
var x=evt.target.getElementsByTagName('input');
var flag=true;
for(i=0;i<x.length;i++)   
{
if (x[i].value==null || x[i].value=="")
  {
  flag=false;
  break;
  }
  if(x[i].id=='email' && !validEmail(x[i].value)){
      alert(x[i].value);
      document.getElementById("ERROR").innerHTML="<font color='white'>Invalid Email</font>";
      flag=false;
  }
}
if(flag==false){
    document.getElementById("ERROR").innerHTML="<font color='white'>EMPTY "+x[i].name+" Field";
   return false;
}
else
    return true
}


function validEmail(email){
  xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    return xmlhttp.responseText;
    }
  else
      return true;
  }
  xmlhttp.open("GET","valid.php?type=email&value="+email,true);
  xmlhttp.send();
}

function validUserId(){
  xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById('ERROR').innerHTML=xmlhttp.responseText;
    }
  else
      document.getElementById('ERROR').innerHTML="";
  }
  var name=document.getElementsByName('userID')[0].value;
  xmlhttp.open("GET","valid.php?type=user&value="+name,true);
  xmlhttp.send();  
}