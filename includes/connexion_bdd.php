<?php
require_once('./config/connectDB.php');

function connectDB(){
    try {
        $bdd = new PDO('mysql:host='.DB_HOST.';dbname='.DB_BASE.';charset=utf8', DB_USER, DB_PWD,
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        return $bdd;
    } catch (PDOException $err) {
        $msg = "ERROR PDO dans ".$err->getFile().". Ligne ".$err->getLine()." : ".$err->getMessage();
        die($msg);
    }
}