<?php
if (!isset($_COOKIE['userid'])) {
    header("Location:login.php");
}
?><!DOCTYPE html>
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

                    <h2>ฟอร์มเพิ่มกิจกรรม </h2>
                </div>

                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    รายละเอียดของกิจกรรม                              
                                </h2>

                            </div>
                            <div class="body">
                                <form action="op_news.php?op=saveNews" method="post" multipart='' enctype="multipart/form-data">
                                    <div class="row clearfix">
                                        <div class="col-md-9">
                                            <b> ชื่อกิจกรรม *</b>
                                            <div class="input-group colorpicker">
                                                <div class="form-line">
                                                    <input type="text" required class="form-control" name="news_name" placeholder="หัวข้อของข่าวสารหรือกิจกรรม">
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-3" style="display: none;">
                                            <b>ประเภท *</b>
                                            <div class="input-group colorpicker">
                                                <select class="form-control" name="news_type" required>
                                                    <!--                                                    <option value="0">โปรดเลือก</option>
                                                                                                        <option value="news">ข่าวสาร</option>-->
                                                    <option value="event" selected>กิจกรรม</option> 
                                                </select>

                                            </div>
                                        </div>


                                        <div class="col-md-9">
                                            <b> เนื้อหาของข่าว *</b>  
                                            <div class="input-group colorpicker">
                                                <div class="form-line">
                                                    <textarea id="ckeditor"  required name="news_detail"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <b>รูปภาพหลัก * <small>(ขนาดของรูป 1000px X 1000px) </small> </b> <br/>
                                            <small style="color: #0000ff">ควรทำการ resize รูปภาพก่อนนำเข้าระบบ</small>
                                            <div class="input-group colorpicker">
                                                <input type="file" name="news_images" required  accept="image/*">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <b>รูปภาพอัลบั้ม <small> (ขนาดของแต่ละภาพไม่ควรเกิน 1MB </small>) </b> <br/>
                                            <small style="color: #0000ff">ควรทำการ resize รูปภาพก่อนนำเข้าระบบ</small>

                                            <div class="input-group colorpicker">
                                                <input type="file" name="news_image_gallery[]" multiple  accept="image/*" >
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>



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