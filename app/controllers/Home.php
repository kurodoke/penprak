<?php
    class Home extends Controller {
        //proc
        public function profile(){
            $model = $this->model("Home_Model");
            $tgl = ($_POST['tglLahir'] == "") ? null : $_POST['tglLahir'];
            $email = ($_POST['email'] == "") ? null : $_POST['email'];
            $alamat = ($_POST['alamat'] == "") ? null : $_POST['alamat'];
            $user = $_SESSION['user'];
            if($model->updateProfile($tgl, $email, $alamat, $user)){
                if (!empty($_FILES['fileImg'])){
                    if ($_FILES['fileImg']['type'] == "image/jpeg"){
                        move_uploaded_file($_FILES['fileImg']['tmp_name'], "./public/img/profile/" . $user . ".jpg");
                    } else {
                        Flasher::setFlash("Image", "gagal", "danger");
                    }
                }
                Flasher::setFlash("Update", "berhasil", "success");
                $this->location("home");
            }
            else {
                Flasher::setFlash("Update", "gagal", "danger");
                $this->location("home");
            }
        }

        

        //view
        public function index(...$data) {
            if($this->auth()){
                $this->tnview($_SESSION["role"] . "/index", $data);
            } else {
                $this->location("");
            }
        }

        //view
        public function mahasiswa(...$data) {
            if(isset($_SESSION['user']) && !empty($_SESSION['user']) && $_SESSION['role'] == "mahasiswa"){
                $this->tnview("mahasiswa/index", $data);
            } else {
                $this->location("");
            }
        }

        public function asdos(...$data) {
            if(isset($_SESSION['user']) && !empty($_SESSION['user']) && $_SESSION['role'] == "asdos"){
                $this->tnview("asdos/index", $data);
            } else {
                $this->location("");
            }
        }
        
        public function admin(...$data) {
            if(isset($_SESSION['user']) && !empty($_SESSION['user']) && $_SESSION['role'] == "admin"){
                $this->tnview("admin/index", $data);
            } else {
                $this->location("");
            }
        }
    }
?>