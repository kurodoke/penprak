<?php
    class Flasher {
        public static function setFlash($class, $msg, $type){
            $_SESSION["flash"] = [
                "class" => $class,
                "msg" => $msg,
                "type" => $type
            ];
        }

        public static function flash() {
            if (isset($_SESSION["flash"]) && !empty($_SESSION["flash"])){
                echo '<div class="alert alert-' . $_SESSION["flash"]["type"] . ' alert-dismissible fade show" role="alert">
                    <strong>'. $_SESSION["flash"]["class"] . '</strong> ' . $_SESSION["flash"]["msg"] .
                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                unset($_SESSION["flash"]);
            }
        }
    }
?>