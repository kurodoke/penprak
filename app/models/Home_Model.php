<?php
    class Home_Model extends Database {
        public function getProfile($user){
            $this->query("SELECT npm, namaMhs, email, alamat, tglLahir, fakultas, prodi, profileStatus FROM tbmhs 
            RIGHT JOIN tbfakultas ON idFk = LEFT(npm,1)
            RIGHT JOIN tbprodi ON idProdi = LEFT(npm,3)
            WHERE npm = ?
            GROUP BY npm");
            $this->bind($user);
            return $this->resSet();
        }

        public function editProfile($tgl, $email, $alamat, $user){
            try{
                $this->query("UPDATE tbmhs
                SET tglLahir = ?, email = ?, alamat = ?
                WHERE npm = ?");
                $this->bind($tgl, $email, $alamat, $user);
                $this->execute();
                return true;
            } catch (Exception $err){
                return false;
            }
        }

        public function editPhoto($user, $profileStatus){
            try{
                $this->query("UPDATE tbmhs
                SET profileStatus = ?
                WHERE npm = ?");
                $this->bind($profileStatus, $user);
                $this->execute();
                return true;
            } catch (Exception $err){
                return false;
            }
        }

        public function kelasMhs($user){
            $this->query("SELECT tbkelas.npm AS npm, matkul, tbampu.npm AS asdos, tbmhs.namaMhs AS nama, tbkelas.idMatkul AS idMatkul ,tbkelas.semester AS semester FROM tbkelas 
                RIGHT JOIN tbmatkul ON tbkelas.idMatkul = tbmatkul.idMatkul
                LEFT JOIN tbampu ON tbkelas.idMatkul = tbampu.idMatkul
                RIGHT JOIN tbmhs ON tbkelas.npm = tbmhs.npm
            WHERE tbkelas.npm = ?
            ORDER BY idMatkul, semester");
            $this->bind($user);
            return $this->resSet();
        }

        public function kelasAsdos($user){
            $this->query("SELECT * FROM tbampu
            RIGHT JOIN tbmatkul ON tbampu.idMatkul = tbmatkul.idMatkul
            WHERE npm = ?");
            $this->bind($user);
            return $this->resSet();
        }
    }
?>