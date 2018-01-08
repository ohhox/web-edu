<?php
if (!isset($_COOKIE['userid'])) {
    header("Location:login.php");
}
include '../_conn.php';
include '../functionx.php';
$fn = new functionx();


$page = isset($_GET['p']) ? $_GET['p'] : 1;
$limit = 50;
$page = $page - 1;
$newsList = $fn->getUserAll();
?>

<!DOCTYPE html>
<html lang="th">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>  ระบบจัดการข้อมูล เว็บไซต์โรงเรียนสาธิต</title>
        <?php
        include "_inc/header.php";
        ?>
    </head>
    <body class="theme-blue" data-page='user'>
        <?php
        include "_inc/head.php";
        ?>
        <section class="content">
            <div class="container-fluid">
                <div class="block-header">


                </div>

                <!-- Widgets -->
                <div class="row clearfix" >
                    <div class="card" >
                        <div class="header">
                            <a class="pull-right btn   bg-green waves-effect" href="user_form.php" >
                                <i class="material-icons">add</i> 
                                <span class="icon-name">เพิ่มผู้ใช้</span>
                            </a>

                            <h2>รายการผู้ใช้งานระบบ</h2>

                        </div>
                        <div class="body">
                            <table class="table">

                                <thead>
                                    <tr>
                                        <th>ชื่อ</th>
                                        <th>Username</th>
                                        <th>เพิ่มเมื่อ</th> 
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row = $newsList->fetch_object()) {
                                        ?>
                                        <tr>

                                            <td><?= $row->name ?> </td>
                                            <td><?= $row->username; ?> </td>
                                            <td><?= $fn->showThaiDate($row->dateadd); ?></td>
                                            <td>

                                                <a href="user_form.php?id=<?= $row->user_id; ?>">แก้ไข</a>  |
                                                <a href="op_user.php?op=removeUser&id=<?= $row->user_id; ?>" class="color-red removeNews">ลบ</a>

                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                           
                        </div>
                    </div>
                </div>

            </div>
        </section>       
        <?php include './_inc/jsimport.php'; ?>    
        <script src="js/news.js" type="text/javascript" ></script>
        <script>
            
        </script>

    </body>
</html>