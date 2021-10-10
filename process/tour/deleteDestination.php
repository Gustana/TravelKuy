<?php
    require_once '../../helper/db.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $idWisata = $_POST['id_wisata'];

        $db = new Database();

        $db->deleteDestination($idWisata);

    }

?>