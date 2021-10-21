<?php
    require_once '../../helper/db.php';

    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        $idDestination = $_GET['id_destination'];

        $db = new Database();

        $db->getDestinationDetail($idDestination);
    }
?>