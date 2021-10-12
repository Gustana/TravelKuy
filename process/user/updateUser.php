<?php
    require_once '../../helper/db.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $idUser = $_POST['idUser'];
        $password = $_POST['password'];
        $nama = $_POST['nama'];
        $usia = $_POST['usia'];
        $jenisKelamin = $_POST['jenis_kelamin'];

        $db = new Database();

        $db->updateUser($idUser, $password, $nama, $usia, $jenisKelamin);
    }
?>