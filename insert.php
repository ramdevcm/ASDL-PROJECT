<?php
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$username = $_POST['username'];
$phone = $_POST['phone'];
$password = $_POST['password'];


//checking for empty
if (!empty($username) || !empty($password) || !empty($fullname) || !empty($email) || !empty($phone) ) 
{
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "asdl";
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) 
    {
        die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } 
    else{
        $SELECT = "SELECT username from register WHERE username = ? LIMIT 1";
        $INSERT = "INSERT Into register(full_name, email, username, phone, password) values(?, ?, ?, ?, ?)";
        //Prepare statement
        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->store_result();
        $stmt->store_result();
        $stmt->fetch();
        $rnum = $stmt->num_rows;
        if ($rnum==0) {
        $stmt->close();
        $stmt = $conn->prepare($INSERT);
        $stmt->bind_param("sssis",$fullname, $email, $username, $phone, $password);
        $stmt->execute();
        echo "New record inserted sucessfully";
 
        } else {
        echo "Someone already register using this email";
        }
        $stmt->close();
        $conn->close();
        }
        } else {
        echo "All field are required";
        die();
}

?>