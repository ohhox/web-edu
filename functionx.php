<?php

class functionx extends DATABASE {

    public $newsType = array(
        "news" => "ข่าวสาร",
        "event" => "กิจกรรม"
    );

    public function __construct() {
        parent::__construct();
    }

    public function getUserAll() {

        $query = $this->mysqli->query("SELECT * FROM user ORDER BY user_id DESC");
        return $query;
    }

    public function getUserById($id) {

        $query = $this->mysqli->query("SELECT * FROM user WHERE user_id='$id' ORDER BY user_id DESC");
        return $query->fetch_object();
    }

    public function getNewsFormid($news_id) {

        $query = $this->mysqli->query("SELECT * FROM news WHERE news_id='$news_id' ORDER BY news_id DESC LIMIT 0,30");
        return $query->fetch_object();
    }

    public function getPublicNews($page, $limit) {
        $start = $page * $limit;
        $res = $this->mysqli->query($sql = "SELECT * FROM publicnews ORDER BY news_id DESC limit $start,$limit");

        return $res;
    }

    public function countAllNews() {
        $count = $this->mysqli->query("SELECT count(*) as count FROM news ");
        $count = $count->fetch_object();
        return $count->count;
    }

    public function countStudentYear() {
        $count = $this->mysqli->query("SELECT count(*) as count FROM student_year ");
        $count = $count->fetch_object();
        return $count->count;
    }

    public function countAllPublicNews() {
        $count = $this->mysqli->query("SELECT count(*) as count FROM publicnews ");
        $count = $count->fetch_object();
        return $count->count;
    }

    public function getPublicNewsFormId($id) {
        $data = $this->mysqli->query("SELECT * FROM publicnews WHERE news_id='$id'");
        return $data->fetch_object();
    }

    public function getPublicNewsFileFormNewsId($id) {
        return $this->mysqli->query("SELECT * FROM publicnews_file WHERE news_id='$id'");
    }

    public function getCountPublicNewsfile($newsid) {
        $newsfile = $this->query("SELECT count(*) as count FROM publicnews_file WHERE news_id='$newsid'");
        $news = $newsfile->fetch_object();
        return $news->count;
    }

    public function getPublicNewsfile($newsid) {
        return $this->query("SELECT count(*) as count FROM publicnews_file WHERE news_id='$newsid'");
    }

    public function getNews($page, $limit) {
        $start = $page * $limit;
        return $this->mysqli->query("SELECT * FROM news ORDER BY news_id DESC LIMIT $start,$limit");
    }

    public function getListNews($news_id = NULL) {
        if (empty($id)) {
            return $this->mysqli->query("SELECT * FROM news ORDER BY news_id DESC LIMIT 0,30");
        } else {
            $query = $this->mysqli->query("SELECT * FROM news WHERE news_id='$news_id' ORDER BY news_id DESC LIMIT 0,30");
            return $query->fetch_object();
        }
    }

    public function getNewsGallery($newid) {
        return $this->mysqli->query("SELECT * FROM news_image_gallery WHERE news_id='$newid' ORDER BY nig_id DESC ");
    }

    public function getLastNewsID() {
        $query = $this->mysqli->query("SELECT * FROM news ORDER BY news_id DESC LIMIT 0,1");
        $res = $query->fetch_object();
        return $res->news_id;
    }

    public function getLastPublicNewsID() {
        $query = $this->mysqli->query("SELECT * FROM publicnews ORDER BY news_id DESC LIMIT 0,1");
        $res = $query->fetch_object();
        return $res->news_id;
    }

    function reArrayFiles(&$file_post) {

        $file_ary = array();
        $file_count = count($file_post['name']);
        $file_keys = array_keys($file_post);

        for ($i = 0; $i < $file_count; $i++) {
            foreach ($file_keys as $key) {
                $file_ary[$i][$key] = $file_post[$key][$i];
            }
        }

        return $file_ary;
    }

    public function showThaiDate($date) {
        echo (date('d/m/', strtotime($date))) . (date('Y', strtotime($date)) + 543);
    }

    public function getSlide() {
        return $this->mysqli->query("SELECT  * FROM slide ORDER BY img_id DESC");
    }

    public function updateNewsViews($id) {
        $news = $this->getNewsFormid($id);
        $data = array(
            "news_view" => ($news->news_view + 1)
        );
        $this->update("news", $data, " news_id=$id");
    }

    public function updatePublicNewsViews($id) {
        $news = $this->getPublicNewsFormId($id);
        $data = array(
            "view" => ($news->view + 1)
        );
        $this->update("publicnews", $data, " news_id=$id");
    }

    public function getStudentYear($id = NULL, $page = NULL, $limit = NULL) {
        if (!empty($id)) {
            $sql = "SELECT * FROM student_year WHERE sy_id='$id'";
            $res = $this->mysqli->query($sql);
            return $res->fetch_object();
        } else {
            $start = $page * $limit;
            $sql = "SELECT * FROM student_year ORDER BY sy_id DESC  LIMIT $start,$limit";
            return $this->mysqli->query($sql);
        }
    }

    public function getStudent($id = NULL, $idx = NULL) {
        if (!empty($id)) {
            $sql = "SELECT * FROM student WHERE student_id='$id'";
            $res = $this->mysqli->query($sql);
            return $res->fetch_object();
        } else if (!empty($idx)) {
            $sql = "SELECT * FROM student WHERE sy_id='$idx' ORDER BY student_id DESC  ";
            return $this->mysqli->query($sql);
        }else{
            return array();
        }
    }

    public function countStudent($id) {
        $count = $this->mysqli->query("SELECT count(*) as count FROM student WHERE sy_id='$id'");
        $count = $count->fetch_object();
        return $count->count;
    }

}
