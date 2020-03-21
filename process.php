<?php
require_once("connect_db.php");
session_start();


if(isset($_POST["Create"])){
    $id=$_POST["book_id"];
    $name=$_POST["book_name"];
    $publisher=$_POST["book_publisher"];
    $price=$_POST["book_price"];
    $errors=["name"=>"","publisher"=>""];

    //cheking for errors (just empty name/publisher field)
    if(empty($name)){
        $errors["name"]=" * field is required";
    }
    if(empty($publisher)){
        $errors["publisher"]=" * field is required";
    }
    if(array_filter($errors)){
        $inputs=["id"=>$id,"name"=>$name,"publisher"=>$publisher,"price"=>$price];
        $_SESSION["ERR"]=$errors;
        $_SESSION["inputs"]=$inputs;
        header("location:index.php");
    }else{
        try{
            $db->setATTribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            if(empty($price)){
                $price="-";
            }
            $stmt=$db->prepare("INSERT INTO BOOKS (book_name,publisher,book_price) VALUES (:name,:publisher,:price)");
            $stmt->execute([":name"=>$name,":publisher"=>$publisher,":price"=>$price]);
            $_SESSION["action"]="ADD";
            header("location:index.php");
            
            }catch(PDOException $e){
                echo "Eroor : ".$e->getMessage();
            }
    }
    

}


//refreshing (not necessary , since i direct rediricet the oage fron the other submit buttons)
if(isset($_POST["Read"])){
    header("location:index.php");
}

//for the edit option ... we can also use a link with GET methode[having the id by : session _id if another page ....same page : hidden input nd default value + require] or we can use javascript to diplay the data on click event nd then enable the buttons delete and update ,with js 2 methodes : siblings ...or datasset .....

if(isset($_POST["Update"])){
    $id=$_POST["book_id"];
    $name=$_POST["book_name"];
    $publisher=$_POST["book_publisher"];
    $price=$_POST["book_price"];
    $errors=["name"=>"","publisher"=>""];
    

    //cheking for errors (just empty name/publisher field)
    if(empty($name)){
        $errors["name"]=" * field is required";
    }
    if(empty($publisher)){
        $errors["publisher"]=" * field is required";
    }
    if(array_filter($errors)){
        $inputs=["id"=>$id,"name"=>$name,"publisher"=>$publisher,"price"=>$price];
        $_SESSION["disabled"]=true;
        
        $_SESSION["ERR"]=$errors;
        $_SESSION["inputs"]=$inputs;
        $_SESSION["ERR1"]="";
      header("location:index.php");
    }else{
        try{
            $db->setATTribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            if(empty($price)){
                $price="-";
            }
            $stmt=$db->prepare("UPDATE BOOKS SET book_name=:name,publisher=:publisher,book_price=:price WHERE book_id=:id");
             $stmt->execute([":name"=>$name,":publisher"=>$publisher,":price"=>$price,":id"=>$id]);
            $_SESSION["action"]="UPDATED";
            if(isset($_SESSION["disabled"])){
                unset($_SESSION["disabled"]);
            }
       header("location:index.php");
            
            }catch(PDOException $e){
                echo "Eroor : ".$e->getMessage();
            }
    }
    

}

//the delete option
if(isset($_POST["Delete"])){
    $id=$_POST["book_id"];


        try{
            $db->setATTribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $stmt=$db->prepare("DELETE  FROM BOOKS  WHERE book_id=:id");
             $stmt->execute([":id"=>$id]);
            $_SESSION["action"]="DELETED";
            if(isset($_SESSION["disabled"])){
                unset($_SESSION["disabled"]);
            }
       header("location:index.php");
            
            }catch(PDOException $e){
                echo "Eroor : ".$e->getMessage();
            }
    
    

}

//delete all
if(isset($_POST["Delete_All"])){
    


        try{
            $db->setATTribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $stmt=$db->prepare("DELETE FROM BOOKS ");
             $stmt->execute();
            $_SESSION["action"]="DELETED";
           
       header("location:index.php");
            
            }catch(PDOException $e){
                echo "Eroor : ".$e->getMessage();
            }
    
    

}

?>