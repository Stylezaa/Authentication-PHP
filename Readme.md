<!-- ================================================================ -->
<!-- ============= PDO Learn ================= -->
<!-- ================================================================ -->

<!--
        1. PDO::prepare()เป็น method ในการเตรียมคำสั่งที่จะใช้ประมวลผล และจะส่งค่ากลับ (return) เป็น Object PDOStatement

        2. PDOStatement::fetch() เป็น method ในการดึงข้อมูลของแถวในฐานข้อมูล โดยมีรูปแบบดังนี้

        3. PDO::FETCH_ASSOC: จะรีเทิร์นเป็น array indexed ของชื่อคอลัมน์

        3.1 Prepared statement
        การคิวรี่ด้วย Prepared statement นั้นจะปลอดภัยกว่าการคิวรี่ตรงๆ อยู่ระดับหนึ่ง หลักการง่ายๆ ของมันคือเราจะสร้าง query template ขึ้นมาก่อน และเว้นว่างส่วนที่จะเป็น value ที่เราต้องการคิวรี่เอาไว้ เช่นปกติเราจะคิวรี่ด้วย WHERE id = 1 เราก็จะเปลี่ยนมาเป็น WHERE id = ? แทน แล้วเราจะแทนที่ ? ด้วยการ bind parameters ซึ่งการ bind parameters นี้จะทำการ escape string ให้อัตโนมัติ ทำให้เราไม่จำเป็นต้องมานั่งครอบ mysqli_real_escape_string( $value ) ซ้ำอีกรอบอีก

        3.2 ในตัวอย่างของการใช้ prepared statement จะเห็นว่ามีการ bind parameters เข้าไปด้วย (เพื่อแทนค่า :param ใน PDO หรือ ? ใน mysqli) ซึ่งระหว่าง mysqli และ PDO นั้นจะมีวิธีการ bind ต่างกันอยู่เล็กน้อย

        4. https://www.meen.in.th/2014/03/09/welcome-to-pdo/

        4.1 https://wp.curve.in.th/pdo/

        5.1 https://www.youtube.com/watch?v=LJKSczDwUgo

        5.2 bind parameter คือการแทนที่ตัวแปรใน statement เพื่อประมวลผลต่างๆ     ซึ่งแน่นอนว่าหากผู้ใช้งานพิมพ์ชื่อ username บางอย่างลงไป อาจก่อให้เกิด sql injection เอาได้ง่ายๆ
        แต่ถ้าหากเราใช้วิธีการ bind param แล้ว มั่นใจได้เลยว่าจะไม่มีทางเกิด SQL Injection ขึ้นแน่นอน
        ที่เป็นแบบนี้เพราะว่าการ bind param จะแทนที่ :user ด้วยค่า $_POST[‘user’] ที่ผ่านการ escape string มาเรียบร้อยแล้ว

        5.3 Bind param ຈະເກັບລ້າສຸດຂອງໂຕແປນັ້ນໄວ້ສະເໝີ
 -->

<!-- ================================================================ -->
<!-- ============= Create table users in final_test ================= -->
<!-- ================================================================ -->
<!-- CREATE TABLE users (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(255) NOT NULL,
password VARCHAR(255) NOT NULL,
create_date DATETIME DEFAULT CURRENT_TIMESTAMP,
role VARCHAR(255) DEFAULT 'member',
photo VARCHAR(255) DEFAULT 'profile_default.png'
)ENGINE=INNODB DEFAULT CHARSET=utf8; -->

<!-- ================================================================ -->
<!-- ========================= Link Resourse ======================== -->
<!-- ================================================================ -->
<!-- 1. https://github.com/ohmiler/php-pdo-registration-system -->
<!-- 2. https://github.com/ohmiler/pdo-crud-bootstrap5 -->

<!-- ================================================================ -->
<!-- ========================= User Account ========================= -->
<!-- ================================================================ -->
<!-- Admin:12345 (admin) -->
<!-- Sin:12345 (member) -->

<!-- ================================================================ -->
<!-- ========================= admin_login , user_login ========================= -->
<!-- ================================================================ -->
<!--

        if ($row['role'] == 'admin') { //ຖ້າ role ເປັນ admin

                $_SESSION['admin_login'] = $row['id'];
                header("location: admin.php");

        } else {  //ຖ້າ role ເປັນ user

                $_SESSION['user_login'] = $row['id'];
                header("location: user.php");

        }


 -->
