<?php
 
// handle all the require things for login 
if (isset($_POST['submit-login'])) {

    // Conditions for error hadnling
    require_once 'dbh.inc.php';
    require_once 'function.inc.php';

    // get the datas and process
    $uid = $_POST['username']; // it maybe username or email
    $pwd = $_POST['pwd'];
    $adminOrder = $_POST['order-admin'];

    // Get ride for all extra things to secure the db
    $uid = mysqli_real_escape_string($conn,$uid);
    $pwd = mysqli_real_escape_string($conn, $pwd);

    // if it is empty
    if (isEmpty($uid) || isEmpty($pwd)) {
        header('Location: ../login.php?error=empty');
        exit();
    }
    // if pwd's length is smaller than 8
    if (pwdSmallLength($pwd)) {
        header('Location: ../login.php?error=pwdsmalllength');
        exit();
    }
    // Admin Type not seleceted
    if($adminOrder == 0){
        header('Location: ../login.php?error=adminType');
        exit();
    }

    // Set the table name to by dynamicaly selected
    $adminTable = '';
    if($adminOrder == 1){
       $adminTable = 'mainadmins';
    }
    if($adminOrder == 2){
        $adminTable = 'primaryadmins';
    }
    if($adminOrder == 3){
        $adminTable = 'secondaryadmins';
    }
  
    // go and check if this user name is exist in our database
    loginUser($conn, $uid, $pwd, $adminTable);
} else {
    header("location: login.php");
    exit();
}
