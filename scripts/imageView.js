/*
 ############################################################
 #    @@@____________Author::"Hanut Singh"____________@@@   #
 #_____________________( imageView.js )_____________________#
 #                                                          #
 ############################################################
 */


function hide_image(){
    document.getElementById('imageView').innerHTML="";
    document.getElementById('imageView').className='hide';
}

function showimage(path){
    document.getElementById('imageView').className='imageView';
   
  document.getElementById('imageView').innerHTML+="<br/><img src='"+path+"' alt='pic' class='myIMG'/>";
  document.getElementById('imageView').innerHTML+="<button class='close1' onclick='hide_image()'>&nbsp;</button>";
}