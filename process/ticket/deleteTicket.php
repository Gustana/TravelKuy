<?php
    require_once '../../helper/db.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $idTicket = $_POST['idTicket'];

        $db = new Database();

        $db->deleteTicket($idTicket);
    }
?>