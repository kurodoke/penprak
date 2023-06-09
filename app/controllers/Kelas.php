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
                    $filename = $_SESSION["user"] . "_" . $data[0] . "_" . $data[1] . "_" . $this->generateRandom() . ".pdf";
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
        public function mahasiswa(...$data){
            if($this->auth()){
                $this->tnview("asdos/mahasiswa", $data);
            } else {
                $this->location("");
            }
        }

        //proc
        public function editbobot(...$data){
            if($this->auth() && !empty($data)){
                if( array_sum($_POST) == 100){
                    $model = $this->model("Kelas_Model");
                    if($model->editbobot($data[0], $data[1], $_POST['laprak'], $_POST['responsi'], $_POST['tubes'])){
                        Flasher::setFlash("Berhasil", "edit bobot", "success");
                        $this->location("kelas/index/" . join("/", $data));
                    } else {
                        Flasher::setFlash("Error", "Database", "danger");
                        $this->location("kelas/index/" . join("/", $data));
                    }
                } else {
                    Flasher::setFlash("Error", "Total input kamu harus 100", "danger");
                    $this->location("kelas/index/" . join("/", $data));
                }
                $model = $this->model("Kelas_Model");
            } else {
                $this->location("");
            }
        }

        //proc
        public function addtugas(...$data){
            if($this->auth() && !empty($data)){
                $model = $this->model("Kelas_Model");
                if($model->addTugas($data[0], $data[1], $_POST['jenis'], $_POST['soal'])){
                    Flasher::setFlash("Berhasil", "tambah tugas", "success");
                    $this->location("kelas/index/" . join("/", $data));
                } else {
                    Flasher::setFlash("Error", "Database", "danger");
                    $this->location("kelas/index/" . join("/", $data));
                }
            } else {
                $this->location("");
            }
        }

        //view
        public function tugas(...$data){
            if($this->auth()){
                $this->tnview("asdos/tugas", $data);
            } else {
                $this->location("");
            }
        }

        //proc
        public function nilai(...$data){
            if($this->auth() && !empty($data)){
                if(!empty($_POST)){
                    $model = $this->model("Kelas_Model");
                    for($index = 0; $index < count($_POST['npm']); $index++){
                        if($model->editNilai($_POST['nilai'][$index], $_POST['npm'][$index], $data[0], $data[1], $data[2])){
                            Flasher::setFlash("Berhasil", "menilai", "success");
                        } else {
                            Flasher::setFlash("Error", "database", "danger");
                            break;
                        }
                    }
                }
                $this->location("kelas/tugas/". join("/", $data));
            } else {
                $this->location("");
            }
        }

        //proc
        public function deleteTugas(...$data){
            if($this->auth() && !empty($data[2])){
                $model = $this->model("Kelas_Model");
                if ($model->deleteTugasAsdos($data[0], $data[1], $data[2])){
                    Flasher::setFlash("Berhasil", "Hapus tugas", "success");
                } else {
                    Flasher::setFlash("Error", "Database", "danger");
                }
                $this->location("kelas/index/" . join("/", array($data[0], $data[1])));
            } else {
                $this->location("");
            }
        }

        //view
        public function rekap(...$data){
            if ($this->auth() && $_SESSION['role'] == "asdos" && !empty($data[1])) {
                $model = $this->model("Rekap_Model");
                $send = array($model, $data);
                $this->tview("asdos/rekap", $send);
            } else {
                $this->location("");
            }
        }
    }
?>