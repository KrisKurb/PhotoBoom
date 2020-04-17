<?php
    session_start();
    unset($_SESSION['account']);
    unset($_SESSION['photo']);
    unset($_SESSION['likes']);
    session_destroy();
    header('Location: ../index.php');
    die();
