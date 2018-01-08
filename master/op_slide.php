<?php
if (!isset($_COOKIE['userid'])) {
    header("Location:login.php");
}
include '../_conn.php';
include '../functionx.php';

class op_slide extends functionx {

    public function __construct() {
        parent::__construct();
    }
    public function upload() {
        ini_set('upload_max_filesize', '0M');

        $img = $_FILES['news_image_gallery'];
        $img_desc = $this->reArrayFiles($img);

        foreach ($img_desc as $val) {
            $newname = date('YmdHis', time()) . mt_rand() . '.jpg';
            $filename = $this->uploadMenberImage($val);
            if (!empty($filename)) {
                $this->resizeMenberImage($filename);
                $this->insert("slide", array(
                    "file" => $filename,
                ));
            }
        }
        header("Location: slide.php");
    }

    public function resizeMenberImage($fileName) {
        include_once './class/resizeImage.php';
        $uploadpath = "../gallery/";
        $resize = new ResizeImage($uploadpath . $fileName);
        $resize->resizeTo(250, 250);
        $resize->saveImage($uploadpath . 'thm/' . $fileName);
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

    public function removeGallery() {
        if (isset($_POST['nig_id'])) {
            $img = $_POST['nig_id'];
            foreach ($img as $key => $value) {
                $res = $this->remove("slide", "img_id='{$value}'");
                if (!empty($res->file)) {
                    if (file_exists("../gallery/{$res->file}")) {
                        unlink("../gallery/{$res->file}");
                        unlink("../gallery/thm/{$res->file}");
                    }
                }
            }
        }
        header("Location: slide.php");
    }

}

$op = new op_slide();
$fn = $_GET['op'];
$op->$fn();
