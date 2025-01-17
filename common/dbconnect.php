<?php
try{
    $pdo = new PDO("mysql:host=localhost;dbname=decentReads","root","");
} catch(PDOException){
    die();
}