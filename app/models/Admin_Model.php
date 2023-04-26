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

                $this->query("INSERT INTO tbbobot (idMatkul, semester, jenis, bobot)
                VALUES
                    (?, ?, 'Laprak', 0),
                    (?, ?, 'Responsi', 0),
                    (?, ?, 'Tubes', 0)");
                $this->bind($idmatkul, $semester, $idmatkul, $semester, $idmatkul, $semester);
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

        public function getAllMhs($idmatkul, $semester){
            $this->query("SELECT m.npm, m.namaMhs, 
                (SELECT 'true'
                FROM tbampu a 
                    WHERE a.npm = m.npm AND a.idMatkul = ? AND a.semester = ?) AS asdos,
                (SELECT 'true'
                FROM tbkelas k 
                    WHERE k.npm = m.npm AND k.idMatkul = ? AND k.semester = ?) AS mhs
            FROM tbmhs m");
            $this->bind($idmatkul, $semester, $idmatkul, $semester);
            return $this->resSet();
        }

        public function addMhsToKelas($npm, $idmatkul, $semester){
            try {
                if($this->getSingleKelas($npm, $idmatkul, $semester)->fetch_assoc()){
                    return true;
                } 
                $this->query("INSERT INTO tbkelas
                VALUES (?, ?, ?)");
                $this->bind($npm, $idmatkul, $semester);
                $this->execute();

                return true;
            } catch (Exception $err){
                return false;
            }
        }

        public function addMhsToAmpu($npm, $idmatkul, $semester){
            try {
                if($this->getSingleKelas($npm, $idmatkul, $semester)->fetch_assoc()){
                    $this->query("DELETE FROM tbkelas
                        WHERE npm = ? AND idMatkul = ? AND semester = ?");
                    $this->bind($npm, $idmatkul, $semester);
                    $this->execute();
                } 

                if($this->getSingleAmpu($npm, $idmatkul, $semester)->fetch_assoc()){
                    return true;
                }
                $this->query("INSERT INTO tbampu
                VALUES (?, ?, ?)");
                $this->bind($idmatkul, $npm, $semester);
                $this->execute();

                $this->query("UPDATE tblogin
                SET role = 'Asisten Dosen'
                WHERE npm = ?");
                $this->bind($npm);
                $this->execute();
    
                return true;
            } catch (Exception $err){
                return false;
            }
        }

        public function delMhsFromKelas($npm, $idmatkul, $semester){
            try {
                if($this->getSingleAmpu($npm, $idmatkul, $semester)->fetch_assoc()){
                    $this->query("DELETE FROM tbampu
                        WHERE npm = ? AND idMatkul = ? AND semester = ?");
                    $this->bind($npm, $idmatkul, $semester);
                    $this->execute();
                } else {
                    if($this->getSingleKelas($npm, $idmatkul, $semester)->fetch_assoc()){
                        $this->query("DELETE FROM tbkelas
                            WHERE npm = ? AND idMatkul = ? AND semester = ?");
                        $this->bind($npm, $idmatkul, $semester);
                        $this->execute();
                    }
                }
                return true;
            } catch ( Exception $err) {
                return false;
            }
        }

        public function delMatkul($idmatkul, $semester){
            try {
                $this->query("DELETE FROM tbmatkul
                WHERE idMatkul = ? AND semester = ?");
                $this->bind($idmatkul, $semester);
                $this->execute();

                return true;
            } catch (Exception $err){
                return false;
            }
        }

        public function getSingleAmpu($npm, $idmatkul, $semester){
            $this->query("SELECT * FROM tbampu
                WHERE npm = ? AND idMatkul = ? AND semester = ?");
            $this->bind($npm, $idmatkul, $semester);
            return $this->resSet();
        }

        public function getSingleKelas($npm, $idmatkul, $semester){
            $this->query("SELECT * FROM tbkelas
                WHERE npm = ? AND idMatkul = ? AND semester = ?");
            $this->bind($npm, $idmatkul, $semester);
            return $this->resSet();
        }

        public function getSimpleAllMhs(){
            $this->query("SELECT npm, namaMhs FROM tbmhs");
            return $this->resSet();
        }

        public function delMhs($npm){
            try {
                $this->query("DELETE FROM tbmhs
                    WHERE npm = ?");
                $this->bind($npm);
                $this->execute();
                return true;
            } catch (Exception $err){
                return false;
            }

        }
    }
?>