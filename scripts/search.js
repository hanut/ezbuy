/*
 ############################################################
 #    @@@____________Author::"Hanut Singh"____________@@@   #
 #_________________________search.js________________________#
 #                                                          #
 ############################################################
 */

function show_search(){ 
   document.getElementById('sbox').className='search_box';
   document.getElementById('sbox').innerHTML= "Enter Item Code to search <input type='text' onclick='clearbox()' /\n\
   value='enter search text' name='q' style='width:180px;border:1px solid orange;'/><br/>\n\
   <button onclick='search(event)'/>Submit</button>\n\
   <button onclick='hide_sbox()'>Close</button>";
}

function search(evt){
    evt.target.style.border="2px solid orange";
    var sbox=document.getElementById('sbox');
    var query = getq();
    if(!document.getElementById('result'))
       makebox();
   else
       resetbox();
    var xmlhttp2;
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp2=new XMLHttpRequest();
    }
    else
    {// code for IE6, IE5
        xmlhttp2=new ActiveXObject("Microsoft.XMLHTTP");
    }
       xmlhttp2.onreadystatechange=function()
        {
            if (xmlhttp2.readyState==4 && xmlhttp2.status==200)
            {
               var p=xmlhttp2.responseText;
               document.getElementById("resultContents").innerHTML=p;
            }
            else
                {
                    window.scrollTo(0, 100);
                }
        }
        xmlhttp2.open("GET","iManage.php?submit=search&keys="+query,true);
        xmlhttp2.send();
        hide_sbox();
}


function hide_sbox(){
    document.getElementById('sbox').className='hide';
}

function clearbox(){
    document.getElementById('sbox').getElementsByTagName('input')[0].value='';
}

function getq(){
    return sbox.getElementsByTagName('input')[0].value;
}

function makebox(){
        var p="<div id='result' class='itemPane' style='left:35%;top 30%;'>\n\
                <center><h1>Results</h1></center>\n\
                <div class='pContents' id='resultContents'> \n\
                </div>\n\
                </div>";
            
        document.body.innerHTML+=p;
        document.getElementById('result').innerHTML+="<button style='position:absolute;bottom:25px;left:35px;' onclick='rem()'>Close</button>";
        document.title="Searching "+getq()+"...";
    }
    
function resetbox(){
    var p= "<center><h1>Results</h1></center>\n\
            <div class='pContents' id='resultContents'>\n\
            </div>";
    var x=document.getElementById("result");
    x.className="itemPane";
    x.innerHTML=p;
    x.innerHTML+="<button style='position:absolute;bottom:25px;left:35px;' onclick='rem()'>Close</button>";
    document.title="Searching for"+getq()+"...";
}
    
function rem(){
        var x=document.getElementById('result');
        x.className="hide";
    }