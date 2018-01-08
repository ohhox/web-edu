<?php
if (!isset($_COOKIE['userid'])) {
    header("Location:login.php");
}
include '../_conn.php';
include '../functionx.php';

$news_id = $_GET['id'];
$fn = new functionx();
$newsDatail = $fn->getNewsFormid($news_id);
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
    <body class="theme-blue" data-page='news'>
        <?php
        include "_inc/head.php";
        ?>
        <section class="content">
            <div class="container-fluid">
                <div class="block-header">

                    <h2>ฟอร์มเพิ่มข่าวสารและกิจกรรม </h2>
                </div>

                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    <a href="news.php"> 
                                        กลับ
                                    </a>    รายละเอียดของข่าวสารหรือกิจกรรม                                  
                                </h2>

                            </div>
                            <div class="body">
                                <form action="op_news.php?op=updateNews&id=<?= $news_id ?>" method="post" multipart='' enctype="multipart/form-data">
                                    <div class="col-md-12">
                                        <b>รูปภาพหลัก * </b>
                                        <div class="input-group colorpicker">
                                            <input type="file" name="news_images"    accept="image/*">
                                            <div style="padding-top: 10px;">
                                                <?php
                                                if (!empty($newsDatail->news_images)) {
                                                    echo "<a href='../gallery/{$newsDatail->news_images}' target='_BLANK'><img src='../gallery/thm/{$newsDatail->news_images}'> </a>";
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-md-9">
                                            <b> ชื่อข่าวสาร *</b>
                                            <div class="input-group colorpicker">
                                                <div class="form-line">
                                                    <input type="text" value="<?= $newsDatail->news_name; ?>" required class="form-control" name="news_name" placeholder="หัวข้อของข่าวสารหรือกิจกรรม">
                                                </div>

                                            </div>
                                        </div>
<!--                                        <div class="col-md-3">
                                            <b>ประเภท *</b>

                                            <div class="input-group colorpicker">
                                                <select class="form-control" name="news_type" required>
                                                    <option value="0" <?php if ($newsDatail->news_type == 0) echo "selected"; ?>>โปรดเลือก</option>
                                                    <option value="news" <?php if ($newsDatail->news_type == "news") echo "selected"; ?> >ข่าวสาร</option>
                                                    <option value="event" <?php if ($newsDatail->news_type == "event") echo "selected"; ?> >กิจกรรม</option> 
                                                </select>

                                            </div>
                                        </div>-->

<!--                                        <div class="col-md-9">
                                            <b> พาดหัวข่าว *</b> <small>เนื้อหาบางส่วนเพื่อนำไปแสดงหน้าแรก ประมาณ 2 บรรทัด</small>
                                            <div class="input-group colorpicker">
                                                <div class="form-line">
                                                    <textarea class="form-control" name="news_title" required rows="4"><?= $newsDatail->news_title; ?></textarea>
                                                </div>
                                            </div>
                                        </div>-->

                                        <div class="col-md-9">
                                            <b> เนื้อหาของข่าว *</b>  
                                            <div class="input-group colorpicker">
                                                <div class="form-line">
                                                    <textarea id="ckeditor"  required name="news_detail"><?= $newsDatail->news_detail; ?></textarea>
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