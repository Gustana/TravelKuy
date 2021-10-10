<?php
    require_once '../../helper/db.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $db = new Database();

        $email = $_POST['email'];
        $password = $_POST['pass'];

        $db->login($email, $password);
        
    }

?>