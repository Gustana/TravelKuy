<?php
    require_once '../../helper/db.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $idTicket = $_POST['id_tiket'];
        $tanggal = $_POST['tanggal'];

        $db = new Database();

        $db->updateTicket($idTicket, $tanggal);
    }
?>