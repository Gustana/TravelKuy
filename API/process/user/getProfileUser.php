<?php
    require_once '../../helper/db.php';

    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        $idUser = $_GET['id_user'];

        $db = new Database();
        
        $db->getProfileUser($idUser);
    }

?>