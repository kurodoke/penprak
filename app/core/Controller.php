<?php
    class Controller {
        //proc
        public function auth(){
            if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
                return true;
            }
            return false;
        }

        public function generateRandom($length = 8) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $string = '';
        
            for ($i = 0; $i < $length; $i++) {
                $string .= $characters[rand(0, strlen($characters) - 1)];
            }
        
            return $string;
        }

        public function view($view, $data = []){
            require("app/views/" . $view . ".php");
        }

        public function tview($view, $data = [], $hdata = [], $fdata = []){
            $this->view("templates/header", $hdata);
            $this->view($view, $data);
            $this->view("templates/footer", $fdata);
        }

        public function tnview($view, $data = [], $hdata = [], $fdata = [], $ndata = []){
            $this->view("templates/header", $hdata);
            $this->view("templates/navbar", $ndata);
            $this->view("templates/modal.profile." . (($_SESSION['role'] == "admin") ? "admin" : "all"), $ndata);
            $this->view($view, $data);
            $this->view("templates/footer", $fdata);
        }

        public function model($mod){
            require("app/models/" . $mod . ".php");
            return new $mod;
        }

        public function location($loc, $data = []) {
            header("location: " . BASE_URL . "/". $loc);
        }
    }
?>