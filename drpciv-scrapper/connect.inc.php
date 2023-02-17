<?php
function connectToMySQL(){

    $link=mysqli_connect("localhost","root","");
    if(!$link){
        die("ERROR to connect !");

    }else{
        return $link;
    }


}
