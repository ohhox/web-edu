<?php
if (!isset($_COOKIE['userid'])) {
    header("Location:login.php");
}
include '../_conn.php';
include '../functionx.php';

$news_id = $_GET['id'];
$fn = new functionx();
$gallery = $fn->getSlide();
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
        <link href="plugins/light-gallery/css/lightgallery.css" rel="stylesheet">
    </head>
    <body class="theme-blue" data-page='slide'>
        <?php
        include "_inc/head.php";
        ?>
        <section class="content">
            <div class="container-fluid">
                <div class="block-header">

                    <h2>จัดการภาพสไลด์ </h2>
                </div>

                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    ภาพสไลด์                            
                                </h2>

                            </div>
                            <div class="body">
                                <form action="op_slide.php?op=upload" method="post" multipart='' enctype="multipart/form-data">
                                    เลือกภาพสไลด์  <code>
                                        (ขนาดความสูง ไม่เกิน 600px )
                                    </code>   
                                    <input id="news_image_gallery" type="file" name="news_image_gallery[]" multiple  accept="image/*" onchange="$(this).parent().submit()">  
                                    <code>
                                        ขนาดที่แนะนำ 1900px X 600px
                                    </code>
                                </form>
                                <script type="text/javascript">
                                    $(function () {
                                        $("#upload").bind("click", function () {
                                            if (typeof ($("#news_image_gallery")[0].files) != "undefined") {
                                                var size = parseFloat($("#fileUpload")[0].files[0].size / 1024).toFixed(2);
                                                alert(size + " KB.");
                                            } else {
                                                alert("This browser does not support HTML5.");
                                            }
                                        });
                                    });
                                </script>
                                <hr/>
                                <form action="op_slide.php?op=removeGallery" method="post">
                                    <div id="aniimated-thumbnials">
                                        ทั้งหมด <?= $gallery->num_rows ?> ภาพ <small>เลือกและกดปุ่มลบ เพื่อลบรายการที่ต้องการ</small>
                                        <hr/>
                                        <?php
                                        while ($row = $gallery->fetch_object()) {
                                            ?>
                                            <div class="col-lg-3 galleryBlog" >
                                                <div class="input-group  ">
                                                    <span class="input-group-addon">
                                                        <input type="checkbox" name="nig_id[]" value="<?= $row->img_id ?>"  class="filled-in" id="ig_checkbox<?= $row->img_id ?>">
                                                        <label for="ig_checkbox<?= $row->img_id ?>"> 
                                                            <img src="../gallery/thm/<?= $row->file; ?>" class="galleryImg" >
                                                        </label>

                                                    </span>
                                                </div>
                                                <a class="zoomit" href="../gallery/<?= $row->file; ?>"><i class="material-icons">zoom_in</i></a>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div style="margin-top: 50px;clear: both;">
                                        <button type="submit" class="btn btn-primary waves-effect">
                                            <i class="material-icons">delete_forever</i>
                                            <span>ลบรายการที่เเลือก </span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>       
        <?php include './_inc/jsimport.php'; ?>   

        <script src="plugins/light-gallery/js/lightgallery-all.js"></script>

        <!-- Custom Js -->
        <script src="js/pages/medias/image-gallery.js"></script>
    </body>
</html>