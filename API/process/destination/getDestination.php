<?php
    require_once '../../helper/db.php';

    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        $db = new Database();

        $db->getDestination();
        
    }
?>