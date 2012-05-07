/*
 ############################################################
 #   @@@____________Author::"Hanut Singh"_____________@@@   #
 #________________________hAJAX.js__________________________#
 #                                                          #
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
    
   function fill_table(){
        xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                document.getElementById("iGrid").innerHTML=xmlhttp.responseText;
                window.scrollTo(0, 220);
            }
        }
        var range=5;
        var a=document.getElementById('page').value;
        var q="page="+a+"&range="+range;
        xmlhttp.open("GET","iManage.php?submit=fill&"+q,true);
        xmlhttp.send();
   } 
   
   function fill_table_view(category){
        xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                document.getElementById("iGrid").innerHTML=xmlhttp.responseText;
                window.scrollTo(0, 220);
            }
        }
        var range=5;
        var a=document.getElementById('page').value;
        if(a<1){
            document.getElementById('iGrid').innerHTML="sorry there are no items of that kind available";
            return;
        }
        var q="page="+a+"&range="+range+"&category="+category;
        xmlhttp.open("GET","iManage.php?submit=fill_category&"+q,true);
        xmlhttp.send();
   }
   
   function addToCart(ic){
        xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                document.getElementById("itemToAdd").innerHTML=xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","iManage.php?submit=addToCart&ic="+ic,true);
        xmlhttp.send();
   }