<?php   
    session_start();
    include('connect.php');

    function redirect($url, $message) {
        $_SESSION['status'] =$message;
        header("Location: $url");
        exit();
    }
    function showMessage(){
        if(isset($_SESSION['status'])){
            echo "<h5 style='text-align: center;
            color:crimson; font-size:1.4rem;'>".$_SESSION['status'].";</h5>";
            unset($_SESSION['status']);
        }
    }
    function validateInput($input){
        global $conn;
        $input = mysqli_real_escape_string($conn, $input);
        return trim($input);
    }
    function insertRecord($table, $data){
        global $conn;
        $table = validateInput($table);
        $columns = array_keys($data);
        $values = array_values($data);

        $finalColumns = implode(', ', $columns);
        $finalValues = "'". implode("', '", $values)."'";
        $sql = "INSERT INTO $table ($finalColumns) VALUES ($finalValues)";
        $query = mysqli_query($conn, $sql);
        return $query;
    }
    function fetchAll($table, $myId){
        global $conn;
        $table = validateInput($table);
        $myId = validateInput($myId);

        $sql = "SELECT * FROM $table WHERE id != '$myId'";
        $query = mysqli_query($conn, $sql);
        return $query;
    }