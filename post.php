<?php
    error_reporting(0); 
    require_once 'config/db.php';
    require 'functions.php';
    session_start();
       if(!isset($_SESSION['username'])){
        header("Location:index.php");
    }
    $user = $_SESSION['username'];
?>

<html>
    <head>
        <title>Post</title>
        <link rel="stylesheet" href="styles/post.css">
        <link rel="stylesheet" href="styles/footer.css">
        <link rel="stylesheet" href="styles/header.css">
        <link rel="icon" href="images/help/favicon.ico">
    </head>
    <body>
        <div class='header'>            
            <?php include 'header.php' ?>
        </div>
        <?php
            if (isset($_FILES['img'])) {
                if (empty($_FILES['img']['name'])) {
                    $message="non hai selezionato una foto";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                } else {
                    $allowed = ['png', 'jpg', 'jpeg'];
                    $fl_name = $_FILES['img']['name'];
                    $fl_extn = strtolower(end(explode('.', $fl_name)));
                    $fl_temp = $_FILES['img']['tmp_name'];
                    $topic = $_POST['topic'];
                    if (in_array($fl_extn, $allowed)) {
                        $res = insert_img($db, $user, $fl_extn, $fl_temp, $topic);
                    } else {
                        $message="estensione del file non corretta";
                        echo "<script type='text/javascript'>alert('$message');</script>";
                    }
                }
            }
        ?>
        <div class="container">
            <div class="foto">
                <img src="images/help/upload.png" height="70px" width="70px" class="upload">
            </div>
            <div class="form">
                <form id ="form" action="" method="post" enctype="multipart/form-data">
                    <input type="file" name="img" id="img" class="inputfile"/>
                    <label for='img' id="label">Carica una foto</label>
                    <br><br><br>
                    <p id="messaggio" <?php if(!isset($res)) echo "style='display:none'" ?>>Immagine inserita</p>
                    <label for="topic">Scegli un argomento:</label>
                    <select id="topic" name="topic">
                        <option value="Animali">Animali</option>
                        <option value="Bellezza">Bellezza</option>
                        <option value="Cibo">Cibo</option>
                        <option value="Film">Film</option>
                        <option value="Moda">Moda</option>
                        <option value="Sport">Sport</option>
                        <option value="Veicoli">Veicoli</option>
                        <option value="Viaggi">Viaggi</option>
                        <option value="Videogiochi">Videogiochi</option>
                    </select>
                    <br><br><br><br>
                    <input type="submit" value="Pubblica" id="pubblica">
                </form>
            </div>
        </div>
        <div class='footer'>
            <?php include 'footer.html' ?>
        </div>  
    </body>
</html>