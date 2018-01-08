<?php
if (!isset($_COOKIE['userid'])) {
    header("Location:login.php");
}

include '../_conn.php';
include '../functionx.php';
$fn = new functionx();
$page = isset($_GET['p']) ? $_GET['p'] : 1;
$limit = 30;
$page = $page - 1;
$newsList = $fn->getPublicNews($page, $limit);
$count = $fn->countAllPublicNews();
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
    <body class="theme-blue" data-page='publicnews'>
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
                            <a class="pull-right btn   bg-green waves-effect" href="publicnews_form.php" >
                                <i class="material-icons">add</i> 
                                <span class="icon-name">เพิ่มข่าวประกาศ</span>
                            </a>

                            <h2>รายการข่าวประกาศ</h2>

                        </div>
                        <div class="body">
                            <table class="table">

                                <thead>
                                    <tr>
                                        <th>วันที่ลงข่าว</th>
                                        <th>เรื่อง</th> 
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row = $newsList->fetch_object()) {
                                        ?>
                                        <tr>
                                            <td><?= $fn->showThaiDate($row->news_date); ?></td>
                                            <td><?= $row->news_title ?> </td>

                                            <td> 
                                                <a href="publicnews_form.php?id=<?= $row->news_id; ?>">แก้ไข</a>  |
                                                <a href="op_news.php?op=removepublicNews&id=<?= $row->news_id; ?>" class="color-red removeNews">ลบ</a>

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
        <script>


        </script>
    </body>
</html>