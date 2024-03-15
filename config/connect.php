<?php 
    define('DB_SERVER','localhost');
    define('DB_USER','root');
    define('DB_PWD','science428');
    define('DB_NAME','swap');


    $conn = mysqli_connect(DB_SERVER,DB_USER,DB_PWD,DB_NAME);
    if(!$conn){
        echo "Connection to database failed".mysqli_connect_error();
    }
?>