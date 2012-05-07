/* 
 * Made by Hanut Singh
 * Just some interesting random stuff worked out from the gmail load screen.
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


function funStuff(){
    var x=document.getElementById('funStuff');
    for(var i=0;i<20;i++){
        x.innerHTML+="<div id='division"+i+"' class='cool'></div>";
    }
    torq=0;
    xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                document.getElementById("division"+torq).className=xmlhttp.responseText;
                window.scrollTo(0, 220);
            }
        }
        while(torq!=100){
        torq=rGen(0,20);
        xmlhttp.open("GET","funStuff.php?q="+torq,true);
        xmlhttp.send();
    }
}

function rGen(min, max)
{
return Math.floor(Math.random() * (max - min + 1)) + min;
}