<?php

class Database{

    const USER_EMAIL = "ad3573m3n@gmail.com";
    const PASSWORD_EMAIL = "iostreamstd31416";

    private $dsn = "mysql:host=localhost;dbname=db_user_system";
    private $dbuser = "root";
    private $dbpass = "";
    public $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO($this->dsn,$this->dbuser,$this->dbpass);
        } catch (PDOException $e) {
            die("Error: ".$e->getMessage());
        }

        return $this->conn;
    }

    //Comprobar los inputs
    public function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //Error Success Message Alert
    public function showMessage($type,$message){
        return '<div class="alert alert-'.$type.' alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong class="text-center">'.$message.'</strong>
                </div>';
    }

    //Display time in ago
    public function timeInAgo($timestamp){
        date_default_timezone_set('America/Lima');
        $timestamp = strtotime($timestamp) ? strtotime($timestamp) : $timestamp;
        $time = time() - $timestamp;
        switch ($time) {
            //SECONDS
            case $time <= 60:
                return 'Just Now!';
            //MINUTES
            case $time >= 60 && $time < 3600:
                return (round($time/60) == 1) ? 'a minute ago' : round($time/60).' minutes ago';
            //HOURS
            case $time >= 3600 && $time < 86400:
                return (round($time/3600) == 1) ? 'an hour ago' : round($time/3600).' hours ago';
            //DAYS
            case $time >= 86400 && $time < 604800:
                return (round($time/86400) == 1) ? 'a day ago' : round($time/86400).' days ago';
            //WEEKS
            case $time >= 604800 && $time < 2600640:
                return (round($time/604800) == 1) ? 'a week ago' : round($time/604800).' weeks ago';
            //MONTHS
            case $time >= 2600640 && $time < 31207680:
                return (round($time/2600640) == 1) ? 'a month ago' : round($time/2600640).' months ago';
            //YEARS
            case $time >= 31207680 :
                return (round($time/31207680) == 1) ? 'a year ago' : round($time/31207680).' years ago';
        }
    }

}

