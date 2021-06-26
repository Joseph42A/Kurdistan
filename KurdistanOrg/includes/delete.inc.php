<?php

require_once 'dbh.inc.php';
require_once 'function.inc.php';

if(isset($_POST['delete-admin'])){
    $adminName = $_POST['adminName'];
    $adminEmail = $_POST['adminEmail'];
    $adminOrder = $_POST['order-admin'];

    // Securing the datas
    $adminName = mysqli_real_escape_string($conn, $adminName);
    $adminEmail = mysqli_real_escape_string($conn, $adminEmail);

    // Handle some errors
    if(isEmpty($adminName) || isEmpty($adminEmail)){
        header('Location: ../setting.php?error=emptyadminfields');
        exit();
    }
     // Admin Type not seleceted
            if($adminOrder == 0){
                header('Location: ../setting.php?error=adminType');
                exit();
    }

        // Validation for arabic and Enlgish preventing #@$%! these things
        if(!preg_match("~^[a-z0-9\-'\s\p{Arabic}]{1,60}$~iu", $adminName)){
            header("Location:../setting.php?error=invaliduid ");
            exit();
        }
        // // Email Validaion
        if(!filter_var($adminEmail, FILTER_VALIDATE_EMAIL)){
            header("Location:../setting.php?error=invalidemail" );
            exit();
        }

        $adminTable = '';
      
        if($adminOrder == 2){
            $adminTable = 'primaryadmins';
        }
        if($adminOrder == 3){
            $adminTable = 'secondaryadmins';
        }

        
        // check if the uid is exist befor if it is do not create a new one
        if(uidExist($conn, $adminName, $adminEmail, $adminTable) == false){ 
            header("Location:../setting.php?error=uidnotexist" );
            exit();
        }
 
        // Delete the admin
        deleteAdmin($conn, $adminName, $adminEmail, $adminTable);
}
