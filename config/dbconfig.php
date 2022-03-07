<?php
    //database Config
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "final_test";

    try { //dbname : final_test

        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connected successfully";

    } catch(PDOException $e) { //PDOException ດັກຈັບ Error ແລະເກັບໃນ $e

        echo "Connection failed: " . $e->getMessage(); //show message error

    }
?>