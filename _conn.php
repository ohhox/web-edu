<?php

/* * ************ DATABASE ***************** */

class DATABASE {

    public $mysqli;
    private $db_config = array(
        "host" => "localhost", // กำหนด host
        "user" => "pydevcom_edu", // กำหนดชื่อ user
        "pass" => "x55TvYBdZ", // กำหนดรหัสผ่าน   
        "dbname" => "pydevcom_edu", // กำหนดชื่อฐานข้อมูล
        "charset" => "utf8"  // กำหนด charset
    );

    public function __construct() {
        
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        date_default_timezone_set("Asia/Bangkok");


        $this->mysqli = new mysqli(
                $this->db_config["host"], $this->db_config["user"], $this->db_config["pass"], $this->db_config["dbname"]
        );

        if (mysqli_connect_error()) {
            echo "ติดต่อฐานข้อมูลไม่ได้ กรุณาติดต่อผู้ดูแลระบบ";
            exit;
        }
        $this->mysqli->set_charset($this->db_config["charset"]);
    }

    public function insert($table, $data) {

        $keys;
        $values;
        foreach ($data as $key => $value) {
            $value = mysqli_real_escape_string($this->mysqli, $value);
            if (!empty($keys)) {
                $keys .= "," . $key;
            } else {
                $keys = "$key";
            }

            if (!empty($values)) {
                $values .= ",'" . $value . "'";
            } else {
                $values = "'$value'";
            }
        }
        $sql = "INSERT INTO $table ($keys) VALUES($values)";
        $this->mysqli->query($sql);
    }

    public function update($table, $data, $where) {

        $keys = '';

        foreach ($data as $key => $value) {
            $value = mysqli_real_escape_string($this->mysqli, $value);
            if (!empty($keys)) {
                $keys .= ",$key='{$value}'";
            } else {
                $keys .= "$key='{$value}'";
            }
        }

        $this->mysqli->query("UPDATE $table SET $keys WHERE $where");
    }

    public function remove($table, $where) {

        $data = $this->mysqli->query("SELECT *  FROM $table WHERE $where");
        $this->mysqli->query("DELETE FROM $table WHERE $where");
        return $data->fetch_object();
    }

    public function s($msg) {
        echo "<pre>";
        print_r($msg);
        echo "</pre>";
    }

}
