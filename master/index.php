<?php
if (!isset($_COOKIE['userid'])) {
    header("Location:login.php");
}
?><!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>  ระบบจัดการข้อมูล เว็บไซต์โรงเรียนสาธิต</title>
        <?php
        include "_inc/header.php";
        ?>
    </head>

    <body class="theme-blue" data-page="index">
        <?php
        include "_inc/head.php";
        ?>

        <section class="content">
            <div class="container-fluid"> 
                <div >
                    <center>

                    </center>
                </div>

            </div>
        </section>
        <?php include './_inc/jsimport.php'; ?>
    </body>

</html>