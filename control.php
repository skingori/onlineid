<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 11/10/2017
 * Time: 20:54
 */

session_start();
if (isset($_SESSION['rank'])!="" && isset($_SESSION['logname'])!="") {
    header("Location: sessions.php");
    exit;
}