<?php
    require_once '../../helper/db.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $namaWisata = $_POST['nama_wisata'];
        $lokasiWisata = $_POST['lokasi_wisata'];
        $hargaWisata = $_POST['harga_wisata'];
        $latitude = $_POST['latitude'];
        $longtitude = $_POST['longtitude'];

        $db = new Database();

        $db->insertDestination($namaWisata, $lokasiWisata, $hargaWisata, $latitude, $longtitude);

    }

?>