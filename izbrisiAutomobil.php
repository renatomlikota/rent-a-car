<?php
    require ('baza.php');

    $id = $_GET["id"];
    $sql = "DELETE FROM automobil WHERE id = ". $id;
    $result = $con->query($sql);
    if ($result) {
        header("Location: automobili.php");
    }
?>