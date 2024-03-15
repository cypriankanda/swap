<?php
    session_start();
    include 'config/fun.php';

    if(isset($_SESSION['auth'])){
        unset($_SESSION['auth']);
        unset($_SESSION['id']);
        unset($_SESSION['user']);
        session_destroy();

        redirect('index.php', 'Logged out successfully');
    }