<?php 

    session_start(); //start session

    require_once 'config/dbconfig.php'; //connect database

    if (!isset($_SESSION['admin_login'])) { // ຖ້າບໍ່ມີ user_login (ຈະສົ່ງ $row['id']) ຈະບໍ່ສະແດງໜ້ານີ້

        $_SESSION['error'] = 'ກະລຸນາເຂົ້າສູ່ລະບົບ!';
        header('location: signin.php');

    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <header>
        <nav class="navbar navbar-light" style="background-color: #0a1936;">
            <div class="container d-flex justify-content-center">
                <a class="navbar-brand" href="admin.php">
                    <h4 class="text-white fw-bold">FINAL TEST PHP</h4>
                </a>
            </div>
        </nav>
    </header>

    <div class="container">
        <?php 

            if (isset($_SESSION['admin_login'])) { // user_login (ຈະສົ່ງ $row['id'])

                $admin_id = $_SESSION['admin_login'];

                $stmt = $conn->query("SELECT * FROM users WHERE id = $admin_id");

                $stmt->execute();

                $row = $stmt->fetch(PDO::FETCH_ASSOC);

            }
        ?>
        <div class="row my-4">
            <div class="col-8">
                <h3>ສະບາຍດີ, ຜູ້ດູແລ <?php echo $row['username'] ?></h3>
            </div>
            <div class="col-4 d-flex justify-content-end">
                <a href="./crud_urser/user_list.php" class="btn btn-primary mx-5 ">ຈັດການຜູ້ໃຊ້ງານ</a>
                <a href="logout.php" class="btn btn-danger">ອອກຈາກລະບົບ</a>
            </div>
        </div>

        <hr>

    </div>

    <div class="container">

        <div class="row my-5">
            <div class="col-12 d-flex justify-content-center">
                <div class="img_sec mx-5">

                    <?php if ($row['photo'] == "profile_default.png") { ?>

                        <img src="uploads/<?= $row['photo'] ?>" alt="Profile" class="rounded-circle" width="120" height="120">

                    <?php } else { ?>

                        <img src="<?= $row['photo'] ?>" alt="Profile" class="rounded-circle" width="120" height="120">
                        
                    <?php } ?>

                </div>    
                <div class="detail_user">
                    <?php
                        echo "<form action=\"upload.php?id=$admin_id\" method=\"post\" enctype=\"multipart/form-data\">";
                        ?>
                            ເລືອກຮູບພາບ: 
                            
                            </br></br><input type="file" name="fileToUpload" id="fileToUpload">
                            <input type="submit"  class="btn btn-success" value="ປ່ຽນຮູບປະຈໍາໂຕ" name="submit">
                    </form>
                </div>      
            </div>
        </div>

        <div class="row my-5">
            <div class="col-12 d-flex justify-content-center">
                <table>
                    <tr>
                        <td><h5>ຊື່ຜູ້ໃຊ້ງານ:</h5></td>
                        <td><h5><?= $row['username'] ?></h5></td>
                    </tr>
                    <tr>
                        <td><h5>ຕໍາແໜ່ງ:</h5></td>
                        <td><h5><?= $row['role'] ?></h5></td>
                    </tr>
                    <tr>
                        <td><h5>ສະມັກສະມາຊິກເມື່ອ:</h5></td>
                        <td><h5><?= $row['create_date'] ?></h5></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

</body>
</html>