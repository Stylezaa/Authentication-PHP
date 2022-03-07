<?php 

    session_start(); //start session

    unset($_SESSION['user_login']); //ລົບ session user_login

    unset($_SESSION['admin_login']); //ລົບ session admin_login

    header('location: signin.php'); //ກັບໄປໜ້າເຂົ້າສູ່ລະບົບ

?>