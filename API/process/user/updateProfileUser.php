<?php
    require_once '../../helper/db.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $idUser = $_POST['id_user'];
        $password = $_POST['password'];
        $nama = $_POST['nama'];
        $usia = $_POST['usia'];
        $jenisKelamin = $_POST['jenis_kelamin'];
        $password = password_hash($password, PASSWORD_DEFAULT);

        $db = new Database();

        $db->updateProfileUser($idUser, $password, $nama, $usia, $jenisKelamin);
    }
?>