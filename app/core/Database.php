<?php
    class Database {
        private $db;
        private $stmt;

        public function __construct() {
            $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, 3306);

            if ($this->db->connect_errno) {
                echo "Failed to connect to MySQL: " . $this->db->connect_error;
            }
        }

        public function con() {
            return $this->db;
        }

        public function query($q){
            $this->stmt = $this->db->prepare($q);
        }

        public function bind(...$args) {
            $i = 0;
            $nullIndex = [];
            $format = "";
            while ($i < sizeof($args)) {
                if (gettype($args[$i]) == "string"){
                    $format = $format . "s";
                }
                if (gettype($args[$i]) == "integer"){
                    $format = $format . "i";
                }
                if (gettype($args[$i]) == "double"){
                    $format = $format . "d";
                }
                if (gettype($args[$i]) == "NULL"){
                    $format = $format . "s";
                    array_push($nullIndex, $i);
                }
                $i++;
            }
            $this->stmt->bind_param($format, ...$args);

            if (!empty($nullIndex)){
                foreach($nullIndex as $index){
                    $this->stmt->send_long_data($index,null);
                }
            }
        }

        public function execute(){
            $this->stmt->execute();
        }

        public function resSet(){
            $this->execute();
            $res = $this->stmt->get_result();
            return $res;
        }
    }
?>