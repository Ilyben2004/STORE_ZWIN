<?php  

function connect(){
    $mysqli = new mysqli('localhost', 'root', '', 'web_store');
    if($mysqli->connect_errno != 0){
       return $mysqli->connect_error;
    }else{
       $mysqli->set_charset("utf8mb4");	
    }
    return $mysqli;
 }

?>


