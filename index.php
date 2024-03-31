<?php
session_start();

if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    include('./views/login.php');
} else {
    include('./views/game.php');
}