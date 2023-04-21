<?php
    class Login extends Controller{

        //view
        public function role(...$data) {
            if($this->auth() && $_SESSION['role'] == "asdos"){
                $this->tview("login/role");
            } else {
                $this->location("");
            }
        }

        //proc
        public function login(){
            $model = $this->model("Login_Model");
            if ((isset($_POST['user']) && !empty($_POST['user'])) && (isset($_POST['pass']) && !empty($_POST['pass']))){
                if ($res = $model->getAdmin($_POST['user'], $_POST['pass'])->fetch_assoc()){
                    $_SESSION["user"] = $res["user"];
                    $_SESSION["role"] = "admin";
                    $this->location("home/" . $_SESSION["role"]);
                } else if ($res = $model->getMhs($_POST['user'], $_POST['pass'])->fetch_assoc()){
                    $_SESSION["user"] = $res["user"];
                    if ($res["role"] == "Mahasiswa"){
                        $_SESSION["role"] = "mahasiswa";
                        $this->location("home/". $_SESSION["role"]);
                    } else {
                        $_SESSION["role"] = "asdos";
                        $this->location("login/role");
                    }
                } else {
                    Flasher::setFlash("Error", "User dan Password Salah", "danger");
                }
            } else {
                Flasher::setFlash("Error", "Input sesuatu lah coy", "danger");
            }
            $this->tview("login/index");
        }

        //proc
        public function logout(){
            if($this->auth()){
                unset($_SESSION['user']);
                unset($_SESSION['role']);
                Flasher::setFlash("Logout", "berhasil", "success");
            }
            $this->location("login");
        }
        
        //view
        public function index(){
            if ($this->auth()) {
                $this->location("home");
            }
            $this->tview("login/index");
        }
    }
?>