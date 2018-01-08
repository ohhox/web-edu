<?php

if (!isset($_COOKIE['userid'])) {
    header("Location:login.php");
}
include '../_conn.php';
include '../functionx.php';

class op_user extends functionx {

    public function __construct() {
        parent::__construct();
    }

    public function save() {
        $data = $_POST;
        $this->insert('user', $data);
        header("Location: user.php");
    }

    public function modifile() {
        $data = array();
        $data['name'] = $_POST['name'];
        $data['username'] = $_POST['username'];
        if (!empty($_POST['Newpassword'])) {
            $data['password'] = $_POST['Newpassword'];
        }

        $this->update("user", $data, "user_id={$_GET['id']}");
        header("Location: user.php");
    }

    public function removeUser() {
        if (!empty($_GET['id'])) {
            $this->remove("user", "user_id={$_GET['id']}");
            echo "ok";
        }
    }

}

$op = new op_user();
$fn = $_GET['op'];
$op->$fn();
