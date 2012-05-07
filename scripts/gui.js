/*
 ############################################################
 #    @@@____________Author::"Hanut Singh"____________@@@   #
 #________________________( gui.js )________________________#
 #                                                          #
 ############################################################
 */



function hide_pbox(){
    document.getElementById('pbox').className='hide';
}

function personalize(){
    
    document.getElementById('pbox').className='pWindow';
    
    var p="<div class='pContents'/><br/><h1>Edit your Settings</h1><br/> \n\
           First Name <input type='text' onclick='clearField(event)' style='border: 2px solid orange;' name='firstName'><br/>\n\
           Last Name <input type='text' onclick='clearField(event)' style='border: 2px solid orange;' name='lastName'><br/>\n\
           Address&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' onclick='clearField(event)' style='border: 2px solid orange;' name='Address'><br/>\n\
           City&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\
            <input type='text' onclick='clearField(event)' style='border: 2px solid orange;' name='City'><br/>\n\
           Country&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type='text' onclick='clearField(event)' style='border: 2px solid orange;' name='Country'/>\n\
            <br/>\n\
           <br/>Delete Account ? <button name='delete' value='delete' style='width:80px;height:20px;' onclick='userDelete()'>Delete</button>\n\
           <br/><button onclick='hide_pbox()' value='save' style='width:80px;height:20px;'>Done</button>\n\</div>";
     document.getElementById('pbox').innerHTML= p;
    
}


function hideLeftMenu(){
    document.getElementById("lMenu").innerHTML="<tr><th>Left Menu</th></tr>\n\
                                                <tr><td> </td></tr>";
}

function hideItemPane(){
    document.getElementById('itemPane').className='hide';
}

function showItemPane(){
    
    document.getElementById('itemPane').className='itemPane';
    var p="<center><h2 style='position:relative;top:10px;'>Add Items</h2><hr color='black' width=360px weight=20/></center><div class='pContents'/>\n\
            <form name='itemForm' action='iManage.php' method='POST' enctype='multipart/form-data'>\n\
            <table name='itemTable'>\n\
           <tr><td>Name</td><td><input type='text' onclick='clearField(event)' style='border: 2px solid orange;width:180px;' name='itemName'/></td></tr>\n\
           <tr><td>Price</td><td><input type='text' onclick='clearField(event)' style='border: 2px solid orange;width:180px;' name='price'/></td></tr>\n\
           <tr><td>Description</td><td><textarea onclick='clearField(event)' style='border: 2px solid orange;\n\
            height: 150px;width:175px;max-height:150px;max-width:175px;' name='desc'></textarea></td></tr>\n\
           <tr><td>Image</td><td><input type='file' style='border: 2px solid orange;width:180px;' name='img' value='default'/></td></tr>\n\
           <tr><td>Stock</td><td><input type='text' onclick='clearField(event)' style='border: 2px solid orange;width:180px;' name='stock'/></td></tr>\n\
            <tr><td>Category</td><td><select style='border: 2px solid orange;width:180px;' name='category'/>\n\
            <option value='Shoes'>Shoes</option>\n\
            <option value='Eyewear'>Eyewear</option>\n\
            <option value='Shirts'>Shirts</option>\n\
            <option value='T-Shirts'>T-Shirts</option>\n\\n\
            <option value='Trousers and Jeans'>Trousers and Jeans</option>\n\
            <option value='Hats and Caps'>Hats and Caps</option>\n\
            <option value='Misc'>Misc.</option></select></td></tr>\n\
           <tr><td>Keywords</td><td><input type='text' onclick='clearField(event)' style='border: 2px solid orange;width:180px;' name='keywords'/></td></tr>\n\
           <tr><td><input type='submit' class='button' name='submit' value='Add Item' style='width:80px;height:20px;' onclick='hideItemPane()'/></td>\n\
           <td></td></tr></table></form><button name='Close' onclick='hideItemPane()'>Close</button></div>";
     document.getElementById('itemPane').innerHTML=p;
}

function clearField(evt){
   evt.target.value="";
}

function showItemPane2(){
    var x=document.getElementById('itemPane');
    x.className='clearPane';
    x.innerHTML="";
        var p="<div class='deleteItemPane' id='innerPane'>\
            <center><h1 style='position:relative;top:10px;display:block;background-color:white;'>Delete Items</h1><hr color='black' style='width:950px'/></center>\n\
            <div class='pContents' id='pContents' style='padding-right:10px;'/>\n\
            <div id='itemsFlowList'>\n\
            </div>\n\
            <input type='hidden' id='delCode' value=''/>\n\
            <div style='float:none;clear:both;'>\n\
            <button name='Delete' onclick='confirmdelete();'>Delete</button>\n\
            <button name='Close' onclick='hideItemPane()'>Close</button></div>\n\
            </div></div>";
    x.innerHTML=p;
    document.getElementById('innerPane').className='deleteItemPane';
    getUserItems();
    
}

function setVal(itemCode){
    document.getElementById('delCode').value=itemCode;
}

function confirmdelete(){
    var choice=confirm("Are You Sure?");
    if(choice){
        deleteItem();
    }
        hideItemPane();
}

function getUserItems(){
    var xmlhttp;
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }
    else
    {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
       xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                document.getElementById('itemsFlowList').innerHTML+=xmlhttp.responseText;
                
            }
        }
        var a=document.getElementById('uid').value;
        xmlhttp.open("GET","iManage.php?submit=getuic&q="+a,true);
        xmlhttp.send();
   }
   
   function deleteItem(){
    var xmlhttp;
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }
    else
    {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
       xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                alert(xmlhttp.responseText);
                document.location="home.php";
                
            }
        }
        var a=document.getElementById('delCode').value;
        xmlhttp.open("GET","iManage.php?submit=Remove Item&itemCode="+a,true);
        xmlhttp.send();
   }
   
   function loadLeftMenu(){
       var xmlhttp;
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }
    else
    {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
       xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                document.getElementById('lMenu').innerHTML=xmlhttp.responseText;
                
            }
        }
        xmlhttp.open("GET","lMenu.php",true);
        xmlhttp.send();
   }