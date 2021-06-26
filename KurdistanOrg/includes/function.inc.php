<?php

// All the functions is here
function isEmpty($uid)
{
    if (!empty($uid)) {
        return false;
    } else {
        return true;
    }
}

function pwdSmallLength($pwd)
{
    if (!(strlen($pwd) < 8)) {
        return false;
    } else {
        return true;
    }
}

function uidExist($conn, $username, $email, $tableName)
{
    // sql statement       (?mark => is a place holder, we add data in future for security resion)
    $sql = "SELECT * FROM $tableName WHERE username = ? OR email = ?; ";
    // Now create the prepare statement
    $stmt = mysqli_stmt_init($conn);
    // Check if the sql is prepare with our orignial sql (like htmlSpecialChars)
    // If no error this return true
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        // if the qsl not proper send it back
        return false;
    }

    // pass the data from the user to the db using bind_param(prepare stmt, datatype, variabeles)
    mysqli_stmt_bind_param($stmt, 'ss', $username, $email);
    // finaly excute the data (apply the sql)
    mysqli_stmt_execute($stmt);


    // Get the result 
    $resultData = mysqli_stmt_get_result($stmt);

    // check if already this sql(this user) is already exist
    // and also asing that data with an associative array for php and store in the $row and return as this array
    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row; // then we can use this row to access that specific row ex: $row['name']
    } else {
        $result = false;
        return $result; // means the username is not exist in the database 
    }
    // close stmt prere statement
    mysqli_stmt_close($stmt);
}

// This is not working!
function password_is_hash($password)
{
    $nfo = password_get_info($password);
    return $nfo['algo'] != 0;
}

function loginUser($conn, $username, $pwd, $admintable)
{
    // check if the user is exist inside the db
    $uidExist = uidExist($conn, $username, $username, $admintable); // no differece of we pass the username twice

    // If the user not exist go back to login.php dude
    if ($uidExist == false) {
        header("Location: ../login.php?error=usernotexist");
        exit(); // because we didn't use else if
    }
    $checkedPwd = '';
    // if it is not hashed just returned
    // But we will be using hashed pwd for creating new admins
    if($admintable == 'mainadmins'){
        $pwdhashed = $uidExist['password']; // it is an associative array as like I showed you $row['name']
        $checkedPwd = $pwd == $pwdhashed ? true : false; // if they are the same it return true, otherwise false
    }else{
       
        // get the hashed pwd form db
        $pwdhashed = $uidExist['password'];
        $checkedPwd = password_verify($pwd, $pwdhashed);
    }
  

    if ($checkedPwd == false) {
        //send him back
      
        header("Location: ../login.php?error=wrongpwd");
        exit();
    } else {
        // login here use SESSION;
        session_start();
        $_SESSION['userid'] = $uidExist['id'];
        $_SESSION['useruid'] = $uidExist['username'];
        $_SESSION['adminaccessebility'] = $uidExist['adminnum'];
        // now he logged in
        header("Location: ../home.php?info=loginsuccess");
        exit();
    }
}

function createAdmin($conn, $adminName, $adminEmail, $pwd, $tableName, $adminOrder, $created_by){

    $sql = "INSERT INTO $tableName (username, email, password, adminnum, created_by) VALUES (?, ?, ?, ?, ?)";
    // Now create the prepare statement
    $stmt = mysqli_stmt_init($conn);
    // Check if the sql is prepare with our orignial sql (like htmlSpecialChars)
    if(!mysqli_stmt_prepare($stmt, $sql)){
        // if the qsl not proper send it back
        header('Location: ../setting.php?error=stmtfail');
        exit();// exist here
    }
    
    // secure password using hashed
    $hashPwd = password_hash($pwd, PASSWORD_DEFAULT);

    // pass the data from the user to the db using bind_param(prepare stmt, datatype, variabeles)
    mysqli_stmt_bind_param($stmt, 'sssis', $adminName, $adminEmail, $hashPwd, $adminOrder, $created_by);// insert the datas here
    // finaly excute the data (apply the sql)
    mysqli_stmt_execute($stmt);
    // close stmt prere statement
    mysqli_stmt_close($stmt);

    // send the user back to the signup page with signup message 
    header('Location: ../setting.php?info=admincreatedsuccessfully');
}

function deleteAdmin($conn, $adminName, $adminEmail, $admintable){
    $sql = "DELETE FROM $admintable WHERE username = ? AND email = ?";
    // Now create the prepare statement
    $stmt = mysqli_stmt_init($conn);
    // Check if the sql is prepare with our orignial sql (like htmlSpecialChars)
    if(!mysqli_stmt_prepare($stmt, $sql)){
        // if the qsl not proper send it back
        header('Location: ../setting.php?error=stmtfail');
        exit();// exist here
    }
    // pass the data from the user to the db using bind_param(prepare stmt, datatype, variabeles)
    mysqli_stmt_bind_param($stmt, 'ss', $adminName, $adminEmail );// insert the datas here
    // finaly excute the data (apply the sql)
    mysqli_stmt_execute($stmt);
    // close stmt prere statement
    mysqli_stmt_close($stmt);
    // send the user back to the signup page with signup message 
    header('Location: ../setting.php?info=admindeletedsuccessfuly');
}
function createPost($conn, $title, $content, $author, $order, $filename, $state)
{
    $screen = '';
    // let checkk if the post is aini, komalyati yan zansti
    // First if 1 -> aini
    if ($order == 1) {
        $screen = 'aini';
    } else if ($order == 2) {
        $screen = 'komalayati';
    } else if ($order == 3) {
        $screen = 'zansti';
    }

    echo $screen;
    $sql = "INSERT INTO $screen (title, content, filename, created_by, state) VALUES (?,?,?,?,?);";
    // stmt initialization
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location:../setting.php?error=stmtfail&content=" . $content . "&title=" . $title . "&author=" . $author);
        exit();
    }
    mysqli_stmt_bind_param($stmt, 'ssssi', $title, $content, $filename, $author, $state);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
    // go into aini
    header("Location:../" . $screen . ".php?info=postcreatedsuccefuly");
}

function updatePost($conn, $title, $content, $id)
{
    $sql = "UPDATE zansti SET title='$title', content='$content' WHERE id=$id";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location:../edit.php?error=stmtfail&content=" . $content . "&title=" . $title);
        exit();
    }
    mysqli_stmt_bind_param($stmt, 'ssssi', $title, $content, $filename, $author, $state);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
    // go into aini
    $screen = 'zansti';
    header("Location:../" . $screen . ".php?edit=success");
}

function getRows($condition){
    global $conn;
    $query = mysqli_query($conn, "SELECT * FROM $condition");
    return mysqli_num_rows($query);
}