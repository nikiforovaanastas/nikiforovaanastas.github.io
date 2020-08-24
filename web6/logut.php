<?php

header('Content-Type: text/html; charset=UTF-8');

session_start();

if (!empty($_SESSION['login'])) {
    session_destroy();
    header('Location: .\');
}
?>
