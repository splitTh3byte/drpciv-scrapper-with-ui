<?php
function connectToMySQL(){

    $link=mysqli_connect("localhost","root","socket775@");
    if(!$link){
        die("ERROR to connect !");

    }else{
        return $link;
    }


}
