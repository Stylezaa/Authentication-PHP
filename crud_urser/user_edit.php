<?php 

    session_start();

    require_once '../config/dbconfig.php';

    if (!isset($_SESSION['admin_login'])) {
        $_SESSION['error'] = 'ກະລຸນາເຂົ້າສູ່ລະບົບ!';
        header('location: signin.php');
    }

    if (isset($_POST['update'])) {
        
        $id = $_POST['id'];
        $username = $_POST['username'];
        $role = $_POST['role'];

        $stmt = $conn->prepare("UPDATE users SET username = :username, role = :role WHERE id = :id");

        $stmt->bindParam(":id", $id); // $id ສົ່ງຄ່າໄປເກັບໄວ້ :id
        $stmt->bindParam(":username", $username); // $username ສົ່ງຄ່າໄປເກັບໄວ້ :username
        $stmt->bindParam(":role", $role); // $role ສົ່ງຄ່າໄປເກັບໄວ້ :role
        $stmt->execute();

        if ($stmt) {
            $_SESSION['success'] = "ແກ້ໄຂຜູ້ໃຊ້ງານສໍາເລັດ";
            header("location: user_list.php");
        } else {
            $_SESSION['error'] = "ແກ້ໄຂຜູ້ໃຊ້ງານບໍ່ສໍາເລັດ";
            header("location: user_list.php");
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

    <header>
        <nav class="navbar navbar-light" style="background-color: #0a1936;">
            <div class="container d-flex justify-content-center">
                <a class="navbar-brand" href="../admin.php">
                    <h4 class="text-white fw-bold">FINAL TEST PHP</h4>
                </a>
            </div>
        </nav>
    </header>

    <div class="container">

        <?php 

                if (isset($_SESSION['admin_login'])) {

                        $admin_id = $_SESSION['admin_login']; // admin_login = id

                        $stmt = $conn->query("SELECT * FROM users WHERE id = $admin_id");

                        $stmt->execute(); // For Query command

                        $row = $stmt->fetch(PDO::FETCH_ASSOC); // ເກັບຄ່າທີ່ Query ມາ ໄປເກັບໄວ້ໃນ $row

                }
        ?>

        <div class="row my-4">
            <div class="col-8">
                <h3>ສະບາຍດີ, ທ່ານ <?php echo $row['username'] ?></h3>
            </div>
            <div class="col-4 d-flex justify-content-end">
                <a href="user_list.php" class="btn btn-primary mx-5 ">ຈັດການຜູ້ໃຊ້ງານ</a>
                <a href="../logout.php" class="btn btn-danger">ອອກຈາກລະບົບ</a>
            </div>
        </div>

        <hr>

        <div class="row">
                <div class="col-12">

                        <h1>Edit Data</h1>
                        <hr>

                        <form action="user_edit.php" method="post" enctype="multipart/form-data">

                                <?php
                                        if (isset($_GET['id'])) {
                                                $id = $_GET['id'];
                                                $stmt = $conn->query("SELECT * FROM users WHERE id = $id");
                                                $stmt->execute();
                                                $data = $stmt->fetch();
                                        }
                                ?>

                                <div class="mb-3">

                                        <label for="id" class="col-form-label">ID:</label>
                                        <input type="text" readonly value="<?php echo $data['id']; ?>" required class="form-control" name="id" >

                                        <label for="username" class="col-form-label">Username:</label>
                                        <input type="text" value="<?php echo $data['username']; ?>" required class="form-control" name="username" >

                                </div>

                                <div class="mb-3">

                                        <label for="role" class="col-form-label">Role:</label>
                                        <input type="text" value="<?php echo $data['role']; ?>" required class="form-control" name="role">

                                </div>

                                <hr>
                                <a href="user_list.php" class="btn btn-secondary">ຍົກເລິກ</a>
                                <button type="submit" name="update" class="btn btn-primary">ແກ້ໄຂຜູ້ໃຊງານ</button>
                        </form>
                </div>
        </div>
            
    </div>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>