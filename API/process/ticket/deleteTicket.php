<?php
    require_once '../../helper/db.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $idTicket = $_POST['id_tiket'];

        $db = new Database();

        $db->deleteTicket($idTicket);
    }
?>