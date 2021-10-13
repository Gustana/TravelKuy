<?php
    require_once '../../helper/db.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $idUser = $_POST['id_user'];
        $tanggal = $_POST['tanggal'];
        $jumlahTiket = $_POST['jumlah_tiket'];
        $idWisata = $_POST['id_wisata'];

        //* get harga from text
        $hargaTiket = $_POST['harga'];

        $db = new Database();

        $db->buyTicket($idUser, $tanggal, $jumlahTiket, $idWisata, $hargaTiket);
    }


?>