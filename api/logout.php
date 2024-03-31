<?php 
session_start();
if (isset($_SESSION["id"]) && $_SESSION["authenticated"]) {
    unset($_SESSION["id"]);
    unset($_SESSION["authenticated"]);
}
session_destroy();

header('Location: ../');