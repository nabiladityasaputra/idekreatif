<?php
require_once("../config.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "post"){
    $username = $_POST ["username"];
    $name = $_POST ["name"];
    $password = $_POST ["password"];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $Sql = "INSERT INTO users (username, name, password)
    VALUES ('$username', '$name', '$$hashedPassword')";
    if ($conn->query($sql)=== TRUE){
        $_SESSION['notification']=[
            'type' => 'primary',
            'message' => 'Registrasi Berhasil!'
        ];
    } else{
        $_SESSION['notification'] = [
            'type' => 'danger',
            'message' => 'Gagal Regristrasi: '.mysqli_error($conn) 
        ];

    }
    header('Location: login.php');
    exit();
}
$conn->close();
?>