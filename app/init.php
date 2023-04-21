<?php
    session_start();
    include_once("app/core/App.php");
    include_once("app/core/Controller.php");
    include_once("app/config/config.php");
    include_once("app/core/Database.php");
    include_once("app/core/Flasher.php");

    //create obj core
    $app = new App;
?>