<?php
    class Admin_Model extends Database {
        public function addMhs($npm, $nama, $pass){
            try{
                $this->query("INSERT INTO tbmhs  
                VALUES (?, ?, NULL, NULL, NULL, 0)");
                $this->bind($npm, $nama);
                $this->execute();

                $this->query("INSERT INTO tblogin
                VALUES (?, SHA2(?, 256) , 'Mahasiswa')");
                $this->bind($npm, $pass);
                $this->execute();

                return true;
            } catch (Exception $err){
                return false;
            }
        }

        public function addMatkul($idmatkul, $nama, $semester){
            try {
                $this->query("INSERT INTO tbmatkul
                VALUES (?, ?, ?)");
                $this->bind($idmatkul, $nama, $semester);
                $this->execute();

                return true;
            } catch (Exception $err) {
                return false;
            }
        }

        public function getMatkul(){
            $this->query("SELECT * FROM tbmatkul");
            return $this->resSet();
        }
    }
?>