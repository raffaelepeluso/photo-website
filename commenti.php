<?php 
    require_once 'config/db.php';
    require 'functions.php';
    session_start();
    if(!isset($_SESSION['username'])){
        header("Location:index.php");
    }
    show_comment($db,$_GET['id']);
?>