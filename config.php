<?php

//konfigurasi koneksi database
$host = "localhost";//nama host server database
$username = "root";//username untuk akses ke database
$pasword ="";//paswor untuk akses ke databse
$database = "idekreatif";//nama database yg digunakan

// membuat koneksi ke database mengguanakan databse mysqli
$conn = mysqli_connect($host,$username,$password,$database);

// mengecek apakah koneksi berhasil
if ($conn->connect_eror){
    //menampilkan pesan eror jika koneksi gagal
    die ("database gagal terkoneksi: ". $conn->connect_eror);

    //jika koneksi berhasil script akan jalan tanpa pesan eror

}
?>