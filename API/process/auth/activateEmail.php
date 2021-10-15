<?php
    require_once '../../helper/db.php';

    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        $email = $_GET['email'];

        $db = new Database();

        $db->activateEmail($email);
    }
?>