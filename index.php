<?php 

    session_start(); //start session

    require_once 'config/dbconfig.php'; //connect database

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

    <header>
        <nav class="navbar navbar-light" style="background-color: #0a1936;">
            <div class="container d-flex justify-content-center">
                <a class="navbar-brand" href="index.php">
                    <h4 class="text-white fw-bold">FINAL TEST PHP</h4>
                </a>
            </div>
        </nav>
    </header>

    <div class="container">
        <h3 class="mt-4">ສະມັກສະມາຊິກ</h3>
        <hr>
        <form action="signup_db.php" method="post">
            <!-- ການກວດວ່າ error ເກີດຂື້ນໂຕໃດ -->
            <?php if(isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php 
                        echo $_SESSION['error'];
                        unset($_SESSION['error']); //ລົບ session ທີ່ສະແດງອອກມາ ຫຼັງຈາກກົດ refresh
                    ?>
                </div>
            <?php } ?>
            <?php if(isset($_SESSION['success'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?php 
                        echo $_SESSION['success'];
                        unset($_SESSION['success']); //ລົບ session ທີ່ສະແດງອອກມາ ຫຼັງຈາກກົດ refresh
                    ?>
                </div>
            <?php } ?>
            <?php if(isset($_SESSION['warning'])) { ?>
                <div class="alert alert-warning" role="alert">
                    <?php 
                        echo $_SESSION['warning'];
                        unset($_SESSION['warning']); //ລົບ session ທີ່ສະແດງອອກມາ ຫຼັງຈາກກົດ refresh
                    ?>
                </div>
            <?php } ?>

            <div class="mb-3">
                <label for="username" class="form-label">ຊື່ຜູ້ໃຊ້ງານ</label>
                <input type="text" class="form-control" name="username" aria-describedby="username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">ລະຫັດຜ່ານ</label>
                <input type="password" class="form-control" name="password">
            </div>
            <div class="mb-3">
                <label for="confirm password" class="form-label">ຢືນຍັນລະຫັດຜ່ານ</label>
                <input type="password" class="form-control" name="c_password">
            </div>
            <button type="submit" name="signup" class="btn btn-primary">ສະມັກສະມາຊິກ</button>
        </form>
        <hr>
        <p>ເປັນສະມາຊິກແລ້ວແມ່ນບໍ່ ກົດບ່ອນນີ້ເພື່ອ <a class="fw-bold" href="signin.php">ເຂົ້າສູ່ລະບົບ</a></p>
    </div>
    
</body>
</html>