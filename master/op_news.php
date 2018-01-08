<?php

if (!isset($_COOKIE['userid'])) {
    header("Location:login.php");
}
include '../_conn.php';
include '../functionx.php';

class op_news extends functionx {

    public function __construct() {
        parent::__construct();
    }

    public function removeNews() {
        $id = $_GET['id'];
        $gallery = $this->getNewsGallery($id);
        $newsDatail = $this->getNewsFormid($id);

        while ($row = $gallery->fetch_object()) {

            if (!empty($row->file_name)) {
                if (file_exists("../gallery/{$row->file_name}")) {
                    unlink("../gallery/{$row->file_name}");
                    unlink("../gallery/thm/{$row->file_name}");
                }
            }
        }
        if (!empty($newsDatail->news_images)) {
            if (file_exists("../gallery/{$newsDatail->news_images}")) {
                unlink("../gallery/{$newsDatail->news_images}");
                unlink("../gallery/thm/{$newsDatail->news_images}");
            }
        }
        $this->remove("news_image_gallery", "news_id='{$id}'");
        $this->remove("news", "news_id='{$id}'");
        echo "ok";
    }

    public function saveNews() {
        $data = $_POST;

        if (!empty($_FILES['news_images'])) {
            $filename = $this->uploadMenberImage($_FILES['news_images']);
            if (!empty($filename))
                $this->resizeMenberImage($filename);

            $data['news_images'] = $filename;
        }

        $this->insert("news", $data);

        $lastNewsid = $this->getLastNewsID();
        if (!empty($_FILES['news_image_gallery'])) {
            $img = $_FILES['news_image_gallery'];
            $img_desc = $this->reArrayFiles($img);

            foreach ($img_desc as $val) {
                $newname = date('YmdHis', time()) . mt_rand() . '.jpg';
                $filename = $this->uploadMenberImage($val);
                if (!empty($filename)) {
                    $this->resizeMenberImage($filename);
                    $this->insert("news_image_gallery", array(
                        "file_name" => $filename,
                        "news_id" => $lastNewsid
                    ));
                }
            }
        }
        header("Location: news.php");
    }

    public function updateNews() {
        $data = $_POST;

        if (!empty($_FILES['news_images']) && !empty($_FILES['news_images']['name'])) {
            $filename = $this->uploadMenberImage($_FILES['news_images']);
            if (!empty($filename))
                $this->resizeMenberImage($filename);

            $data['news_images'] = $filename;
        }

        $this->update("news", $data, "news_id='{$_GET['id']}'");


        header("Location: news.php");
    }

    public function uploadMenberImage($file) {
        $uploadpath = "../gallery/";
        $temp = explode(".", $file['name']);
        $filename = rand(0, 1000000) . round(microtime(true)) . '.' . end($temp);
        $uploadpath = $uploadpath . $filename;
        if (move_uploaded_file($file["tmp_name"], $uploadpath)) {
            return $filename;
        } else {
            return "";
        }
    }

    public function resizeMenberImage($fileName) {
        include_once './class/resizeImage.php';
        $uploadpath = "../gallery/";
        $resize = new ResizeImage($uploadpath . $fileName);
        $resize->resizeTo(250, 250);
        $resize->saveImage($uploadpath . 'thm/' . $fileName);
    }

    public function removeGallery() {
        $news_id = $_GET['newsid'];
        if (isset($_POST['nig_id'])) {
            $img = $_POST['nig_id'];
            foreach ($img as $key => $value) {
                $res = $this->remove("news_image_gallery", "nig_id='{$value}'");
                if (!empty($res->file_name)) {
                    if (file_exists("../gallery/{$res->file_name}")) {
                        unlink("../gallery/{$res->file_name}");
                        unlink("../gallery/thm/{$res->file_name}");
                    }
                }
            }
        }
        header("Location: gallery.php?id=$news_id");
    }

    public function uploadGallery() {
        ini_set('upload_max_filesize', '0M');

        $lastNewsid = $_GET['news_id'];
        $img = $_FILES['news_image_gallery'];
        $img_desc = $this->reArrayFiles($img);

        foreach ($img_desc as $val) {
            $newname = date('YmdHis', time()) . mt_rand() . '.jpg';
            $filename = $this->uploadMenberImage($val);
            if (!empty($filename)) {
                $this->resizeMenberImage($filename);
                $this->insert("news_image_gallery", array(
                    "file_name" => $filename,
                    "news_id" => $lastNewsid
                ));
            }
        }
        header("Location: gallery.php?id=$lastNewsid");
    }

    public function savePublicNews() {

        $data = $_POST;
        $data['news_date'] = date("Y-m-d");

        $this->insert("publicnews", $data);
        if (!empty($_FILES)) {
            $lastnews = $this->getLastPublicNewsID();
            $file = $_FILES['fileUpload'];
            $img_desc = $this->reArrayFiles($file);



            foreach ($img_desc as $val) {
                $filename = "";
                $uploadpath = "../file/";
                $temp = explode(".", $val['name']);
                $filename = rand(0, 100000) . round(microtime(true)) . '.' . end($temp);
                $uploadpath = $uploadpath . $filename;
                if (move_uploaded_file($val["tmp_name"], $uploadpath)) {
                    $data = array(
                        "filename" => "{$val['name']}",
                        "filename_path" => "$filename",
                        "news_id" => "$lastnews"
                    );
                    $this->insert('publicnews_file', $data);
                }
            }
        }
        header("Location: publicnews.php");
    }

    public function ModifilePublicNews() {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $news_id = $_GET['id'];
            $data = $_POST;
            $this->update("publicnews", $data, "news_id='$news_id'");

            if (!empty($_FILES)) {
                $lastnews = $news_id;
                $file = $_FILES['fileUpload'];
                $img_desc = $this->reArrayFiles($file);



                foreach ($img_desc as $val) {
                    $filename = "";
                    $uploadpath = "../file/";
                    $temp = explode(".", $val['name']);
                    $filename = rand(0, 100000) . round(microtime(true)) . '.' . end($temp);
                    $uploadpath = $uploadpath . $filename;
                    if (move_uploaded_file($val["tmp_name"], $uploadpath)) {
                        $data = array(
                            "filename" => "{$val['name']}",
                            "filename_path" => "$filename",
                            "news_id" => "$lastnews"
                        );
                        $this->insert('publicnews_file', $data);
                    }
                }
            }
        }
        header("Location: publicnews.php");
    }

    public function removeFile() {
        $news_id = $_GET['newsid'];
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = $_GET['id'];
            $res = $this->remove("publicnews_file", "file_id='{$id}'");
            if (!empty($res->filename_path)) {
                if (file_exists("../file/{$res->filename_path}")) {
                    unlink("../file/{$res->filename_path}");
                }
            }
        }
        header("Location: publicnews_form.php?id=$news_id");
    }

    public function removepublicNews() {

        $id = $_GET['id'];
        $publicNews = $this->getPublicNewsFormId($id);
        $file = $this->getPublicNewsFileFormNewsId($id);

        while ($row = $file->fetch_object()) {

            if (!empty($row->filename_path)) {
                if (file_exists("../file/{$row->filename_path}")) {
                    unlink("../file/{$row->filename_path}");
                }
            }
        }


        $this->remove("publicnews_file", "news_id='{$id}'");
        $this->remove("publicnews", "news_id='{$id}'");
        echo "ok";
    }

    public function saveStudentYear() {

        $data = $_POST;

        $this->insert("student_year", $data);

        header("Location: student.php");
    }

    public function ModifileStudentYear() {
        $news_id = $_GET['id'];
        $data = $_POST;
        $this->update("student_year", $data, "sy_id='$news_id'");
        header("Location: student.php");
    }

    public function RemoveStudentYear() {
        $news_id = $_GET['id'];
        $this->remove("student_year", "sy_id='{$news_id}'");
        echo "ok";
    }

    public function saveStudent() {

        $data = $_POST;
        $this->insert("student", $data);

        header("Location: studentList.php?id={$_POST['sy_id']}");
    }

    public function ModifileStudent() {
        $news_id = $_GET['id'];
        $data = $_POST;
        $this->update("student", $data, "student_id='$news_id'");
        header("Location: studentList.php?id={$_POST['sy_id']}");
    }

    public function RemoveStudent() {
        $news_id = $_GET['id'];
        $this->remove("student", "student_id='{$news_id}'");
        echo "ok";
    }

}

$op = new op_news();
$fn = $_GET['op'];
$op->$fn();
