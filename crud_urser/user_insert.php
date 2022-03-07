<?php 

        session_start();
        require_once "../config/dbconfig.php";

        if (isset($_POST['userinsert'])) {

                $username = $_POST['username'];
                $password = $_POST['password'];
                $c_password = $_POST['c_password'];
                $role = 'member'; //ກໍານົດ Default ໃຫ້ຄົນສະມັກໃໝ່ເປັນ member ທໍາມະດາ
                $photo = 'profile_default.png';

                if (empty($username)) {

                        $_SESSION['error'] = 'ກະລຸນາຕື່ມຊື່ຜູ້ໃຊ້';
                        header("location: user_list.php");

                } else if (empty($password)) {

                        $_SESSION['error'] = 'ກະລຸນາຕື່ມລະຫັດຜ່ານ';
                        header("location: user_list.php");

                } else if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 4) {

                        //ฟังก์ชั่น strlen() ใช้นับจำนวนตัวอักษร นับตัวอักษรในข้อความ ด้วย PHP
                        $_SESSION['error'] = 'ລະຫັດຜ່ານຕ້ອງມີຄວາມຍາວແຕ່ 4 ຮອດ 20 ຕົວອັກສອນ';
                        header("location: user_list.php");

                } else if (empty($c_password)) {

                        $_SESSION['error'] = 'ກະລຸນາຢືນຍັນລະຫັດຜ່ານ';
                        header("location: user_list.php");

                } else if ($password != $c_password) { //ກວດວ່າລະຫັດສອງຊ່ອງທີ່ປ້ອນໃສ່ ຄືກັນຫຼືບໍ່

                        $_SESSION['error'] = 'ລະຫັດຜ່ານບໍ່ກົງກັນ';
                        header("location: user_list.php");

                } else {

                        try {

                                // ກວດວ່າອີເມວທີ່ສະມັກມາ ມີແລ້ວຫຼືບໍ່
                                $check_username = $conn->prepare("SELECT username FROM users WHERE username = :username");
                                $check_username->bindParam(":username", $username); // $username ສົ່ງຄ່າໄປເກັບໄວ້ :username
                                $check_username->execute();
                                $row = $check_username->fetch(PDO::FETCH_ASSOC);
                
                                if ($row['username'] == $username) {
                
                                    $_SESSION['warning'] = "ຊື່ຜູ້ໃຊ້ນີ້ມີຢູ່ໃນລະບົບແລ້ວ <a href='signin.php'>ກົດບ່ອນນີ້</a> ເພື່ອເຂົ້າສູ່ລະບົບ";
                                    header("location: user_list.php");
                
                                } else if (!isset($_SESSION['error'])) {
                
                                    $passwordHash = password_hash($password, PASSWORD_DEFAULT); 
                                    //password_hash ແມ່ນເຂົ້າລະຫັດ (PASSWORD_DEFAULT ແມ່ນ Algorithm ການເຂົ້າລະຫັດແບບພື້ນຖານ)
                                    $stmt = $conn->prepare("INSERT INTO users(username, password, role, photo) 
                                                            VALUES(:username, :password, :role, :photo)");

                                    $stmt->bindParam(":username", $username); // $username ສົ່ງຄ່າໄປເກັບໄວ້ :username
                                    $stmt->bindParam(":password", $passwordHash); // $password ສົ່ງຄ່າໄປເກັບໄວ້ :passwordHash
                                    $stmt->bindParam(":role", $role); // $role ສົ່ງຄ່າໄປເກັບໄວ້ :role
                                    $stmt->bindParam(":photo", $photo); // $photo ສົ່ງຄ່າໄປເກັບໄວ້ :photo
                                    
                                    $stmt->execute();
                                    
                                    $_SESSION['success'] = "ສະມັກສະມາຊິກສໍາເລັດ! <a href='signin.php' class='alert-link'>ກົດບ່ອນນີ້</a> ເພື່ອເຂົ້າສູ່ລະບົບ";
                                    header("location: user_list.php");
                
                                } else {
                
                                    $_SESSION['error'] = "ມີບາງຢ່າງຜິດພາດ";
                                    header("location: user_list.php");
                
                                }
                
                        } catch (PDOException $e) { //PDOException ດັກຈັບ Error ແລະເກັບໃນ $e
        
                                echo $e->getMessage();
        
                        }
                }
                        
        }
           


?>