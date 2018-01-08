<?php
if (!isset($_COOKIE['userid'])) {
    header("Location:login.php");
}
include '../_conn.php';
include '../functionx.php';
$url = "savePublicNews";
if (isset($_GET['id'])) {
    $news_id = $_GET['id'];
    $fn = new functionx();
    $newsDatail = $fn->getPublicNewsFormId($news_id);
    $newsfile = $fn->getPublicNewsFileFormNewsId($news_id);
    $url = "ModifilePublicNews&id=$news_id";
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
                                <form action="op_news.php?op=<?= $url ?>" method="post"  enctype="multipart/form-data">
                                    <div class="row clearfix">
                                        <div class="col-md-9">
                                            <div >
                                                <b>ไฟล์ </b> <small> (ไฟล์สำหรับให้ดาวโหลด) </small> <br/>
                                                <small style="color: #0000ff"> สามารถอัพโหลดได้หลายไฟล์ </small>

                                                <div class="input-group colorpicker">
                                                    <input type="file" name="fileUpload[]" multiple  >
                                                </div>

                                                <div>
                                                    <ul>
                                                        <?php
                                                        if (isset($newsfile)) {
                                                            while ($row = $newsfile->fetch_object()) {
                                                                echo "<li>"
                                                                . "<a href='../file/{$row->filename_path}' target='_BLANK'>{$row->filename} </a>"
                                                                . " <a class='text-danger' href='op_news.php?op=removeFile&id={$row->file_id}&newsid=$news_id'> ลบ </a>"
                                                                . "</li>";
                                                            }
                                                        }
                                                        ?>

                                                    </ul>
                                                </div>
                                            </div>
                                            <b> เรื่อง *</b>
                                            <div class="input-group colorpicker">
                                                <div class="form-line">
                                                    <input type="text" value="<?= (isset($newsDatail->news_title)) ? $newsDatail->news_title : '' ?>" required class="form-control" name="news_title" placeholder="หัวข้อของข่าวสารหรือกิจกรรม">
                                                </div>

                                            </div>
                                            <b> รายละเอียด *</b>  
                                            <div class="input-group colorpicker">
                                                <div class="form-line">
                                                    <textarea id="ckeditor"  required name="news_detail"><?= (isset($newsDatail->news_detail)) ? $newsDatail->news_detail : '' ?></textarea>
                                                </div>
                                            </div>
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
