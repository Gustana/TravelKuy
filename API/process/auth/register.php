<?php
    require_once '../../helper/db.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $db = new Database();

        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $nama = $_POST['nama'];
        $usia = $_POST['usia'];
        $jenisKelamin = $_POST['jenis_kelamin'];

        $db->registerUser($email, $pass, $nama, $usia, $jenisKelamin);
        
    }

?>