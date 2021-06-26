<?php

session_start();
$created_by = $_SESSION['useruid'];// The name of the username

// This is sign in page 
// Just admins can sing up new users

require_once 'dbh.inc.php';
require_once 'function.inc.php';

if(isset($_POST['creat-admin'])){
    
    // order in data base
    $adminOrder = $_POST['order-admin'];
    // Wheather it is primary or secondary
    $tableName = '';
    $tableName = $adminOrder == 2 ? 'primaryadmins' : "secondaryadmins";

    $adminName = $_POST['adminName'];
    $adminEmail = $_POST['adminEmail'];
    $pwd = $_POST['pwd'];

    // Security
    $adminName = mysqli_real_escape_string($conn, $adminName);
    $adminEmail = mysqli_real_escape_string($conn, $adminEmail);
    $pwd = mysqli_real_escape_string($conn, $pwd);
    
    // Replace # with it's unicode 
    $adminName =  str_replace("#", "%23", $adminName);

    // Error handling 
    if(isEmpty($adminName) || isEmpty($adminEmail) || isEmpty($pwd)){
        header("Location:../setting.php?error=emptyadminfields&name=" . $adminName . "&email=" . $adminEmail );
        exit();
    }
    // Validation for arabic and Enlgish preventing #@$%! these things
    if(!preg_match("~^[a-z0-9\-'\s\p{Arabic}]{1,60}$~iu", $adminName)){
        header("Location:../setting.php?error=invaliduid&name=" . $adminName . "&email=" . $adminEmail );
        exit();
    }
    // // Email Validaion
    if(!filter_var($adminEmail, FILTER_VALIDATE_EMAIL)){
        header("Location:../setting.php?error=invalidemail&name=" . $adminName . "&email=" . $adminEmail );
        exit();
    }
    // Password Validation
    if(strlen($pwd) < 8){
        header("Location:../setting.php?error=lesspwdlength&name=" . $adminName . "&email=" . $adminEmail );
        exit();
    }
    // check if the uid is exist befor if it is do not create a new one
    if(uidExist($conn, $adminName, $adminEmail, $tableName) != false){ 
        header("Location:../setting.php?error=uidexist&name=" . $adminName . "&email=" . $adminEmail );
        exit();
    }
    // Create the user
    createAdmin($conn, $adminName,$adminEmail, $pwd, $tableName, $adminOrder, $created_by);

}
 