<?php 

    session_start(); //start session

    require_once 'config/dbconfig.php'; //connect database

    if (isset($_POST['signin'])) { //ຮັບຄ່າເຂົ້າມາຈາກ Form ຊຶ່ signin signin.php

        $username = $_POST['username'];
        $password = $_POST['password'];
      
        if (empty($username)) {

            $_SESSION['error'] = 'ກະລຸນາຕື່ມຊື່ຜູ້ໃຊ້';
            header("location: signin.php");

        } else if (empty($password)) {

            $_SESSION['error'] = 'ກະລຸນາຕື່ມລະຫັດຜ່ານ';
            header("location: signin.php");

        } else if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 4) {

            //function strlen() ໃຊ້ນັບຈໍານວນຕົວອັກສອນໃນ PHP
            $_SESSION['error'] = 'ລະຫັດຜ່ານຕ້ອງມີຄວາມຍາວແຕ່ 4 ຮອດ 20 ຕົວອັກສອນ';
            header("location: signin.php");

        } else {
            try {

                $check_data = $conn->prepare("SELECT * FROM users WHERE username = :username");

                $check_data->bindParam(":username", $username); // // $username ສົ່ງຄ່າໄປເກັບໄວ້ :username

                $check_data->execute();

                $row = $check_data->fetch(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC: ຈະ return array indexed ຂອງຊື່ Column

                if ($check_data->rowCount() > 0) {  //ຖ້າຖານຂໍ້ມູນ (check_data) ມີຫຼາຍກວ່າສູນ ແມ່ນສະແດງວ່າມີຂໍມູນ

                    if ($username == $row['username']) {  //$username ແມ່ນ ອີເມວທີ່ເຮົາສົ່ງມາທາງ form signin.php

                        // $hashed_pw = $row['password'];

                        if (password_verify($password, $row['password'])) { 
                            //password_verify ເປັນ function ໃນການກວດສອບວ່າລະຫັດທີ່ສົ່ງມາຜ່ານ form ຄືກັນກັບ ລະຫັດໃນຖານຂໍ້ມູນລະຫວາ

                            if ($row['role'] == 'admin') { //ຖ້າ role ເປັນ admin

                                $_SESSION['admin_login'] = $row['id'];
                                header("location: admin.php");

                            } else {  //ຖ້າ role ເປັນ user

                                $_SESSION['user_login'] = $row['id']; 
                                header("location: user.php");

                            }

                        } else {

                            $_SESSION['error'] = 'ລະຫັດຜ່ານຜິດ';
                            header("location: signin.php");

                        }
                    } else {

                        $_SESSION['error'] = 'ຊື່ຜູ້ໃຊ້ຜິດ';
                        header("location: signin.php");

                    }
                } else {

                    $_SESSION['error'] = "ບໍ່ມີຂໍ້ມູນຢູ່ໃນລະບົບ";
                    header("location: signin.php");

                }

            } catch (PDOException $e) { //PDOException ດັກຈັບ Error ແລະເກັບໃນ $e

                echo $e->getMessage(); //getMessage ແມ່ນການສະແດງ

            }
        }
    }


?>