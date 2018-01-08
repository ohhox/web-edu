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
$student = $fn->getStudentYear('', $page, $limit);
$count = $fn->countStudentYear();
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
                            <a class="pull-right btn   bg-green waves-effect" href="student_year_form.php" >
                                <i class="material-icons">add</i> 
                                <span class="icon-name">เพิ่มกลุ่ม</span>
                            </a>
                            <h2>รายการนักศึกษา </h2>
                        </div>

                        <div class="body">
                            <table class="table">

                                <thead>
                                    <tr>

                                        <th>ปีการศึกษา</th>
                                        <th>รหัส</th> 
                                        <th>รุ่น</th> 
                                        <th>จำนวนนักศึกษา</th>
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row = $student->fetch_object()) {
                                        ?>
                                        <tr>

                                            <td><?= $row->sy_year ?> </td>
                                            <td><?= $row->sy_code; ?> </td>
                                            <td><?= $row->sy_gen; ?> </td>
                                            <td>
                                                <?= $fn->countStudent($row->sy_id); ?> คน
                                                <a  href="studentList.php?id=<?= $row->sy_id; ?>"> ดูรายชื่อ</a>
                                            </td>
                                            <td>

                                                <a class="btn  btn-warning" href="student_year_form.php?id=<?= $row->sy_id; ?>">แก้ไข</a> 
                                                <a class="btn  btn-danger removeNews" href="op_news.php?op=RemoveStudentYear&id=<?= $row->sy_id; ?>">ลบ</a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <nav>
                                <ul class="pagination">
                                    <?php
                                    $disble = "";
                                    if ($page == 0) {
                                        ?>
                                        <li class="disabled">
                                            <a  class="waves-effect">
                                                <i class="material-icons">chevron_left</i>
                                            </a>
                                        </li>
                                        <?php
                                    } else {
                                        ?>
                                        <li >
                                            <a href="?p=<?= $page ?>" class="waves-effect">
                                                <i class="material-icons">chevron_left</i>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                    ?>

                                    <?php
                                    $AllPage = ceil($count / $limit);

                                    for ($i = 1; $i <= $AllPage; $i++) {
                                        $active = "";
                                        if ($i == ($page + 1)) {
                                            $active = 'active';
                                        }
                                        ?>
                                        <li class="<?= $active ?>"><a href="?p=<?= $i ?>" class="waves-effect"><?= $i ?></a></li> 
                                        <?php
                                    }
                                    $disble = "";
                                    if ($page == $AllPage - 1) {
                                        ?>
                                        <li class="disabled">
                                            <a class="waves-effect">
                                                <i class="material-icons">chevron_right</i>
                                            </a>
                                        </li>
                                        <?php
                                    } else {
                                        ?>
                                        <li>
                                            <a href="?p=<?= $page + 2 ?>" class="waves-effect">
                                                <i class="material-icons">chevron_right</i>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                    ?>



                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>

            </div>
        </section>       
        <?php include './_inc/jsimport.php'; ?>    
        <script src="js/news.js" type="text/javascript" ></script>

    </body>
</html>