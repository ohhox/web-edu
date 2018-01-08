<?php
if (!isset($_COOKIE['userid'])) {
    header("Location:login.php");
}
include '../_conn.php';
include '../functionx.php';
$url = "save";
if (isset($_GET['id'])) {
    $news_id = $_GET['id'];
    $fn = new functionx();
    $newsDatail = $fn->getUserById($news_id);
    $url = "modifile&id=$news_id";
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

                    <h2>ฟอร์มเพิ่มข่าวประกาศ </h2>
                </div>

                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    รายละเอียดของข่าวประกาศ                               
                                </h2>

                            </div>
                            <div class="body">
                                <form action="op_user.php?op=<?= $url ?>" method="post"  enctype="multipart/form-data">
                                    <div class="row clearfix">
                                        <div class="col-md-6">

                                            <b> ชื่อ *</b>
                                            <div class="input-group  ">
                                                <div class="form-line">
                                                    <input type="text" 
                                                           value="<?= (isset($newsDatail->name)) ? $newsDatail->name : '' ?>" 
                                                           required class="form-control" name="name" placeholder="ชื่อของผู้ใช้งาน">
                                                </div>

                                            </div>
                                            <b> username *</b>  
                                            <div class="input-group  ">
                                                <div class="form-line">
                                                    <input type="text" value="<?= (isset($newsDatail->username)) ? $newsDatail->username : '' ?>" 
                                                           required class="form-control" name="username" placeholder="Username">
                                                </div>

                                            </div>
                                            <b> password *</b>  
                                            <div class="input-group  ">
                                                <div class="form-line">
                                                    <input type="text"  required class="form-control" name="password" placeholder="Password" 
                                                    <?php
                                                    if (isset($_GET['id'])) {
                                                        echo 'value="************" ';
                                                        echo "readonly";
                                                    }
                                                    ?> >
                                                </div>

                                            </div>
                                            <?php
                                            if (isset($_GET['id'])) {
                                                ?>
                                                <b> รหัสผ่านใหม่ * (<i>กรณีต้องการเปลี่ยนรหัสให้กรอกช่องนี้</i>)</b>  
                                                <div class="input-group  ">
                                                    <div class="form-line">
                                                        <input type="text"  class="form-control" name="Newpassword" placeholder="รหัสผ่านใหม่" >
                                                    </div>

                                                </div>
                                                <?php
                                            }
                                            ?> 

                                        </div>
                                        <div class="col-md-9">                                            
                                            <button type="submit" class="btn bg-green pull-right"> 
                                                <i class="material-icons">save</i>  
                                                <span class="icon-name">บันทึกข้อมูล</span>
                                            </button>
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
