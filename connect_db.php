<?php
$host="localhost";
$dbname="CRUD";
$user_name="root";
$password="";

try{
    $db=new PDO("mysql:host=$host;dbname=$dbname",$user_name,$password);
}catch(PDOException $e){
    echo "Eroor : ".$e->getMessage();
}



?>