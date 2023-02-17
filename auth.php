<?php
function ConnectToMYSQL(){

    $link=mysqli_connect("","","");


    if($link){

        return $link;

    }else{
        die("Cannot connect to MYSQL Server");
    }

}
