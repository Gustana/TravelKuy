<?php
    require_once '../../helper/db.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $idUser = $_POST['id_user'];

        $db = new Database();

        $db->getTicketUser($idUser);
    }

?>