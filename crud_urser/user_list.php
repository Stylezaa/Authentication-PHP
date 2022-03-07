<?php 

    session_start();

    require_once '../config/dbconfig.php';

    if (!isset($_SESSION['admin_login'])) {
        $_SESSION['error'] = 'ກະລຸນາເຂົ້າສູ່ລະບົບ!';
        header('location: signin.php');
    }

    if (isset($_GET['delete'])) {
        $delete_id = $_GET['delete'];
        $deletestmt = $conn->query("DELETE FROM users WHERE id = $delete_id");
        $deletestmt->execute();

        if ($deletestmt) {
            echo "<script>alert('ລົບຜູ້ໃຊ້ງານສໍາເລັດ');</script>";
            $_SESSION['success'] = "ລົບຜູ້ໃຊ້ງານສໍາເລັດ";
            header("refresh:1; url=user_list.php");
        }
        
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

        <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                        <div class="modal-content">

                                <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                        <form action="./user_insert.php" method="post" enctype="multipart/form-data">

                                                <div class="mb-3">
                                                        <label for="username" class="col-form-label">ຊື່ຜູ້ໃຊ້ງານ:</label>
                                                        <input type="text" required class="form-control" name="username">
                                                </div>

                                                <div class="mb-3">
                                                        <label for="password" class="col-form-label">ລະຫັດຜ່ານ:</label>
                                                        <input type="password" required class="form-control" name="password">
                                                </div>

                                                <div class="mb-3">
                                                        <label for="c_password" class="col-form-label">ຢືນຍັນລະຫັດຜ່ານ:</label>
                                                        <input type="password" required class="form-control" name="c_password">
                                                </div>

                                                <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ປິດ</button>
                                                        <button type="submit" name="userinsert" class="btn btn-success">ເພີ່ມຜູ້ໃໍຊ້ງານ</button>
                                                </div>
                                                
                                        </form>
                                </div>
                        
                        </div>
                </div>
        </div>

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
                <a href="user_list.php" class="btn btn-primary mx-5 ">ຈັດການຜູ້ໃຊ້ງານ</a>
                <a href="../logout.php" class="btn btn-danger">ອອກຈາກລະບົບ</a>
            </div>
        </div>

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

        <hr>

        <div class="row">
            <div class="col-md-6">
                <h5 class="fw-bold">ສະມາຊິກທັງໝົດ</h5>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#userModal" data-bs-whatever="@mdo">ເພີ່ມຜູ້ໃໍຊ້ງານ</button>
            </div>
        </div>

        <table class="table">
                <thead>
                        <tr>
                                <th scope="col">ID</th>
                                <th scope="col">ຊື່ຜູ້ໃຊ້ງານ</th>
                                <th scope="col">ຕໍາແໜ່ງ</th>
                                <th scope="col">ສະມັກສະມາຊິກເມື່ອ</th>
                                <th scope="col">Action</th>
                        </tr>
                </thead>
                <tbody>

                        <?php 

                                if (isset($_SESSION['admin_login'])) {

                                        $admin_id = $_SESSION['admin_login'];

                                        $stmt = $conn->query("SELECT * FROM users");

                                        $stmt->execute();

                                        $row = $stmt->fetchAll();

                                }

                                if (!$row) {
                                        echo "<p><td colspan='6' class='text-center'>No data available</td></p>";
                                } else {
                                foreach($row as $user)  {  
                                ?>

                                <tr>
                                        <th scope="row"><?php echo $user['id']; ?></th>
                                        <td><?php echo $user['username']; ?></td>
                                        <td><?php echo $user['role']; ?></td>
                                        <td><?php echo $user['create_date']; ?></td>
                                        <td>
                                                <a href="user_edit.php?id=<?php echo $user['id']; ?>" class="btn btn-warning">ແກ້ໄຂ</a>
                                                <a onclick="return confirm('ທ່ານແນ່ໃຈບໍ່ວ່າຈະລົບຜູ້ໃຊ້ງານ ?');" href="?delete=<?php echo $user['id']; ?>" class="btn btn-danger">ລົບ</a>
                                        </td>
                                </tr>

                        <?php }  } ?>
                </tbody>
        </table>
    </div>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>