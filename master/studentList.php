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
$student = $fn->getStudent('', $_GET['id']);
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
    <body class="theme-blue" data-page='student'>
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
                            <a class="pull-right btn   bg-green waves-effect" href="student_form.php?syid=<?= $_GET['id'] ?>" >
                                <i class="material-icons">add</i> 
                                <span class="icon-name">เพิ่มนักศึกษา</span>
                            </a>
                            <h2>รายการนักศึกษา (<?= $student->num_rows ?> คน) </h2>
                        </div>

                        <div class="body">
                            <table class="table">

                                <thead>
                                    <tr>

                                        <th>รหัสนักศึกษา</th>
                                        <th>ชื่อ - นามสกุล</th> 
                                        <th>สถานที่ทำงาน</th> 
                                        <th>ตำแหน่ง</th>
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row = $student->fetch_object()) {
                                        ?>
                                        <tr>

                                            <td><?= $row->student_code ?> </td>
                                            <td><?= $row->student_name; ?> </td>
                                            <td><?= $row->student_work; ?> </td>
                                            <td><?= $row->student_position; ?> </td>
                                            <td> 
                                                <a class="btn  btn-warning" href="student_form.php?id=<?= $row->student_id; ?>&syid=<?= $_GET['id'] ?>">แก้ไข</a> 
                                                <a class="btn  btn-danger removeNews" href="op_news.php?op=RemoveStudent&id=<?= $row->student_id; ?>">ลบ</a>
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

    </body>
</html>