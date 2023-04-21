<?php
    class Basic_Model extends Database {
        public function matkul($matkul){
            $this->query("SELECT * FROM tbmatkul
            WHERE idMatkul = ?");
            $this->bind($matkul);
            return $this->resSet();
        }
    }
?>