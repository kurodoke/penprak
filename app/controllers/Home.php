<?php
    class Home extends Controller {
        //proc
        public function editProfile(){
            if ($this->auth()) {
                $model = $this->model("Home_Model");
                $tgl = ($_POST['tglLahir'] == "") ? null : $_POST['tglLahir'];
                $email = ($_POST['email'] == "") ? null : $_POST['email'];
                $alamat = ($_POST['alamat'] == "") ? null : $_POST['alamat'];
                $user = $_SESSION['user'];

                if($model->editProfile($tgl, $email, $alamat, $user)){
                    Flasher::setFlash("Update", "berhasil", "success");
                } else {
                    Flasher::setFlash("Error", "Database", "danger");
                }

                if($_FILES['fileImg']['error'] != 4){
                    if ($_FILES['fileImg']['type'] == "image/jpeg" || $_FILES['fileImg']['type'] == "image/png"){
                        if(move_uploaded_file($_FILES['fileImg']['tmp_name'], "./public/img/profile/" . $user . ".jpg")){
                            if($model->editPhoto($user, 1)){
                                Flasher::setFlash("Update", "berhasil", "success");
                            } else {
                                Flasher::setFlash("Error", "Database", "danger");
                            }
                        } else {
                            Flasher::setFlash("Error", "Image upload gagal", "danger");
                        }
                    } else {
                        Flasher::setFlash("Error", "upload jpg atau png saja", "danger");
                    }
                }  
                $this->location("home");
            } else {
                $this->location("");
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
            if($this->auth() && $_SESSION['role'] == "mahasiswa"){
                $this->tnview("mahasiswa/index", $data);
            } else {
                $this->location("");
            }
        }

        public function asdos(...$data) {
            if($this->auth() && $_SESSION['role'] == "asdos"){
                $this->tnview("asdos/index", $data);
            } else {
                $this->location("");
            }
        }
        
        public function admin(...$data) {
            if($this->auth() && $_SESSION['role'] == "admin"){
                $this->tnview("admin/index", $data);
            } else {
                $this->location("");
            }
        }
    }
?>