<?php
if (!isset($_COOKIE['userid'])) {
    header("Location:login.php");
}
include '../_conn.php';
include '../functionx.php';

$news_id = $_GET['id'];
$fn = new functionx();
$gallery = $fn->getNewsGallery($news_id);
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
        <link href="plugins/light-gallery/css/lightgallery.css" rel="stylesheet">
    </head>
    <body class="theme-blue" data-page='news'>
        <?php
        include "_inc/head.php";
        ?>
        <section class="content">
            <div class="container-fluid">
                <div class="block-header">

                    <h2>จัดการอัลบั้มรูปภาพ </h2>
                </div>

                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header" style="background: #e5e5e5">
                                <h2>
                                    <a href="news.php"> 
                                     กลับ
                                    </a> 
                                    <?= $newsDatail->news_name ?>                                  
                                </h2>

                            </div>
                            <div class="body">
                                <form action="op_news.php?op=uploadGallery&news_id=<?= $news_id ?>" method="post" multipart='' enctype="multipart/form-data">
                                    เลือกรูปภาพเพิ่มเติม
                                    <input id="news_image_gallery" type="file" name="news_image_gallery[]" multiple  accept="image/*" onchange="$(this).parent().submit()">  
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
                                <form action="op_news.php?op=removeGallery&newsid=<?= $news_id ?>" method="post">
                                    <div id="aniimated-thumbnials">
                                        ทั้งหมด <?= $gallery->num_rows ?> ภาพ <small>เลือกและกดปุ่มลบ เพื่อลบรายการที่ต้องการ</small>
                                        <hr/>
                                        <?php
                                        while ($row = $gallery->fetch_object()) {
                                            ?>
                                            <div class="col-lg-3 galleryBlog" >
                                                <div class="input-group  ">
                                                    <span class="input-group-addon">
                                                        <input type="checkbox" name="nig_id[]" value="<?= $row->nig_id ?>"  class="filled-in" id="ig_checkbox<?= $row->nig_id ?>">
                                                        <label for="ig_checkbox<?= $row->nig_id ?>"> 
                                                            <img src="../gallery/thm/<?= $row->file_name; ?>" class="galleryImg" >
                                                        </label>

                                                    </span>
                                                </div>
                                                <a class="zoomit" href="../gallery/<?= $row->file_name; ?>"><i class="material-icons">zoom_in</i></a>
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