<?php
if (!isset($_COOKIE['userid'])) {
    header("Location:login.php");
}
include '../_conn.php';
include '../functionx.php';
$url = "saveStudentYear";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $fn = new functionx();
    $StudentYear = $fn->getStudentYear($id);
    $url = "ModifileStudentYear&id=$id";
}
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

                    <h2>ฟอร์มเพิ่มกลุ่มนักศึกษา </h2>
                </div>

                <div class="row clearfix">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    รายละเอียดของกลุ่มนักศึกษา                            
                                </h2>

                            </div>
                            <div class="body">
                                <form action="op_news.php?op=<?= $url ?>" method="post"  enctype="multipart/form-data">
                                    <div  >
                                        <div >
                                            <div > 

                                                <div class="input-group ">
                                                    <label>ปีการศึกษา</label>
                                                    <input type="number"  name="sy_year" class="form-control" value="<?= isset($StudentYear) ? $StudentYear->sy_year : '' ?>" >
                                                </div>
                                                <div class="input-group ">
                                                    <label>รหัส</label>
                                                    <input type="text"  name="sy_code" class="form-control" value="<?= isset($StudentYear) ? $StudentYear->sy_code : '' ?>">
                                                </div>
                                                <div class="input-group ">
                                                    <label>รุ่นที่ </label>
                                                    <input type="text"  name="sy_gen" class="form-control" value="<?= isset($StudentYear) ? $StudentYear->sy_gen : '' ?>">
                                                </div>

                                            </div>

                                            <div >                                            
                                                <button type="submit" class="btn bg-green pull-right"> 
                                                    <i class="material-icons">save</i>  
                                                    <span class="icon-name">บันทึกข้อมูล</span>
                                                </button>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>








                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>       
        <?php include './_inc/jsimport.php'; ?>  
        <script src="ckeditor/ckeditor.js"></script>
        <script src="ckeditor/config.js"></script> 
    </body>
</html>
