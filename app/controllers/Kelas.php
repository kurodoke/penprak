<?php
    class Kelas extends Controller{
        //view
        public function index(...$data){
            if ($this->auth() && !empty($data[1])){
                if ($_SESSION['role'] == "mahasiswa"){
                    $this->tnview("mahasiswa/kelas", $data);
                } else if ($_SESSION['role'] == "asdos"){
                    $this->tnview("asdos/kelas", $data);
                }else {
                    $this->location("home");
                }
            } else {
                $this->location("");
            }
        }

        //proc
        public function upload(...$data){
            $model = $this->model("Kelas_Model");
            if ($this->auth() && !empty($data[1]) && $_SESSION['role'] == "mahasiswa"){
                if (!empty($_FILES)){
                    $arrFile = explode(".", $_FILES["fileTugas"]['name']);
                    $type = $arrFile[count($arrFile)-1];
                    $filename = $_SESSION["user"] . "_" . $data[0] . "_" . $data[1] . "_" . $_POST['nomorTugas'] . ".pdf";
                    if($type == "pdf"){
                        if(move_uploaded_file($_FILES["fileTugas"]['tmp_name'], "./public/pdf/" . $filename)){
                            if($model->uploadTugas($_SESSION["user"], $data[0], $data[1], $_POST['nomorTugas'],  $filename)){
                                Flasher::setFlash("Berhasil", "Input tugas", "success");
                            } else {
                                Flasher::setFlash("Error", "Database", "danger");
                            }
                            $this->location("kelas/index/" . join("/", $data));
                        }
                    } else {
                        Flasher::setFlash("Error", "Hanya menyimpan pdf", "danger");
                        $this->location("kelas/index/" . join("/", $data));
                    }
                } else {
                    Flasher::setFlash("Error", "Input filenya", "danger");
                    $this->location("kelas/index/" . join("/", $data));
                }
            } else {
                $this->location("home");
            }
        }

        //view
        public function datamhs(...$data){
            var_dump($data);
        }

        public function download(...$data) {
            header("location: " . BASE_URL_PUB . "/pdf/p.pdf");
        }
    }
?>