<?php
    class Login_Model extends Database {
        public function getAdmin($user, $pass){
            $this->query("SELECT userAdmin AS user, pass 
                FROM tbadmin WHERE userAdmin = ? AND pass = SHA2(?, 256)");
            $this->bind($user, $pass);
            return $this->resSet();
        }
        public function getMhs($user, $pass){
            $this->query("SELECT npm AS user, pass, role FROM tblogin
                WHERE npm = ? AND pass = SHA2(?, 256)");
            $this->bind($user, $pass);
            return $this->resSet();
        }

        public function editPass($user, $passLama, $passBaru){
            try {
                $this->query("UPDATE tblogin
                SET pass = SHA2(?, 256)
                WHERE npm = ? AND pass = SHA2(?, 256);");
                $this->bind($passBaru, $user, $passLama);
                $this->execute();
                return true;
            } catch (Exception $err) {
                return false;
            }

        }
    }
?>