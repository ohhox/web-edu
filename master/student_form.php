<?php
if (!isset($_COOKIE['userid'])) {
    header("Location:login.php");
}
include '../_conn.php';
include '../functionx.php';
$url = "saveStudent";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $fn = new functionx();
    $StudentYear = $fn->getStudent($id);
    $url = "ModifileStudent&id=$id";
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

                    <h2>ข้อมูลนักศึกษา     </h2>
                </div>

                <div class="row clearfix">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    รายละเอียดข้อมูลนักศึกษา                         
                                </h2>

                            </div>
                            <div class="body">
                                <form action="op_news.php?op=<?= $url ?>" method="post"  enctype="multipart/form-data">
                                    <input type="hidden" name="sy_id" value="<?= $_GET['syid'] ?>">
                                    <div  >
                                        <div >
                                            <div> 

                                                <div class="input-group ">
                                                    <label>รหัสนักศึกษา</label>
                                                    <input type="text"  name="student_code" class="form-control" value="<?= isset($StudentYear) ? $StudentYear->student_code : '' ?>" >
                                                </div>
                                                <div class="input-group ">
                                                    <label>ชื่อนามสกุล</label>
                                                    <input type="text"  name="student_name" class="form-control" value="<?= isset($StudentYear) ? $StudentYear->student_name : '' ?>">
                                                </div>
                                                <div class="input-group ">
                                                    <label>วุฒิการศึกษา ระดับปริญญาตรี </label>
                                                    <input type="text"  name="student_degree" class="form-control" value="<?= isset($StudentYear) ? $StudentYear->student_degree : '' ?>">
                                                </div>
                                                <div class="input-group ">
                                                    <label>สถานที่ทำงาน</label>
                                                    <input type="text"  name="student_work" class="form-control" value="<?= isset($StudentYear) ? $StudentYear->student_work : '' ?>">
                                                </div>
                                                <div class="input-group ">
                                                    <label>ตำแหน่ง</label>
                                                    <input type="text"  name="student_position" class="form-control" value="<?= isset($StudentYear) ? $StudentYear->student_position : '' ?>">
                                                </div>
                                                <div class="input-group ">
                                                    <label>จบการศึกษาระดับปริญญาตรี  จาก</label>
                                                    <input type="text"  name="student_university" class="form-control" value="<?= isset($StudentYear) ? $StudentYear->student_university : '' ?>">
                                                </div>
                                                <div class="input-group ">
                                                    <label>ปีการศึกษาที่จบ</label>
                                                    <input type="text"  name="student_year" class="form-control" value="<?= isset($StudentYear) ? $StudentYear->student_year : '' ?>">
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
